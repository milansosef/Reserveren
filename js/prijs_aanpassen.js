/**
 * Created by Milan on 28-1-2017.
 */
var prijs = 0;
var tarief = 12.50;
var valuta = '€';
var prijsElement = document.getElementById("prijs");

//Veranderd de prijs aan de hand van hoeveel checkboxes geselecteerd zijn.
function doalert(checkboxElem) {

    //Als een checkbox checked is, wordt er 12,50 bij de prijs opgeteld
    if (checkboxElem.checked) {
        prijs = prijs + tarief;
        prijsElement.innerHTML = valuta + prijs;

        //Als een checkbox unchecked wordt, gaat er 12,50 van de prijs af.
    } else {
        prijs = prijs - tarief;
        prijsElement.innerHTML = valuta + prijs;
    }
}