# CS359B Project: OceanFund

We're developing OceanFund to be an investment vehicle. The interest rate depends on the time for which the money is invested. OceanFund contains investment pools where users can store money. While the investor has their money in, they get an x% interest when someone else liquidates their interest. This x% is paid for by the liquidating investor. [x ~ 0.1-0.5%]
If you enter at time T0 and leave at time T1, you will earn (# of investors who liquidated in the time frame [T0, T1]) * x% return on your investment.

This idea isn't very out-of-the-world: it's economic model is similar to having a Fixed Deposit. Putting in your money for a long fixed period gives you a positive return. If you break your FD before the time period, you are required to pay a fee to the bank. The returns in OceanFund however are dynamic and depend on the dynamics of the whole system. 

## Technicalities
This will be implemented as a smart contract managing the money for the MVP. Users can start their own pools, invest in other pools, and extract their money. 

## Business Model
A fee will be charged whenever a user creates a new pool. In addition, there is a fee on each investment (around 0.5% commission)

## Beauty
The most beautiful aspect of this is the game theoretic aspect. After multiple mental simulations, the model for this makes this a self-regulating free market, with the only constraints that an investor shouldn't put an absurdly low or high amount. The incentive schemes make it engaging, interactive, lucrative, and balance the investors by pool size (similar to how it would happen in any gambling game like Poker: you wouldn't want to play on a table with other's having disproportionately large or small stakes). 

Future plans: Allowing a variable fee? That would spice things up. Perhaps having pools as FDs where you can lock in your money, and it would be used to finance debt. 

## Technologies used

Using React, Node, Solidity

## Installation intructions

Requirements:
* node.js
* truffle
* ganache

### Installing dependencies
```
npm install
```

### Migrating contracts
```
truffle compile 
truffle migrate --reset
```

### Running the web app
```
npm start
```