let listDelete;

function FetchObject(fetchUrl, ajaxContainer, bindFunction, sendData = ""){
    this.url = fetchUrl;
    this.ajaxContainer = ajaxContainer;
    this.bindFunction = bindFunction;
    this.sendData = sendData;
    return this;
}

function CrudObject(crudUrl, crudData){
    this.crudUrl = crudUrl;
    this.crudData = crudData;
    return this;
}

function fetch(fetchObject){
    var request = new XMLHttpRequest();
    var url = fetchObject.url;
    var ajaxContainer = fetchObject.ajaxContainer;
    var bindFunction = fetchObject.bindFunction;
    request.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            ajaxContainer.innerHTML = request.responseText;
            if(bindFunction != null){
                bindFunction();
            }
        }
    }

    request.open("POST", url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(fetchObject.sendData);
}

function crud(deleteObj, callback){
    var request = new XMLHttpRequest();
    var url = deleteObj.crudUrl;
    var crudData = deleteObj.crudData;
    request.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            if(callback != null){
                callback();
            }
        }
    }

    request.open("POST", url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(crudData)
}

function bindUserDelete(){
    listDelete = document.querySelectorAll(".deleteUser");
    for(var i = 0; i < listDelete.length; i++){
        listDelete[i].addEventListener("click", deleteUser);
    }
}

function deleteUser(){
    var data = `user_id=${this.value}`;
    var crudObject = new CrudObject("deleteUser.php", data);
    
    crud(crudObject, updateUser);
}

function ipoInsert(){
    var asset = document.getElementById("assetInput").value;
    var market = document.getElementById("marketInput").value;
    var price = document.getElementById("priceInput").value;
    document.getElementById("assetInput").value = "";
    document.getElementById("marketInput").value = "";
    document.getElementById("priceInput").value = "";
    var data = `asset=${asset}&market=${market}&price=${price}`;
    var crudObject = new CrudObject("insertipo.php", data);
    crud(crudObject, updateIpo);
}

function marketplaceInsert(){
    var identifier = this.value;
    if(identifier > -1){
        var price = document.getElementById("price").value;
        var quantity = document.getElementById("quantity").value;
        var userID = `userID=${document.getElementById("userID").value}`;
        var data = `identifier=${identifier}&price=${price}&quantity=${quantity}`;
        var crudObject = new CrudObject("insertmarketplace.php", data);
        crud(crudObject, cancelInsertUpdate);
    }else{
        alert("Kamu tidak mempunyai kepemilikan saham");
    }
    document.getElementById("price").value = "";
    document.getElementById("quantity").value = "";
}

function bindAssetAction(){
    listDelete = document.querySelectorAll(".buyAction");
    for (var i = 0; i < listDelete.length; i++) {
        listDelete[i].addEventListener("click", buyAction);
    }

    listDelete = document.querySelectorAll(".cancelAction");
    for (var i = 0; i < listDelete.length; i++) {
        listDelete[i].addEventListener("click", cancelAction);
    }
}

function buyAction(){
    var buyerID = document.getElementById("userID").value;
    var data = `identifier=${this.value}&buyerID=${buyerID}`;
    var userID = `userID=${document.getElementById("userID").value}`;
    var crudObject = new CrudObject("buy.php", data);
    crud(crudObject, loadMarketplacePage);
}

function cancelAction(){
    var data = `identifier=${this.value}`;
    var userID = `userID=${document.getElementById("userID").value}`;
    var crudObject = new CrudObject("cancel.php", data);
    crud(crudObject, cancelInsertUpdate);
}

//Admin
function updateUser(){
    fetch(createUserUpdateObject());
}

function updateIpo(){
    fetch(createIpoUpdateObject());
}

//User
function updateUserHome(){
    fetch(createUserHomeUpdateObject());
}

function loadMarketplacePage(){
    updateMarket();
    updateMarketplaceForm();
    updateBalance();
    updateHistory();
}

function cancelInsertUpdate(){
    updateMarket();
    updateMarketplaceForm();
}

function updateMarket(){
    fetch(createMarketUpdateObject());
}

function updateMarketplaceForm(){
    fetch(createMarketplaceFormUpdateObject());
}

function updateBalance(){
    fetch(createBalanceUpdateObject());
}

function updateHistory(){
    fetch(createHistoryUpdateObject());
}

function createUserUpdateObject(){
    var ajaxContainer = document.getElementById("userTable");
    var fetchObject = new FetchObject("fetchuser.php", ajaxContainer, bindUserDelete);
    return fetchObject;
}

function createIpoUpdateObject(){
    var ajaxContainer = document.getElementById("ipoTable");
    var fetchObject = new FetchObject("fetchipo.php", ajaxContainer);
    return fetchObject;
}

function createUserHomeUpdateObject(){
    var ajaxContainer = document.getElementById("marketTable");
    var fetchObject = new FetchObject("fetchmarket.php", ajaxContainer);
    return fetchObject;        
}

function createMarketplaceFormUpdateObject(){
    var ajaxContainer = document.getElementById("own");
    var fetchObject = new FetchObject("alvailable.php", ajaxContainer, null, identifier);
    return fetchObject;
}

function createMarketUpdateObject(){
    var ajaxContainer = document.getElementById("market");
    var fetchObject = new FetchObject("marketupdate.php", ajaxContainer, bindAssetAction);
    return fetchObject;
}

function createBalanceUpdateObject(){
    var ajaxContainer = document.getElementById("balance");
    var fetchObject = new FetchObject("balanceupdate.php", ajaxContainer);
    return fetchObject;
}

function createHistoryUpdateObject(){
    var ajaxContainer = document.getElementById("history");
    var fetchObject = new FetchObject("historyupdate.php", ajaxContainer);
    return fetchObject;
}