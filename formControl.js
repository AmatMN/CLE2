let currentTab = 0;
showTab(currentTab);

function showTab(n) {
    let tabs = document.getElementsByClassName("tab");
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