const table = document.getElementsByTagName("td");
const form1 = document.getElementById("form1");
const form2 = document.getElementById("form2");

function fillTheForm(){
for (var i = 0; i < table.length; i++) {
    table[i].addEventListener("click", function () {
        if (form1.value == "") {
            form1.value = event.target.id;
        } else if (event.target.id !== form1.value) {
            form2.value = event.target.id;
        }
    });
}
fillTheCell();
}

intersect = function (arr1, arr2) {
    return arr1.filter(function (n) {
        return arr2.indexOf(n) !== -1;
    });
};

function fillTheCell() {
    for (var i = 0; i < table.length; i++) {
        if (table[i].id === white[i]) {
            table[i].className = "red-piece";
        }
    }
}
// fillTheForm();