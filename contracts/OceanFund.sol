pragma solidity ^0.4.0;

library SafeMath {

  /**
  * @dev Multiplies two numbers, throws on overflow.
  */
  function mul(uint256 a, uint256 b) internal pure returns (uint256) {
    if (a == 0) {
      return 0;
    }
    uint256 c = a * b;
    assert(c / a == b);
    return c;
  }

  /**
  * @dev Integer division of two numbers, truncating the quotient.
  */
  function div(uint256 a, uint256 b) internal pure returns (uint256) {
    // assert(b > 0); // Solidity automatically throws when dividing by 0
    uint256 c = a / b;
    // assert(a == b * c + a % b); // There is no case in which this doesn't hold
    return c;
  }

  /**
  * @dev Substracts two numbers, throws on overflow (i.e. if subtrahend is greater than minuend).
  */
  function sub(uint256 a, uint256 b) internal pure returns (uint256) {
    assert(b <= a);
    return a - b;
  }

  /**
  * @dev Adds two numbers, throws on overflow.
  */
  function add(uint256 a, uint256 b) internal pure returns (uint256) {
    uint256 c = a + b;
    assert(c >= a);
    return c;
  }
}

contract Ownable {
  address public owner;


  event OwnershipTransferred(address indexed previousOwner, address indexed newOwner);


  /**
   * @dev The Ownable constructor sets the original `owner` of the contract to the sender
   * account.
   */
  function Ownable() public {
    owner = msg.sender;
  }

  /**
   * @dev Throws if called by any account other than the owner.
   */
  modifier onlyOwner() {
    require(msg.sender == owner);
    _;
  }

  /**
   * @dev Allows the current owner to transfer control of the contract to a newOwner.
   * @param newOwner The address to transfer ownership to.
   */
  function transferOwnership(address newOwner) public onlyOwner {
    require(newOwner != address(0));
    emit OwnershipTransferred(owner, newOwner);
    owner = newOwner;
  }

}

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
    
    function OceanFund() public {
        broker = msg.sender;
    }
    
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
    

    function calcMaxInvestment() private returns (uint) {
    	// No one invested yet. Put in anything you want
    	if (totalInvestment == 0)
    		return 2^256 - 1;

  		// Some others have invested. Make sure the pool has enough to pay you back. 
  		uint remainingPool = SafeMath.sub(totalInvestment, investments[msg.sender]);
    	uint maxInvestment = (remainingPool * 100) / POOL_FEE;
    	if (maxInvestment > investments[msg.sender])
    		return (maxInvestment - investments[msg.sender]);
    	// You've already put in as much as you could. 
    	return 0;
    }

    // Perhaps add in a limiting feature
    function invest() public payable {
        require (active);
        
        address investor = msg.sender;
        uint amount = msg.value;
        
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
    
    function calculateFee() public view returns (uint) {
        address investor = msg.sender;
        uint remainingPool = totalInvestment - investments[investor];
        uint fee = (remainingPool * POOL_FEE) / 100;
        return fee;
    }

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
        
        totalInvestment = SafeMath.add(totalInvestment, SafeMath.sub(fee, moneyLeft));
        withdrawAmount[broker] = SafeMath.add(withdrawAmount[broker], moneyLeft);
    }

    function extract() public payable {
        address investor = msg.sender;
        uint fee = calculateFee();
        require(msg.value >= fee);
        
        withdrawAmount[investor] = SafeMath.add(SafeMath.sub(msg.value, fee), withdrawAmount[investor]);
        withdrawAmount[investor] = SafeMath.add(investments[investor], withdrawAmount[investor]);
        totalInvestment = SafeMath.sub(totalInvestment, investments[investor]);
        investments[investor] = 0;
        
        distributeCommissions(fee);
    }
    
    function withdraw() public {
        uint amount = withdrawAmount[msg.sender];
        withdrawAmount[msg.sender] = 0;
        msg.sender.transfer(amount);
    }
}