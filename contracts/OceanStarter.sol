pragma solidity ^0.4.21;

/**
 * @title SafeMath
 * @dev Math operations with safety checks that throw on error
 */
library SafeMath {

  /**
  * @dev Multiplies two numbers, throws on overflow.
  */
  function mul(uint256 a, uint256 b) internal pure returns (uint256 c) {
    if (a == 0) {
      return 0;
    }
    c = a * b;
    assert(c / a == b);
    return c;
  }

  /**
  * @dev Integer division of two numbers, truncating the quotient.
  */
  function div(uint256 a, uint256 b) internal pure returns (uint256) {
    // assert(b > 0); // Solidity automatically throws when dividing by 0
    // uint256 c = a / b;
    // assert(a == b * c + a % b); // There is no case in which this doesn't hold
    return a / b;
  }

  /**
  * @dev Subtracts two numbers, throws on overflow (i.e. if subtrahend is greater than minuend).
  */
  function sub(uint256 a, uint256 b) internal pure returns (uint256) {
    assert(b <= a);
    return a - b;
  }

  /**
  * @dev Adds two numbers, throws on overflow.
  */
  function add(uint256 a, uint256 b) internal pure returns (uint256 c) {
    c = a + b;
    assert(c >= a);
    return c;
  }
}

// contract ERC20 {
//     function totalSupply() public constant returns (uint);
//     function balanceOf(address tokenOwner) public constant returns (uint balance);
//     function allowance(address tokenOwner, address spender) public constant returns (uint remaining);
//     function transfer(address to, uint tokens) public returns (bool success);
//     function approve(address spender, uint tokens) public returns (bool success);
//     function transferFrom(address from, address to, uint tokens) public returns (bool success);
//     event Transfer(address indexed from, address indexed to, uint tokens);
//     event Approval(address indexed tokenOwner, address indexed spender, uint tokens);
// }

contract OceanFund {
    
    uint BASE_CONVERSION_RATE = 1000; 
    uint FINAL_CONVERSION_RATE = 500; 
    uint CREATOR_CONVERSION_RATE = 200; 

    struct Pool {   
        // Contains the total amount invested in each pool 
        uint totalInvestment;

        address creator;
        bool active;
        uint maxInvestors;
        uint level;

        // Contains the list of investors in each pool 
        address[] investorList;
        string name;

        // Controls conversion rate 
        uint conversionRate; 
        uint inflation;
        uint minConversionRate;

        // Contains the investments by an investor into a particular pool 
        mapping (address => uint) investments;

        // Contains a bool to check if an investor has been added to the investorList for the pool (prevents duplicates)
        mapping (address => uint) investorMap;
    }
    
    struct ERC20Details {
        address contractAddress;
        uint rewardTokens;
        uint minDuration;
        uint thresholdInvestment;
        uint balance;
    }

    mapping (address => uint) public withdrawAmount;

    Pool[] pools;

    // The address of the owner of OceanFund
    address public broker;

    uint BROKER_FEE = 0.001 ether;
    uint COMMISSION_DENOM = 500; 

    mapping (address => uint) public oceanTokensMap;
    uint public totalOceanTokens;

    mapping (address => uint) public levelForAddress; 

    mapping (uint => ERC20Details) public ERC20forPool;

    constructor() public {
        broker = msg.sender;
    }
    

    modifier checkValidPool(uint poolId) {
        require (poolId < pools.length);
        require (pools[poolId].active);
        _;
    }

    function getInvestmentByUser(uint poolId, address user) public checkValidPool(poolId) view returns (uint) {
        return pools[poolId].investments[user];
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

    uint BASE_CREATION_FEE = 5; 
    uint MULT_CREATION_FEE = 5;


    function createPool(uint maxInvestors, string name, uint level) public returns (uint) {
        // levelForAddress <= 50 so level <= 50
        require (levelForAddress[msg.sender] >= level);

        uint tokensNeeded = BASE_CREATION_FEE;
        for (uint i = 0; i < level; i++) {
            tokensNeeded = SafeMath.mul(tokensNeeded, MULT_CREATION_FEE);
        }

        require (oceanTokensMap[msg.sender] >= tokensNeeded);
        oceanTokensMap[msg.sender] = SafeMath.sub(oceanTokensMap[msg.sender], tokensNeeded);
        totalOceanTokens = SafeMath.sub(totalOceanTokens, tokensNeeded);
        
        // Initialize pool
        Pool memory pool = Pool(0, msg.sender, true, maxInvestors, level, 
                                new address[](0), name, DEFAULT_CONVERSION_RATE, 
                                FINAL_CONVERSION_RATE, 10);

        // Add to pools. Note: The id that we return from this function are 0-indexed. 
        return pools.push(pool) - 1;
    }
    
    function addERC20(uint poolId, address contractAddress, uint amount,
                      uint rewardTokens, uint minDuration,
                      uint thresholdInvestment) public checkValidPool(poolId) 
    {
        require (ERC20forPool[poolId].contractAddress == 0);
        
        ERC20Details memory erc20 = ERC20Details(contractAddress, rewardTokens, 
                                                 minDuration, thresholdInvestment, amount);
        ERC20forPool[poolId] = erc20;                                         
        // ERC20(contractAddress).transferFrom(msg.sender, address(this), amount);
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
        
        // Mint tokens for the customer
        Pool storage pool = pools[poolId];
        withdrawAmount[broker] = SafeMath.add(withdrawAmount[broker], BROKER_FEE);
        pool.investments[investor] = SafeMath.add(pool.investments[investor], amount);
        pool.totalInvestment = SafeMath.add(pool.totalInvestment, amount);
        
        // Mint tokens for the user
        uint tokensNeeded = (amount * pool.conversionRate) / (1 ether);
        oceanTokensMap[msg.sender] = SafeMath.add(oceanTokensMap[msg.sender], tokensNeeded);
        totalOceanTokens = SafeMath.add(totalOceanTokens, tokensNeeded);

        // Mint tokens for the creator
        uint tokensMinted = (amount * CREATOR_CONVERSION_RATE) / (1 ether);
        oceanTokensMap[pool.creator] = SafeMath.add(oceanTokensMap[pool.creator], tokensMinted);
        totalOceanTokens = SafeMath.add(totalOceanTokens, tokensMinted);


        // Only adds investor to this map if they aren't in yet. 
        if (pool.investorMap[investor] == 0) {
            pool.investorMap[investor] = 1;
            pool.investorList.push(investor);
        }
    }

    /* 
      Allows an investor to liquidate their funds from their pool investment to withdrawable
      funds. It takes the distribution fee out of their total principal and sends it out to the 
      other investors through distributeCommissions. 
    */
    function extract(uint poolId) public checkValidPool(poolId) {
        address investor = msg.sender;

        Pool storage pool = pools[poolId];

        if (pool.conversionRate > pool.minConversionRate) {
            pool.conversionRate -= pool.inflation;
        }

        uint tokensNeeded = (pool.investments[investor] * pool.conversionRate) / (1 ether);
        require (oceanTokensMap[msg.sender] >= tokensNeeded);
        oceanTokensMap[msg.sender] = SafeMath.sub(oceanTokensMap[msg.sender], tokensNeeded);
        totalOceanTokens = SafeMath.sub(totalOceanTokens, tokensNeeded);

        // Calculate the total amount of money investor has in this Pool
        withdrawAmount[investor] = SafeMath.add(withdrawAmount[investor], pool.investments[investor]);

        // Since this money is extracted, remove it from the pool funds
        pool.totalInvestment = SafeMath.sub(pool.totalInvestment, pool.investments[investor]);
        pool.investments[investor] = 0;
    }
    

    /* 
        Allows the user to securely withdraw the excess funds that the contract owes them. 
    */
    function withdraw() public {
        uint amount = withdrawAmount[msg.sender];
        withdrawAmount[msg.sender] = 0;
        msg.sender.transfer(amount);
    }

    uint DEFAULT_CONVERSION_RATE = 500; // Number of ocean tokens for ether
    uint MINIMUM_PAYMENT = 0.01 ether; 

    function buy() public payable { 
        require (msg.value > MINIMUM_PAYMENT);

        withdrawAmount[broker] = SafeMath.add(withdrawAmount[broker], msg.value);
        uint newTokens = (DEFAULT_CONVERSION_RATE * msg.value) / (1 ether);
        totalOceanTokens = SafeMath.add(totalOceanTokens, newTokens);
        oceanTokensMap[msg.sender] = SafeMath.add(oceanTokensMap[msg.sender], newTokens);
    }

    function upgradeLevel() public {
        require (levelForAddress[msg.sender] < 50);

        uint neededTokens = 1;
        for (uint i = 0; i < levelForAddress[msg.sender]; i++) {
            neededTokens = SafeMath.mul(neededTokens, 10);
        }

        require (oceanTokensMap[msg.sender] >= neededTokens);

        oceanTokensMap[msg.sender] = SafeMath.sub(oceanTokensMap[msg.sender], neededTokens);
        totalOceanTokens = SafeMath.sub(totalOceanTokens, neededTokens);
        levelForAddress[msg.sender]++;
    }
}