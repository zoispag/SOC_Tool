function getXMLHttp() {
    var xmlHttp
    try {
        xmlHttp = new XMLHttpRequest();
    } catch (e) {
        try {
            xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {
                alert("Your browser does not support AJAX!")
                return false;
            }
        }
    }
    return xmlHttp;
}

function MakeRequest(url) {
    var xmlHttp = getXMLHttp();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4) {
            HandleResponse(xmlHttp.responseText);
        }
    }
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

function HandleResponse(response) {
    document.getElementById("ResponseDiv").innerHTML = response;
}

function ajax_request(url, response_div) {
    var xmlHttp = getXMLHttp();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4) {
            ajax_response(xmlHttp.responseText, response_div);
        }
    }
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

function ajax_request_refresh(url, response_div) {
    var xmlHttp = getXMLHttp();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4) {
            ajax_response(xmlHttp.responseText, response_div);
        }
    }
    xmlHttp.open("GET", url, false);
    xmlHttp.send(null);
}

function ajax_response(response, response_div) {
    try {
        document.getElementById(response_div).innerHTML = response;
    }
    catch (err) {
    }
}