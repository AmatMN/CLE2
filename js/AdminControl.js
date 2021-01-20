let ajax = new XMLHttpRequest();
ajax.open("POST","../php/GetReservations.php",true);
ajax.send();

let data = {};
ajax.onreadystatechange = function() {
    if (this.readyState === 4 && this.status === 200) {
        data = JSON.parse(this.responseText);

        for(let i = 0; i < data.length; i++) {
            let unixDate = Date.now(); //get date in seconds since Epoch (1-1-1970)
            let currentDate = new Date(unixDate).toISOString().split('T')[0]; // turn unixDate into yyyy/mm/dd
            if(data[i]["RDate"] >= currentDate) { // check if reservation date is today or later
                let cls1 = document.createAttribute("class");
                cls1.value = "accordion";
                let cls2 = document.createAttribute("class");
                cls2.value = "panel";

                let button = document.createElement("button");
                button.innerHTML = "Dag: " + data[i]["RDate"] + "<br> Tijd: " + data[i]["RTime"] + "<br> Tafel: " + data[i]["RTable"];
                button.setAttributeNode(cls1);

                let panel = document.createElement("div");
                panel.innerHTML = "Naam: " + data[i]["RName"] + "<br> Telefoon Nummer: " + data[i]["Tell"] + "<br> E-mail: " + data[i]["Email"];
                panel.setAttributeNode(cls2);

                button.addEventListener("click", function () {
                    this.classList.toggle("active");

                    if (panel.style.display === "block") {
                        panel.style.display = "none";
                    } else {
                        panel.style.display = "block";
                    }
                });

                document.getElementById("ress").appendChild(button);
                document.getElementById("ress").appendChild(panel);
            }
        }
    }
}