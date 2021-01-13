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

    if (n === -1) {
        emptyNextTab(currentTab);
    }

    tabs[currentTab].style.display = "none";//turn current tab off
    currentTab = currentTab + n;

    if (currentTab === 1) {
        CheckAvailable();
    }

    if (currentTab >= tabs.length) { //if last tab and hit next
        let forms = document.getElementsByTagName("form"); //get the first form you find (there is only 1 form)
        forms[0].submit(); //submit said form
        return false;
    }
    showTab(currentTab);
}

function emptyNextTab(tab) {
    console.log("empty tab " + tab);
    let inputs = tabs[tab].getElementsByTagName("input");
    for (let i = 0; i < inputs.length; i++) {
        if (!(inputs[i].type === "radio")) {
            inputs[i].value = "";
        } else {
            inputs[i].checked = false;
        }
    }
}

function validate() {
    let valid = true;
    let inputs = tabs[currentTab].getElementsByTagName("input"); //get every input in a tab
    for (let i = 0; i < inputs.length; i++) {
        if (!(inputs[i].type === "radio")) {
            if (inputs[i].value === "") { //for every input field check empty
                inputs[i].className += " invalid"; //turn input red
                valid = false; //if so return false
            } else if (inputs[i].id === "RTime") { //if time--
                if (inputs[i].value < inputs[i].min || inputs[i].value > inputs[i].max) { // -- is outside open hours return false
                    inputs[i].className += " invalid";
                    valid = false;
                }
            }
        } else {
            if (!inputs[i].checked) { //check if a radio is checked
                valid = false;
            } else { //if one is found stop checking and return true
                valid = true;
                break;
            }
        }
    }
    return valid; //otherwise return true
}

function CheckAvailable() {
    let date = document.getElementById("RDate").value;
    let time = document.getElementById("RTime").value;
    let amount = document.getElementById("PAmount").value;

    let ajax = new XMLHttpRequest();
    ajax.open("POST","php/GetReservations.php",true);
    ajax.send();

    let data = {};
    ajax.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            data = JSON.parse(this.responseText);

            let inputs = tabs[currentTab].getElementsByTagName("input");

            for (let i = 0; i < inputs.length; i++) {
                if (inputs[i].type === "radio") {
                    if (amount <= 4 || inputs[i].value === "4") {
                        for (let j = 0; j < data.length; j++) {
                            let beginTime = convertTime(data[j]["RTime"], -1);
                            let endTime = convertTime(data[j]["RTime"], +1);

                            // checking for reservations on the same day && checking for reservations within an hour before or after this one && checking if that reservation is for this table
                            if (date === data[j]["RDate"] && (time >= beginTime) && (time <= endTime) && inputs[i].value === data[j]["RTable"]) {
                                inputs[i].disabled = true;
                                inputs[i].nextElementSibling.style = "background-color: red;"
                                break;
                            } else {
                                inputs[i].disabled = false;
                                inputs[i].nextElementSibling.style = "";
                            }
                        }
                    }
                    else {
                        inputs[i].disabled = true;
                        inputs[i].nextElementSibling.style = "background-color: red;"
                    }
                }
            }
        }
    }
}

function convertTime(time, inc){
    let t = time.split(":");
    let h = Number(t[0]);
    h += inc;
    return (h+"").padStart(2,"0")  + ":" + t[1];
}