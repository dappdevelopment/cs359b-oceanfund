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
    .then(refreshPoolTotal)
    .catch(console.error);

    function refreshPoolTotal() { 
       // Calling the contract (try with/without declaring view)
       contract.methods.totalInvestment().call().then(function (total) {
         $('#poolDetails').text(web3.utils.fromWei(total, "ether") + " ETH in the pool");
         $("#loader").hide();
       });

       contract.methods.investments(userAccount).call().then(function (total) {
         $('#investmentDetails').text(web3.utils.fromWei(total, "ether") + " ETH invested");
         $("#loader").hide();
       });

       contract.methods.withdrawAmount(userAccount).call().then(function (total) {
         $('#withdrawDetails').text(web3.utils.fromWei(total, "ether") + " ETH withdrawable");
         $("#loader").hide();
       });
     }

    function invest(amount) {
        console.log(amount)
        if (!amount) return console.log("Fill in the amount");

        $("#loader").show();
        try {
            var value = parseFloat(amount);
            contract.methods.invest().send({from: userAccount, value:web3.utils.toWei(amount, "ether")})
            .then(refreshPoolTotal)
            .catch(function (e) {
                $("#loader").hide();
            });
        } catch (err) {
            console.log(err);
        }
        
    }

    function withdraw() {
        $("#loader").show();

        contract.methods.withdraw().send({from: userAccount})
        .then(refreshPoolTotal)
        .catch(function (e) {
            $("#loader").hide();
        });
    }

    function extract() {
        $("#loader").show();

        contract.methods.extract().send({from: userAccount})
        .then(refreshPoolTotal)
        .catch(function (e) {
            $("#loader").hide();
        });
    }

    $("#extractButton").click(function() {
        extract();
    });


    $("#investButton").click(function() {
        var amount = $("#amount").val();
        invest(amount);
    });

    $("#withdrawButton").click(function() {
        withdraw();
    });
}

$(document).ready(app);