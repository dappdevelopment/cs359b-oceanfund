var OceanFund = artifacts.require("OceanFund");  

module.exports = function(deployer) {
    deployer.deploy(OceanFund, 1, 300); // PoolFee = 1%, MaxInvestors = 300
};