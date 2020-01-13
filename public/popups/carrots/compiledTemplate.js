// var impressionUrl = '';
// var fileContent = '';

document.addEventListener('DOMContentLoaded', function(event) {
    if(typeof jQuery=='undefined') {
        var headTag = document.getElementsByTagName("head")[0];   
        var jqTag = document.createElement('script');
        jqTag.type = 'text/javascript';
        jqTag.src = 'https://code.jquery.com/jquery-3.4.1.min.js';
        jqTag.onload = loadDDExitPopLibrary;
        headTag.appendChild(jqTag);
    } else {
        loadDDExitPopLibrary();
    }    
});

function loadDDExitPopLibrary() {
    if(typeof ddexitpop=='undefined') {
        var headTag = document.getElementsByTagName("head")[0];
        var ddTag = document.createElement('script');
        ddTag.type = 'text/javascript';
        ddTag.src = 'http://modalgenerator.local/ddexitpop/ddexitpop.js';
        ddTag.onload = loadPopperJs;
        headTag.appendChild(ddTag);
    }
    else{
        loadPopperJs();
    }
}

function loadPopperJs() {
    var headTag = document.getElementsByTagName("head")[0];
    var ddTag = document.createElement('script');
    ddTag.type = 'text/javascript';
    ddTag.src = 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js';
    ddTag.onload = loadBootstrapJs;
    headTag.appendChild(ddTag);
}

function loadBootstrapJs() {
    var headTag = document.getElementsByTagName("head")[0];
    var ddTag = document.createElement('script');
    ddTag.type = 'text/javascript';
    ddTag.src = 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js';
    ddTag.onload = loadHTML;
    headTag.appendChild(ddTag);
}

function loadHTML() {
    var div = document.createElement("div");
    div.setAttribute('id', 'signupcarrot');
    div.setAttribute('class', 'signupcarrot')
    div.innerHTML = fileContent;
    document.body.appendChild(div);
    initializePopup();
}

function initializePopup() {
    jQuery(function(){
        var carrotId = jQuery('#signupcarrot-id').val();
        ddexitpop.init({
            contentsource: ['id', 'signupcarrot'],
            fxclass: 'random',
            displayfreq: 'always',
            hideaftershow: true,
            onddexitpop: function($popup){
                data = {'carrot-id': carrotId};
                headers = {
                    'Api-Token': 'alex',
                }
                window.jQuery.ajax({
                    type: 'POST',
                    headers: headers,
                    url: impressionUrl,
                    data: data,
                    success: function(msg) {
                        console.log('YAY', msg);
                    },
                    error: function(msg) {
                        console.error('BOO', msg);
                    }
                });
            }
        })
    });
}