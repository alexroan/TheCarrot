// const TITLE = "Get a free personalised keyring";
// const SUBTITLE = "when you sign up to our newsletter";
// const MERGE_FIELDS = [];
// const SELECTED_KEYRING_ID = 4;
// const PRODUCTS = [
//     {"name":"Black","value":"31280555884646","image":"http:\/\/thecarrot.local\/popups\/images\/keyring-black.png"},
//     {"name":"Blue","value":"31280555524198","image":"http:\/\/thecarrot.local\/popups\/images\/keyring-blue.png"},
//     {"name":"Burgundy","value":"31280559587430","image":"http:\/\/thecarrot.local\/popups\/images\/keyring-burgundy.png"},
//     {"name":"Green","value":"31280549134438","image":"http:\/\/thecarrot.local\/popups\/images\/keyring-green.png"},
//     {"name":"Orange","value":"31280549658726","image":"http:\/\/thecarrot.local\/popups\/images\/keyring-orange.png"},
//     {"name":"Pink","value":"31280548544614","image":"http:\/\/thecarrot.local\/popups\/images\/keyring-pink.png"},
//     {"name":"Purple","value":"31280571023462","image":"http:\/\/thecarrot.local\/popups\/images\/keyring-purple.png"},
//     {"name":"Red","value":"31280540811366","image":"http:\/\/thecarrot.local\/popups\/images\/keyring-red.png"},
//     {"name":"Teal","value":"31280566927462","image":"http:\/\/thecarrot.local\/popups\/images\/keyring-teal.png"}];
// window.carrotId = "1";
// window.discountCode = "CRT-56E2436E";
// const ROOT_URL = 'http://thecarrot.local';
// window.impressionUrl = ROOT_URL + '/api/impression';
// window.subscribeUrl = ROOT_URL + '/subscribe';

function addToHead(element) {
    document.head.appendChild(element);
}

function addToBody(element) {
    document.body.appendChild(element);
}

function addScript(src, content) {
    var script = document.createElement("script");
    if(src !== null && src !== "" && src !== undefined){
        script.setAttribute('src', src);
    }
    if(content !== null && content !== undefined) {
        script.innerHTML = content;
    }
    addToHead(script);
}

function addLink(rel, href) {
    var link = document.createElement("link");
    link.setAttribute('rel', rel);
    link.setAttribute('href', href);
    addToHead(link);
}

function addDiv(id, divClass, content) {
    var div = document.createElement("div");
    div.setAttribute('id', id);
    div.setAttribute('class', divClass);
    div.innerHTML = content;
    addToBody(div);
}

function constructModal() {
    //construct merge field inputs
    let mergeFields = "";
    for(var key in MERGE_FIELDS) {
        let field = MERGE_FIELDS[key];
        if ('choices' in field) {
            mergeFields += "<select form='thecarrot-subscribe-form' name='MERGE||" + field['tag'] + "' id='MERGE||" + field['tag'] + "' class='dropdown' required>";
            mergeFields += "<option value='' disabled selected >" + field['placeholder'] + "</option>";
            for (choice in field['choices']) {
                let choiceText = field['choices'][choice];
                mergeFields += "<option value='" + choiceText + "'>" + choiceText + "</option>"
            }
            mergeFields += "</select>";
        }
        else {
            mergeFields += "<input type='" + field['type'] + "' name='MERGE||" + field['tag'] + "' id='MERGE||" + field['tag'] + "' placeholder='" + field['placeholder'] + "' required></input>"
        }
    }

    //construct keyring options
    let keyrings = "";
    let SELECTED_KEYRING_IMG;
    for (let i = 0; i < PRODUCTS.length; i++) {
        const keyring = PRODUCTS[i];
        let keyringName = keyring['name'];
        let keyringValue = keyring['value'];
        let keyringImage = keyring['image'];
        let keyringColour = keyring['colour'];
        if (SELECTED_KEYRING_ID == keyring['id']) {
            keyrings += "<option selected value='" + keyringValue + "' data-image='" + keyringImage + "'>" + keyringName + "</option>";
            SELECTED_KEYRING_IMG = keyringImage;
            SELECTED_COLOUR = keyringColour;
        }
        else{
            keyrings += "<option value='" + keyringValue + "' data-image='" + keyringImage + "'>" + keyringName + "</option>";
        }
    }

    //Put parts together
    let content = "<div class='thecarrot-modal-header'>\
            <h1>" + TITLE + "</h1>\
            <h2>" + SUBTITLE + "</h2>\
        </div>\
        <div class='thecarrot-modal-body'>\
            <div class='thecarrot-modal-body-left thecarrot-split-div'>\
                <div class='thecarrot-modal-body-left-content thecarrot-split-content'>\
                    <img id='thecarrot-selected-colour-image' src='" + SELECTED_KEYRING_IMG + "' />\
                    <img id='thecarrot-price-cut' src='" + ROOT_URL + "/popups/images/pricecut.png' />\
                    <input form='thecarrot-subscribe-form' type='text' name='product_text' id='product_text' placeholder='KEYRING NAME' required></input>\
                    <div class='thecarrot-colour-chooser-wrapper'>\
                        <select form='thecarrot-subscribe-form' name='product_id' id='thecarrot-color-chooser' class='image-picker' required>"
                             + keyrings +
                        "</select>\
                    </div>\
                </div>\
            </div>\
            <div class='thecarrot-modal-body-right thecarrot-split-div'>\
                <div class='thecarrot-modal-body-right-content thecarrot-split-content'>\
                    <form target='_blank' method='get' action='" + window.subscribeUrl + "' id='thecarrot-subscribe-form'>\
                        <input type='hidden' name='carrot_id' id='carrot_id' value='" + window.carrotId + "'></input>\
                        <div class='thecarrot-subscribe-form-fields'>\
                            <input type='email' name='email_address' id='email_address' placeholder='EMAIL' required></input>"
                            + mergeFields +
                        "</div>\
                        <div class='thecarrot-subscribe-form-text'>\
                            <p>Delivered to your door</p>\
                            <p>in 3-5 days</p>\
                            <a id='thecarrot-subscribe-claim' class='calltoaction hidden' target='_blank'>CLAIM NOW!</a>\
                            <input style='background-color:" + SELECTED_COLOUR + "' id='thecarrot-subscribe-submit' class='calltoaction' type='submit' value='SUBSCRIBE'></input>\
                        </div>\
                    </form>\
                </div>\
            </div>\
        </div>"
    return content;
}

document.addEventListener('DOMContentLoaded', function(event) {
    //Add CSS to head
    let cssLocation = ROOT_URL + "/popups/css/ddexitpop.css"
    addLink("stylesheet", cssLocation);
    //Add JS to head
    scriptLocation = ROOT_URL + "/popups/js/ddexitpop.js";
    addScript(scriptLocation);
    //Add modal div to body
    addDiv("ddexitpop1", "ddexitpop", constructModal());
});