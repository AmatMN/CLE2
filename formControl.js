let tabs = document.getElementsByClassName("tab");
let currentTab = 0;
showTab(currentTab);

function showTab(n) {
    tabs[n].style.display = "block";

    if (n === 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }

    if (n === (tabs.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Plaats Reserering";
    } else {
        document.getElementById("nextBtn").innerHTML = "Volgende";
    }
}

function nextPrev(n) {
    if (n === 1 && !validate()) return false;

    tabs[currentTab].style.display = "none";
    currentTab = currentTab + n;

    if (currentTab >= tabs.length) {
        let forms = document.getElementsByTagName("form");
        forms[0].submit();
        return false;
    }
    showTab(currentTab);
}

function validate() {
    let valid = true;
    let inputs = tabs[currentTab].getElementsByTagName("input");
    for (let i = 0; i < inputs.length; i++) {
        if (inputs[i].value === "") {
            inputs[i].className += " invalid";
            valid = false;
        }
    }
    return valid;
}