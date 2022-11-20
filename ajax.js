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

function crud(deleteObj, callback, messageContainer){
    var request = new XMLHttpRequest();
    var url = deleteObj.crudUrl;
    var crudData = deleteObj.crudData;
    request.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            if(messageContainer != null){
                messageContainer.innerHTML = request.responseText;
            }
            if(callback != null){
                callback();
            }
        }
    }

    request.open("POST", url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(crudData)
}