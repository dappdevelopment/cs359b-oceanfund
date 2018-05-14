function app() {
    if (typeof web3 == 'undefined') throw 'No web3 detected. Is Metamask/Mist being used?';
    web3 = new Web3(web3.currentProvider); // MetaMask injected Ethereum provider
    console.log("Using web3 version: " + Web3.version);
  
    var contract;
    var userAccount;
  
    var contractDataPromise = $.getJSON('OceanFund.json');
    var networkIdPromise = web3.eth.net.getId(); // resolves on the current network id
    var accountsPromise = web3.eth.getAccounts(); // resolves on an array of accounts

    Promise.all([contractDataPromise, networkIdPromise, accountsPromise])
      .then(function initApp(results) {
        var contractData = results[0];  // resolved value of contractDataPromise
        var networkId = results[1];     // resolved value of networkIdPromise
        var accounts = results[2];      // resolved value of accountsPromise
        userAccount = accounts[0];
  
        // Make sure the contract is deployed on the network to which our provider is connected
        console.log(contractData.networks)
        console.log(networkId)
        if (!(networkId in contractData.networks)) {
           throw new Error("Contract not found in selected Ethereum network on MetaMask.");
        }

        var contractAddress = contractData.networks[networkId].address;
        contract = new web3.eth.Contract(contractData.abi, contractAddress);
    })
    .then(showUserDetails)
    .catch(console.error);

    function showUserDetails() {
        contract.methods.withdrawAmount(userAccount).call().then(function (total) {
            $('#withdrawDetails').text(web3.utils.fromWei(total, "ether") + " ETH withdrawable");
       });
    }

    function showPoolDetails(poolId) { 
        contract.methods.poolName(poolId).call()
        .then(function (name) {
            console.log(name);
            $("#poolDetails1").text('Pool name: ' + name);
            $("#pool1Details1").text('Pool name: ' + name);
        })
        
        contract.methods.poolCreator(poolId).call()
        .then(function (creator) {
            console.log(creator)
            $('#poolDetails2').text('Created by: ' + creator);
            $('#pool1Details2').text('Created by: ' + creator);
        })

        contract.methods.totalInvestmentForPool(poolId).call()
        .then(function (total) {
            var amount = web3.utils.fromWei(total, "ether");
            console.log(amount);
            $("#poolDetails3").text('Total amount: ' + amount + ' ETH');
            $("#pool1Details3").text('Total amount: ' + amount + ' ETH');
        })

        contract.methods.getInvestmentByUser(poolId, userAccount).call()
        .then(function (amount) {
            var investment = web3.utils.fromWei(amount, "ether");
            console.log(investment)
            $("#investmentDetails").text('Your investment: ' + investment + ' ETH');
            $("#investment1Details").text('Your investment: ' + investment + ' ETH');
        })
     }

    function invest(poolIdVal, amount) {
        if (!amount || !poolIdVal) return console.log("Fill in the Pool ID and amount");

        try {
            var value = parseFloat(amount);
            var poolId = parseInt(poolIdVal)
            contract.methods.invest(poolId).send({ from: userAccount, value: web3.utils.toWei(amount, "ether") })
            .catch(function (e) {
                console.log(e)
            });
        } catch (err) {
            console.log(err);
        }
        
    }

    function withdraw() {
        contract.methods.withdraw().send({ from: userAccount })
        .then(showUserDetails)
        .catch(function (e) {
            console.log(e)
        });
    }

    function extract(poolIdVal) {
        if (!poolIdVal) return console.log("Fill in the Pool ID");

        try {
            var poolId = parseInt(poolIdVal)
            contract.methods.extract(poolId).send({ from: userAccount })
            .then(showUserDetails)
            .catch(function (e) {
                console.log(e)
            });
        } catch (err) {
            console.log(err);
        }
    }

    function createPool(name) {
        if (!name) return console.log("Fill in the Name field");

        try {
            contract.methods.createPool(10, 100, name).send({ from: userAccount, value: web3.utils.toWei("0.01", "ether") })
            .then(result => { console.log(result); })
            .catch(function (e) {
                console.log(e)
            });
        } catch (err) {
            console.log(err);
        }
    }

    function closePool(poolIdVal) {
        if (!poolIdVal) return console.log("Fill in the Pool ID field");

        try {
            var poolId = parseInt(poolIdVal)
            contract.methods.closePool(poolId).send({ from: userAccount })
            .then(() => { console.log('Closed successfully') })
            .catch(function (e) {
                console.log(e)
            });
        } catch (err) {
            console.log(err);
        }
    }

    $("#extractButton").click(function() {
        var poolId = $("#extract-poolId").val();
        extract(poolId);
    });


    $("#investButton").click(function() {
        var amount = $("#invest-amount").val();
        var poolId = $("#invest-poolId").val();
        invest(poolId, amount);
    });

    $("#withdrawButton").click(function() {
        withdraw();
    });

    $("#createPoolButton").click(function() {
        var name = $("#createPool-name").val();
        $("#createPool-name").text("");
        createPool(name);
    });

    $("#closePoolButton").click(function() {
        var poolId = $("#closePool-poolId").val();
        $("#closePool-poolId").text("");
        closePool(poolId);
    });

    $("#showDetails1Button").click(function() {
        var poolId = $("#pool1Details-poolId").val();
        $("#pool1Details-poolId").text("");
        showPoolDetails(poolId);
    });

    $("#showDetailsButton").click(function() {
        var poolId = $("#poolDetails-poolId").val();
        $("#poolDetails-poolId").text("");
        showPoolDetails(poolId);
    });
}

$(document).ready(app);