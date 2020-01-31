var cookieId = 'signupcarrot_test';
var displayFrequency = 'always';
var appUrl = 'https://signupcarrot.com';
var impressionUrl = 'https://signupcarrot.com/api/impression';
var fileContent = '<link rel="stylesheet" href="https://signupcarrot.com/popups/css/signupcarrot.css">\
<link rel="stylesheet" href="https://signupcarrot.com/popups/css/bootstrap.css">\
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source Sans Pro&display=swap">\
<style>\
#ddexitpopwrapper{\
    font-family: "Source Sans Pro", sans-serif!important;\
}\
#ddexitpopwrapper .signupcarrot{\
    font-family: "Source Sans Pro", sans-serif!important;\
}\
.signupcarrot .vertically-center{\
    display: flex;\
    flex-direction: column;\
    justify-content: center;\
    align-items: stretch;\
}\
.signupcarrot .overflow-break-word{\
    overflow-wrap: break-word;\
}\
.signupcarrot h1.scalable{\
    font-size: 1.5rem;\
}\
.signupcarrot h2.scalable{\
    font-size: 1.25rem;\
}\
.signupcarrot #signupcarrot-product-image {\
    background-position: center center;\
    background-repeat: no-repeat;\
    background-size: cover;\
}\
@media screen and (max-width: 767px){\
    .signupcarrot .scalable{\
        font-size: 1rem;\
    }\
    .signupcarrot #signupcarrot-product-image {\
        background-position: center bottom;\
        height:10rem;\
    }\
}\
#ddexitpopwrapper .signupcarrot{\
    visibility: visible !important;\
}\
</style>\
<div class="container">\
    <div class="row text-center">\
        <div id="signupcarrot-product-image" class="col-12 col-md-5 offset-md-0"  style="background-image: url(\'https://signupcarrot.com/popups/images/keyring-wood.jpg\');">\
        </div>\
        <div class="col-12 col-md-7 vertically-center py-4">\
            <div>\
                <div class="col-sm-12">\
                    <h1 id="signupcarrot-title" class="scalable text-center overflow-break-word">Get a free personalised keyring</h1>\
                    <h2 id="signupcarrot-subtitle" class="scalable text-center overflow-break-word">when you sign up to our newsletter</h2>\
                </div>\
                <div class="col-sm-12">\
                    <form id="signupcarrot-form" class="m-0" target="_blank" action="https://signupcarrot.com/subscribe" method="get">\
                        <input type="hidden" name="signupcarrot-id" id="signupcarrot-id" value="1">\
                        <input type="hidden" name="signupcarrot-product-select" id="signupcarrot-product-select" value="31161632620646">\
                        <div class="form-group">\
                            <input required maxlength="12" class="form-control form-control-sm" type="text" name="signupcarrot-engraving" id="signupcarrot-engraving" placeholder="Name on Keyring">\
                        </div>\
                        <div class="form-group">\
                            <input required class="form-control form-control-sm" type="email" name="signupcarrot-email" id="signupcarrot-email" placeholder="Email">\
                        </div>\
                        \
                        <div class="form-group">\
                            <input style="background-color: #007bff" class="w-100 btn btn-primary" type="submit" form="signupcarrot-form" value="Subscribe">\
                        </div>\
                    </form>\
                </div>\
            </div>\
        </div>\
    </div>\
</div>\
';// var impressionUrl = '';
// var fileContent = '';
// var appUrl = '';
// var displayFrequency = '';
// var cookieId = '';

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
        onexitpop: function(popup) {
            sendImpressionRequest(carrotId);
        }
    });
    branding = document.getElementsByClassName('signupcarrot-branding')[0];
    branding.setAttribute('style', 'display:none;');
}