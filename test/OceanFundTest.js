const OceanFund = artifacts.require('OceanFund')
const assert = require('assert')
const utils = require('web3-utils')
const BigNumber = web3.BigNumber

require('chai')
  .use(require('chai-as-promised'))
  .use(require('chai-bignumber')(BigNumber))
  .should()

contract('OceanFund', accounts => {
	let oceanFund;
	let owner = accounts[0];
	let CREATION_PRICE = web3.toWei(0.01, "ether");
	let BROKER_RPICE = web3.toWei(0.001, "ether");

	beforeEach('setup contract for each test', async function () {
		oceanFund = await OceanFund.new()
	});

	it('has a broker set appropriately', async function () {
		assert.equal(await oceanFund.broker(), owner)
	});

	it('creates a new pool', async function() {
		const id = await oceanFund.createPool(1, 100, "first", { from: owner, value: CREATION_PRICE, gasPrice: 0 });
		console.log(id)
		// assert.equal(id, 0);	
	});

	describe('Working with Pools', () => {
		let poolId;

		beforeEach(async function () { 
	        poolId = await oceanFund.createPool(1, 100, "first", { from: owner, value: CREATION_PRICE, gasPrice: 0 });
	    })

		it('creates a new pool with valid parameters', async function() {
			const name = await oceanFund.poolName(poolId, { from: owner });
			assert.equal(name, "first");

			// const creator = await oceanFund.poolCreator(poolId);
			// assert.equal(creator, broker);

			// const active = await oceanFund.isActive(poolId);
			// assert.equal(active, true);

			// const money = await oceanFund.totalInvestmentForPool(poolId);
			// assert.equal(money, 0);
		});
	});
});