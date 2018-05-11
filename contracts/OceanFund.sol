pragma solidity ^0.4.0;

import 'openzeppelin-solidity/contracts/ownership/Ownable.sol';
import 'openzeppelin-solidity/contracts/math/SafeMath.sol';

contract OceanFund is Ownable {
    
    mapping (address => uint) public withdrawAmount;
    mapping (address => uint) public investments; 
    mapping (address => uint) public investorMap;
    address[] investorList;
    
    uint public totalInvestment;
    address broker;
    bool active = true;
    uint BROKER_FEE = 0.001 ether;
    uint POOL_FEE = 1; // * 0.01 
    uint MAX_INVESTORS = 300;

    
    function OceanFund(uint poolFee, uint maxInvestors) public {
        broker = msg.sender;
        POOL_FEE = poolFee;
        MAX_INVESTORS = maxInvestors;
    }
    
    /* 
      In case of an emergency scenario or a deadlock, the contract liquidates everyones investment
      and allows them to withdraw it. 
      Can only be called by the owner of the contract. 
    */
    function close() public onlyOwner {
        active = false;
        
        for (uint i = 0; i < investorList.length; i++) {
            address person = investorList[i];

            if (investments[person] > 0) {
                withdrawAmount[person] = SafeMath.add(withdrawAmount[person], investments[person]);
            }
        }
        
        totalInvestment = 0;
    }
    
    /* 
      Calculates the maximum amount you can have invest at this point in time. You can't invest
      more money than the pool can pay you back on, since that would put the pool in deadlock
      Note: There might be more subtleties to this, this is a hacky version to take care of this 
            problem at the moment. 
    */
    function calcMaxInvestment() private view returns (uint) {
      // No one invested yet. Put in anything you want
      if (totalInvestment == 0)
        return 2 ** 256 - 1;

      // Can't have more that MAX_INVESTORS investors. 
      require(investorList.length < MAX_INVESTORS);

      // Some others have invested. Make sure the pool has enough to pay you back. 
      uint remainingPool = SafeMath.sub(totalInvestment, investments[msg.sender]);
      uint maxInvestment = (remainingPool * 100) / POOL_FEE;
      if (maxInvestment > investments[msg.sender])
        return (maxInvestment - investments[msg.sender]);
      // You've already put in as much as you could. 
      return 0;
    }

    
    /* 
      Investors call this function with the amount of money that they want to put in their pool. 
      It makes sure the value is enough to pay the BROKER_FEE, takes the commission from the 
      investment and adds it to the pool. 
      Also calls calcMaxInvestment to set a hard cap on the pool size. 
    */
    function invest() public payable {
        require (active);
        
        address investor = msg.sender;
        uint amount = msg.value;
        
        // Pay broker fee
        require(amount >= BROKER_FEE);        
        amount = SafeMath.sub(amount, BROKER_FEE);
        
        require (amount <= calcMaxInvestment());

        withdrawAmount[broker] = SafeMath.add(withdrawAmount[broker], BROKER_FEE);
        investments[investor] = SafeMath.add(investments[investor], amount);
        totalInvestment = SafeMath.add(totalInvestment, amount);
        
        if (investorMap[investor] == 0) {
            investorMap[investor] = 1;
            investorList.push(investor);
        }
    }
    

    /* 
      Calculates the total fee that is required to pay all the other investors a POOL_FEE
    */
    function calculateFee() public view returns (uint) {
        address investor = msg.sender;
        uint remainingPool = totalInvestment - investments[investor];
        uint fee = (remainingPool * POOL_FEE) / 100;
        return fee;
    }


    /* 
      This function is called privately by extract() to distribute the fees amongst all the 
      investors when one of them liquidates. 
    */
    function distributeCommissions(uint fee) private {
        uint moneyLeft = fee;
        
        for (uint i = 0; i < investorList.length; i++) {
            address person = investorList[i];

            // The person paying the fees has investments[person] = 0 so they don't get anything.
            if (investments[person] > 0) {
                uint commission = (investments[person] * POOL_FEE) / 100;
                investments[person] = SafeMath.add(investments[person], commission);
                moneyLeft -= commission;
            }
        }
        
        // Add the total paid out commision to totalInvestment so that it maintains an 
        // accurate representation of the pool details. 
        totalInvestment = SafeMath.add(totalInvestment, SafeMath.sub(fee, moneyLeft));

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
    function extract() public {
        require (active);
        
        address investor = msg.sender;
        uint fee = calculateFee();

        // Calculate the total amount of money investor has in this Pool
        withdrawAmount[investor] = SafeMath.add(investments[investor], withdrawAmount[investor]);
        // Since this money is extracted, remove it from the pool funds
        totalInvestment = SafeMath.sub(totalInvestment, investments[investor]);
        investments[investor] = 0;

        // Can't take out money if you don't have enough to pay everybody else
        require(withdrawAmount[investor] >= fee);
        
        // Remove the fee from the investor's reach 
        withdrawAmount[investor] = SafeMath.sub(withdrawAmount[investor], fee);
    
        // Pay the fee    
        distributeCommissions(fee);
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