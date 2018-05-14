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
    // .then(refreshPoolTotal)
    .catch(console.error);

    function showPoolDetails(poolId) { 
        contract.methods.poolName(poolId).call()
        .then(function (name) {
            console.log(name);
            $("#poolDetails1").text('Pool name: ' + name);
        })
        
        contract.methods.poolCreator(poolId).call()
        .then(function (creator) {
            console.log(creator)
            $('#poolDetails2').text('Created by: ' + creator);
        })

        contract.methods.totalInvestmentForPool(poolId).call()
        .then(function (total) {
            console.log(total);
            var amount = web3.utils.fromWei(total, "ether");
            console.log(amount);
            $("#poolDetails3").text('Total amount: ' + amount + ' ETH');
        })

       contract.methods.withdrawAmount(userAccount).call().then(function (total) {
         $('#withdrawDetails').text(web3.utils.fromWei(total, "ether") + " ETH withdrawable");
         $("#loader").hide();
       });
     }

    function invest(poolIdVal, amount) {
        if (!amount || !poolIdVal) return console.log("Fill in the Pool ID and amount");

        $("#loader").show();
        try {
            var value = parseFloat(amount);
            var poolId = parseInt(poolIdVal)
            contract.methods.invest(poolId).send({ from: userAccount, value: web3.utils.toWei(amount, "ether") })
            .catch(function (e) {
                $("#loader").hide();
            });
        } catch (err) {
            console.log(err);
            $("#loader").hide();
        }
        
    }

    function withdraw(poolIdVal) {
        if (!poolIdVal) return console.log("Fill in the Pool ID");

        $("#loader").show();
        try {
            var poolId = parseInt(poolIdVal)
            contract.methods.withdraw(poolId).send({ from: userAccount })
            .catch(function (e) {
                $("#loader").hide();
            });
        } catch (err) {
            console.log(err);
            $("#loader").hide();
        }
    }

    function extract(poolIdVal) {
        if (!poolIdVal) return console.log("Fill in the Pool ID");

        $("#loader").show();
        try {
            var poolId = parseInt(poolIdVal)
            contract.methods.extract(poolId).send({ from: userAccount })
            .catch(function (e) {
                $("#loader").hide();
            });
        } catch (err) {
            console.log(err);
            $("#loader").hide();
        }
    }

    function createPool(name) {
        if (!name) return console.log("Fill in the Name field");

        $("#loader").show();
        try {
            contract.methods.createPool(10, 100, name).send({ from: userAccount, value: web3.utils.toWei("0.01", "ether") })
            .catch(function (e) {
                $("#loader").hide();
            });
        } catch (err) {
            console.log(err);
            $("#loader").hide();
        }
    }

    function closePool(poolIdVal) {
        if (!poolIdVal) return console.log("Fill in the Pool ID field");

        $("#loader").show();
        try {
            var poolId = parseInt(poolIdVal)
            contract.methods.closePool(poolId).send({ from: userAccount })
            .catch(function (e) {
                $("#loader").hide();
            });
        } catch (err) {
            console.log(err);
            $("#loader").hide();
        }
    }



    

    $("#extractButton").click(function() {
        var poolId = $("#poolId").val();
        extract(poolId);
    });


    $("#investButton").click(function() {
        var amount = $("#amount").val();
        var poolId = $("#poolId").val();
        invest(poolId, amount);
    });

    $("#withdrawButton").click(function() {
        var poolId = $("#poolId").val();
        withdraw(poolId);
    });

    $("#createPoolButton").click(function() {
        var name = $("#name").val();
        createPool(name);
    });

    $("#closePoolButton").click(function() {
        var poolId = $("#poolId").val();
        closePool(poolId);
    });

    $("#showDetailsButton").click(function() {
        var poolId = $("#poolId").val();
        showPoolDetails(poolId);
    });
}

$(document).ready(app);