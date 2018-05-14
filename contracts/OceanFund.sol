pragma solidity ^0.4.21;

import 'openzeppelin-solidity/contracts/ownership/Ownable.sol';
import 'openzeppelin-solidity/contracts/math/SafeMath.sol';

contract OceanFund is Ownable {
    
    struct Pool {   
        // Contains the total amount invested in each pool 
        uint totalInvestment;

        address creator;
        bool active;
        uint poolFee; // * 0.01% is the interest per liquidation
        uint maxInvestors;

        // Contains the list of investors in each pool 
        address[] investorList;
        string name;

        // Contains the investments by an investor into a particular pool 
        mapping (address => uint) investments;

        // Contains a bool to check if an investor has been added to the investorList for the pool (prevents duplicates)
        mapping (address => uint) investorMap;
    }

    mapping (address => uint) public withdrawAmount;

    Pool[] pools;

    // The address of the owner of OceanFund
    address broker;

    uint BROKER_FEE = 0.001 ether;
    uint CREATION_FEE = 0.01 ether; 
    uint POOL_DENOMINATION = 10000;

    function OceanFund() public {
        broker = msg.sender;
    }
    

    modifier checkValidPool(uint poolId) {
        require (poolId < pools.length);
        require (pools[poolId].active);
        _;
    }


    function poolCreator(uint poolId) public checkValidPool(poolId) view returns(address) {
        return pools[poolId].creator;
    } 

    function poolName(uint poolId) public checkValidPool(poolId) view returns(string) {
        return pools[poolId].name;
    } 

    function totalInvestmentForPool(uint poolId) public checkValidPool(poolId) view returns(uint) {
        return pools[poolId].totalInvestment;
    } 

    function isActive(uint poolId) public checkValidPool(poolId) view returns(bool) {
        return pools[poolId].active;
    } 


    function createPool(uint poolFee, uint maxInvestors, string name) public payable returns (uint) {
        require (msg.value >= CREATION_FEE);
        // Initialize pool
        Pool memory pool = Pool(0, msg.sender, true, poolFee, maxInvestors, new address[](0), name);

        // Manage balances
        withdrawAmount[broker] = SafeMath.add(withdrawAmount[broker], CREATION_FEE);
        withdrawAmount[msg.sender] = SafeMath.add(withdrawAmount[msg.sender], SafeMath.sub(msg.value, CREATION_FEE));

        // Add to pools. Note: The id that we return from this function are 0-indexed. 
        return pools.push(pool) - 1;
    } 

    /* 
      In case of an emergency scenario or a deadlock, the contract liquidates everyones investment
      and allows them to withdraw it. 
      Can only be called by the owner of the contract. 
    */
    function closePool(uint poolId) public checkValidPool(poolId) {
        Pool storage pool = pools[poolId]; 
        require (msg.sender == pool.creator);

        pool.active = false;
        
        for (uint i = 0; i < pool.investorList.length; i++) {
            address user = pool.investorList[i];

            if (pool.investments[user] > 0) {
                withdrawAmount[user] = SafeMath.add(withdrawAmount[user], pool.investments[user]);
            }
        }
        
        pool.totalInvestment = 0;
    }

    
    /* 
      Calculates the maximum amount you can have invest at this point in time. You can't invest
      more money than the pool can pay you back on, since that would put the pool in deadlock
      Note: There might be more subtleties to this, this is a hacky version to take care of this 
            problem at the moment. 
    */
    function calcMaxInvestment(uint poolId) private view returns (uint) {
        Pool storage pool = pools[poolId];

        // No one invested yet. Put in anything you want
        if (pool.totalInvestment == 0)
            return 2 ** 256 - 1;

      // Can't have more that MAX_INVESTORS investors. 
      require(pool.investorList.length < pool.maxInvestors);

      // Some others have invested. Make sure the pool has enough to pay you back. 
      uint remainingPool = SafeMath.sub(pool.totalInvestment, pool.investments[msg.sender]);
      uint maxInvestment = (remainingPool * POOL_DENOMINATION) / pool.poolFee;
      if (maxInvestment > pool.investments[msg.sender])
        return (maxInvestment - pool.investments[msg.sender]);
      // You've already put in as much as you could. 
      return 0;
    }

    
    /* 
      Investors call this function with the amount of money that they want to put in their pool. 
      It makes sure the value is enough to pay the BROKER_FEE, takes the commission from the 
      investment and adds it to the pool. 
      Also calls calcMaxInvestment to set a hard cap on the pool size. 
    */
    function invest(uint poolId) public payable checkValidPool(poolId) {        
        address investor = msg.sender;
        uint amount = msg.value;
        
        // Pay broker fee
        require(amount >= BROKER_FEE);        
        amount = SafeMath.sub(amount, BROKER_FEE);
        
        require (amount <= calcMaxInvestment(poolId));

        Pool storage pool = pools[poolId];
        withdrawAmount[broker] = SafeMath.add(withdrawAmount[broker], BROKER_FEE);
        pool.investments[investor] = SafeMath.add(pool.investments[investor], amount);
        pool.totalInvestment = SafeMath.add(pool.totalInvestment, amount);
        
        // Only adds investor to this map if they aren't in yet. 
        if (pool.investorMap[investor] == 0) {
            pool.investorMap[investor] = 1;
            pool.investorList.push(investor);
        }
    }
    

    /* 
      Calculates the total fee that is required to pay all the other investors a POOL_FEE
    */
    function calculateFee(uint poolId) public view returns (uint) {
        address investor = msg.sender;
        Pool storage pool = pools[poolId];
        uint remainingPool = pool.totalInvestment - pool.investments[investor];
        uint fee = (remainingPool * pool.poolFee) / POOL_DENOMINATION;
        return fee;
    }


    /* 
      This function is called privately by extract() to distribute the fees amongst all the 
      investors when one of them liquidates. 
    */
    function distributeCommissions(uint poolId, uint fee) private {
        uint moneyLeft = fee;
        Pool storage pool = pools[poolId];

        for (uint i = 0; i < pool.investorList.length; i++) {
            address user = pool.investorList[i];

            // The user paying the fees has investments[user] = 0 so they don't get anything.
            if (pool.investments[user] > 0) {
                uint commission = (pool.investments[user] * pool.poolFee) / POOL_DENOMINATION;
                pool.investments[user] = SafeMath.add(pool.investments[user], commission);
                moneyLeft -= commission;
            }
        }
        
        // Add the total paid out commision to totalInvestment so that it maintains an 
        // accurate representation of the pool details. 
        pool.totalInvestment = SafeMath.add(pool.totalInvestment, SafeMath.sub(fee, moneyLeft));

        // Since we are doing division, there is a chance there might be excess funds left 
        // which are unaccounted for. 
        withdrawAmount[broker] = SafeMath.add(withdrawAmount[broker], moneyLeft);
    }


    /* 
      Allows an investor to liquidate their funds from their pool investment to withdrawable
      funds. It takes the distribution fee out of their total principal and sends it out to the 
      other investors through distributeCommissions. 

      REVERTS: If the investor doesn't have enough funds to pay everybody else. 
    */
    function extract(uint poolId) public checkValidPool(poolId) {
        address investor = msg.sender;
        uint fee = calculateFee(poolId);

        Pool storage pool = pools[poolId];

        // Calculate the total amount of money investor has in this Pool
        withdrawAmount[investor] = SafeMath.add(pool.investments[investor], withdrawAmount[investor]);

        // Can't take out money if you don't have enough to pay everybody else
        require(withdrawAmount[investor] >= fee);

        // Since this money is extracted, remove it from the pool funds
        pool.totalInvestment = SafeMath.sub(pool.totalInvestment, pool.investments[investor]);
        pool.investments[investor] = 0;
        
        // Remove the fee from the investor's withdraw funds 
        withdrawAmount[investor] = SafeMath.sub(withdrawAmount[investor], fee);
    
        // Pay the fee    
        distributeCommissions(poolId, fee);
    }
    

    /* 
        Allows the user to securely withdraw the excess funds that the contract owes them. 
    */
    function withdraw() public {
        uint amount = withdrawAmount[msg.sender];
        withdrawAmount[msg.sender] = 0;
        msg.sender.transfer(amount);
    }
}