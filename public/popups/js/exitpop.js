var extend = function(out) {
    out = out || {};
    for (var i = 1; i < arguments.length; i++) {
        if (!arguments[i])
            continue;
        for (var key in arguments[i]) {
            if (arguments[i].hasOwnProperty(key))
            out[key] = arguments[i][key];
        }
    }
    return out;
};
var getCookie = function(name){ 
    var re=new RegExp(name+"=[^;]+", "i"); //construct RE to search for target name/value pair
    if (document.cookie.match(re)) //if cookie found
        return document.cookie.match(re)[0].split("=")[1] //return its value
    return null
};
var setCookie = function(name, value, duration){
    var expirestr='', expiredate=new Date()
    if (typeof duration!="undefined"){ //if set persistent cookie
        var offsetmin=parseInt(duration) * (/hr/i.test(duration)? 60 : /day/i.test(duration)? 60*24 : 1)
        expiredate.setMinutes(expiredate.getMinutes() + offsetmin)
        expirestr="; expires=" + expiredate.toUTCString()
    }
    document.cookie = name+"="+value+"; path=/"+expirestr
};
var getNodes = str => new DOMParser().parseFromString(str, 'text/html').body.childNodes;

var exitpop = {
	defaults: {
        delayshow: 50,
        hideaftershow: true,
        displayfreq: 'always',
        persistcookie: 'test_cookie',
        mobileshowafter: 3000,
        onexitpop: function(){}
    },
    crossdeviceclickevt: 'click',
    
    wrapperid: 'ddexitpopwrapper',
    wrappermarkup: '<div id="ddexitpopwrapper">\
            <div class="veil"></div>\
            <p class="signupcarrot-branding">Free Gift Offer Created Using <a target="_blank" href="https://signupcarrot.com">Signup Carrot</a></p>\
        </div>',
    wrapperref: null,
    contentref: null,
    displaypopup: true, // Boolean to ensure popup is only opened once when showpopup() is called
    delayshowtimer: null, // setTimeout reference to delay showing of exit pop after mouse moves outside  browser top edge
    settings: null,
    ontouchstartAlreadyFired: false,

    detectexit: function(){
        this.delayshowtimer = setTimeout(function(){
            exitpop.showpopup();
            exitpop.settings.onexitpop(exitpop.contentref);
        }, this.settings.delayshow);
    },

    detectenter: function(){
        clearTimeout(this.delayshowtimer)
    },

    showpopup: function(){
        if(this.contentref != null && this.displaypopup == true) {
            this.wrapperref.classList.add('open');
            this.displaypopup = false;
            if(this.settings.hideaftershow) {
                document.body.onmouseleave = function() {}
                document.body.ontouchstart = function() {}
            }
        }
    },

    hidepopup: function(){
        this.wrapperref.classList.remove('open');
        this.displaypopup = true;
    },

    setup: function(){
        // console.log('setup');
        this.contentref.classList.add('animated');
        document.body.appendChild(getNodes(this.wrappermarkup)[0]);
        this.wrapperref = document.getElementById(this.wrapperid);
        this.wrapperref.appendChild(this.contentref);
        var closer = this.wrapperref.querySelectorAll('#signupcarrot-close')[0];
        if (this.crossdeviceclickevt == 'click'){
            closer.onclick = function(){
                exitpop.hidepopup();
            }
        }
        else if(this.crossdeviceclickevt == 'touchstart'){
            closer.ontouchstart = function(){
                exitpop.hidepopup();
            }
        }

        if (this.settings.displayfreq != 'always'){
            if (this.settings.displayfreq == 'session'){
                setCookie(this.settings.persistcookie, 'yes')
            }
            else if (/\d+(hr|day)/i.test(this.settings.displayfreq)){
                setCookie(this.settings.persistcookie, 'yes', this.settings.displayfreq)
                setCookie(this.settings.persistcookie + '_duration', this.settings.displayfreq, this.settings.displayfreq) // remember the duration of persistence
            }
        }
    },

    init: function(options){
        // console.log('init');
        var isTouch = (('ontouchstart' in window) || (navigator.msMaxTouchPoints > 0));
        this.crossdeviceclickevt = isTouch? 'touchstart' : 'click';

        this.settings = extend({}, this.defaults, options);
        var persistduration = getCookie(this.settings.persistcookie + '_duration');
        if (persistduration && (this.settings.displayfreq == 'session' || this.settings.displayfreq != persistduration)){
            setCookie(this.settings.persistcookie, 'yes', -1) // delete persistent cookie (if stored)
            setCookie(this.settings.persistcookie + '_duration', '', -1) // delete persistent cookie duration (if stored)
        }
        this.contentref = document.getElementById(this.settings.contentsource);
        if (this.settings.displayfreq != 'always' && getCookie(this.settings.persistcookie)){
            this.contentref.style.display = 'none';
            return
        }

        document.body.appendChild(this.contentref);
        this.setup();

        document.body.onmouseleave = function(e){
            // console.log('leave');
            exitpop.detectexit(e);
        };
        document.body.onmouseenter = function(e){
            // console.log('enter');
            exitpop.detectenter(e);
        }

        if (this.settings.mobileshowafter > 0){
            document.body.ontouchstart = function (){
                if (exitpop.ontouchstartAlreadyFired == false) {
                    exitpop.ontouchstartAlreadyFired = true;
                    setTimeout(function(){
                        exitpop.detectexit()
                    }, exitpop.settings.mobileshowafter)
                }
            }
        }
    }
}