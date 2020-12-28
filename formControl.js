let tabs = document.getElementsByClassName("tab");
let currentTab = 0;
showTab(currentTab);

function showTab(n) {
    tabs[n].style.display = "block";

    if (n === 0) { // changed back button based on tab
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }

    if (n === (tabs.length - 1)) { //change next button text based on tab
        document.getElementById("nextBtn").innerHTML = "Plaats Reserering";
    } else {
        document.getElementById("nextBtn").innerHTML = "Volgende";
    }
}

function nextPrev(n) {
    if (n === 1 && !validate()) return false; //stop if there is an empty input field

    tabs[currentTab].style.display = "none";//turn current tab off
    currentTab = currentTab + n;

    if (currentTab >= tabs.length) { //if last tab and hit next
        let forms = document.getElementsByTagName("form"); //get the first form you find
        forms[0].submit(); //submit said form
        return false;
    }
    showTab(currentTab);
}

function validate() {
    let valid = true;
    let inputs = tabs[currentTab].getElementsByTagName("input"); //get every input in a tab
    for (let i = 0; i < inputs.length; i++) {
        if (inputs[i].value === "") { //for every input field check empty
            inputs[i].className += " invalid";
            valid = false; //if so return false
        }
    }
    return valid; //otherwise return true
}