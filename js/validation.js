
function validateName() {
    const pattern = /^[a-zA-Z ]+$/;
    // console.log("hello");
    if(document.getElementById("name").value == ""){
        document.getElementById("nameValid").innerHTML = " * Please enter your Make/Model!";
    } else if(!pattern.test(String(document.getElementById("name").value))) {
        document.getElementById("nameValid").innerHTML = " * Invalid format! (Must be alphabetic)";
    } else {
        document.getElementById("nameValid").innerHTML = "&#10004;";
    }
}

function validateCategory() {
    const pattern = /^[0-9]{1,2}$/;
    // alert("hello");
    if(document.getElementById("category_id").value == ""){
        document.getElementById("categoryValid").innerHTML = " * Please enter your Bike Category!";
    } else if(!pattern.test(String(document.getElementById("category_id").value))) {
        document.getElementById("categoryValid").innerHTML = " * Invalid format! (eg; 1-10)";
    } else {
        document.getElementById("categoryValid").innerHTML = "&#10004;";
    }
}

function validateEngineSize() {
    const pattern = /^[0-9]{2,4}cc$/;
    // alert(pattern.test(String(document.getElementById("engineSize").value)));
    if(document.getElementById("engineSize").value == ""){
        document.getElementById("engineSizeValid").innerHTML = " * Please enter your Engine Size!";
        // document.getElementById("engineSizeValid").style = "color:red;"
    } else if(!pattern.test(String(document.getElementById("engineSize").value))) {
        document.getElementById("engineSizeValid").innerHTML = " * Invalid format! (eg; 125cc or 500cc)";
    } else {
        document.getElementById("engineSizeValid").innerHTML = "&#10004;";
    }
    // alert("hello");
}

function validateListPrice() {
    // alert("Helllo");
    const pattern = /^([0-9]+)([.]?)([0-9]{2})$/;
    // const pattern = "\d{1,3}(?:[.,]\d{3})*(?:[.,]\d{2})";
    if(document.getElementById("listPrice").value == ""){
        document.getElementById("listPriceValid").innerHTML = " * Please enter your List Price!";
    } else if(!pattern.test(String(document.getElementById("listPrice").value))) {
        // console.log("Helllo");
        document.getElementById("listPriceValid").innerHTML = " * Invalid format! (Please enter numeric value)";
    } else {
        document.getElementById("listPriceValid").innerHTML = "&#10004;";
    }
}

function validateServiceDate() {
    const pattern = /^(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))$/;
    if(document.getElementById("serviceDate").value == ""){
        document.getElementById("serviceDateValid").innerHTML = " * Please enter your last Service Date!";
    } else if(!pattern.test(String(document.getElementById("serviceDate").value))) {
        document.getElementById("serviceDateValid").innerHTML = " * Invalid format! (YYYY-MM-DD)";
    } else {
        document.getElementById("serviceDateValid").innerHTML = "&#10004;";
    }
}

function validateForm() {
    if(document.getElementById("name") != null){
        if(document.getElementById("category_id") != null){
            validateCategory();
        }
        validateName();
        validateEngineSize();
        validateListPrice();
        validateServiceDate();
    }
}

function loginButtons(loggedIn)
{
    alert(loggedIn);
    if(loggedIn == 1)
    {  
        document.getElementById("logout").style.visibility = visible;
        document.getElementById("login").style.visibility = hidden;
        document.getElementById("register").style.visibility = hidden;
    } else {
        document.getElementById("login").style.visibility = visible;
        document.getElementById("register").style.visibility = visible;
        document.getElementById("logout").style.visibility = hidden;
    }
}