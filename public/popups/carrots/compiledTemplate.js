// var impressionUrl = '';
// var fileContent = '';
// var appUrl = '';
// var displayFrequency = '';
// var cookieId = '';
// var blacklist = [];

document.addEventListener('DOMContentLoaded', function(event) {
    loadExitPopLibrary();
});

function loadExitPopLibrary() {
    var headTag = document.getElementsByTagName("head")[0];
    var ddTag = document.createElement('script');
    ddTag.type = 'text/javascript';
    ddTag.src = appUrl + '/popups/js/exitpop.js';
    ddTag.onload = loadHTML;
    headTag.appendChild(ddTag);
}

function loadHTML() {
    var div = document.createElement("div");
    div.setAttribute('id', 'signupcarrot');
    div.setAttribute('class', 'signupcarrot');
    var closeButton = '<button id="signupcarrot-close" type="button" class="close" aria-label="Close">\
        <span aria-hidden="true">&times;</span>\
    </button>';
    div.innerHTML = closeButton + fileContent;
    document.body.appendChild(div);
    initializePopup();
}

function sendImpressionRequest(carrotId) {
    var request = new XMLHttpRequest();
    data = 'carrot-id='+carrotId;
    request.open('POST', impressionUrl, true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.setRequestHeader('Api-Token', 'alex');
    request.onload = function() {
        if (this.status >= 200 && this.status < 400) {
            // Success!
            var resp = this.response;
            console.log('yay', resp);
        } else {
            // We reached our target server, but it returned an error
            console.log('boo', this);
        }
    };
    request.onerror = function() {
        // There was a connection error of some sort
        console.log('connection error');
    };
    request.send(data);
}

function initializePopup() {
    carrotId = document.getElementById('signupcarrot-id').value;
    exitpop.init({
        contentsource: 'signupcarrot',
        displayfreq: displayFrequency,
        persistcookie: cookieId,
        urlblacklist: blacklist,
        onexitpop: function(popup) {
            sendImpressionRequest(carrotId);
        }
    });
}