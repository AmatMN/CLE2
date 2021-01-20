let ArchiveSwitch = 0;

let switchBtn = document.getElementById("switch")
switchBtn.addEventListener("click", function () {
    if (this.innerHTML === "Archief") {
        ArchiveSwitch = 1;
        this.innerHTML = "Reserveringen";
        clearField("all");
        fillField();
    } else if (this.innerHTML === "Reserveringen") {
        ArchiveSwitch = 0;
        this.innerHTML = "Archief";
        clearField("all");
        fillField();
    }
});

fillField();

function checkDate(date) {
    let valid = false;
    let unixDate = Date.now(); //get date in seconds since Epoch (1-1-1970)
    let currentDate = new Date(unixDate).toISOString().split('T')[0]; // turn unixDate into yyyy/mm/dd
    if (ArchiveSwitch === 0 && date >= currentDate) {
        valid = true;
    } else if (ArchiveSwitch === 1 && date < currentDate) {
        valid = true;
    }
    return valid;
}

function clearField(target) {
    if (target === "all") {
        let parent = document.getElementById("ress");
        while (parent.lastChild) {
            parent.removeChild(parent.lastChild);
        }
    }
    else {
        let parent = document.getElementById("ress");
        parent.removeChild(target.nextSibling);
        parent.removeChild(target);
    }
}

function fillField() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/GetReservations.php", true);
    xhr.send();

    let data = {};
    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            data = JSON.parse(this.responseText);

            for (let i = 0; i < data.length; i++) {
                if (checkDate(data[i]["RDate"])) { // check if reservation date is today or later
                    let cls1 = document.createAttribute("class");
                    cls1.value = "accordion";
                    let cls2 = document.createAttribute("class");
                    cls2.value = "panel";
                    let id = document.createAttribute("id");
                    id.value = "" + i;

                    let button = document.createElement("button");

                    button.innerHTML = "Dag: " + data[i]["RDate"] + "<br> Tijd: " + data[i]["RTime"] + "<br> Tafel: " + data[i]["RTable"];
                    button.setAttributeNode(cls1);
                    button.addEventListener("click", function () {
                        this.classList.toggle("active");

                        if (panel.style.display === "block") {
                            panel.style.display = "none";
                        } else {
                            panel.style.display = "block";
                        }
                    });

                    let panel = document.createElement("div");

                    panel.innerHTML = "Naam: " + data[i]["RName"] + "<br> Telefoon Nummer: " + data[i]["Tell"] + "<br> E-mail: " + data[i]["Email"] + "<br>";
                    panel.setAttributeNode(cls2);
                    panel.setAttributeNode(id);

                    let deleteBtn = document.createElement("button");
                    deleteBtn.innerHTML = "VERWIJDER RESERVERING";
                    deleteBtn.style.backgroundColor = "#FF0000";

                    deleteBtn.addEventListener("click", function () {
                        let data2 = new FormData();
                        data2.append('RTime', data[i]["RTime"]);
                        data2.append('RTable', data[i]["RTable"]);
                        data2.append('RDate', data[i]["RDate"]);

                        let xhr2 = new XMLHttpRequest();
                        xhr2.open('POST', '../php/DeleteReservations.php', true);

                        xhr2.onreadystatechange = function () {
                            if (xhr2.readyState === 4 && xhr2.status === 200) {
                                console.log("data deleted")
                            }
                        }
                        xhr2.send(data2);

                        clearField(button);
                    });

                    panel.appendChild(deleteBtn);
                    document.getElementById("ress").appendChild(button);
                    document.getElementById("ress").appendChild(panel);
                }
            }
        }
    }
}