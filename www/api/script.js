const HORIZONTAL= 0;
const VERTICAL = 1;

var cellSize;

class Grille {
    constructor(mots) {
        this.mots = mots;
    }
}

class Mot {
    constructor(mot, description, index, direction, x, y) {
      this.mot = mot;
      this.description = description;
      this.index = index;
      this.direction = direction;
      this.x = x;
      this.y = y;
    }
}

var mots = [

    new Mot("rosendael", "Caserne du dunkerquois", 1, VERTICAL, 13, 18),
    new Mot("trois-mats", "Navire à voiles", 2, VERTICAL, 7, 17),
    new Mot("balise", "Nécessaire à la localisation", 3, VERTICAL, 9, 15),
    new Mot("insufflation", "Geste directement après la sortie de l'eau", 5, VERTICAL, 2, 11),
    new Mot("bouee", "Outil de secours", 3, HORIZONTAL, 9, 15),
    new Mot("sauvetage", "Activité principale", 6, HORIZONTAL, 9, 11),
    new Mot("naufrage", "Perte d'un navire par un accident", 7, HORIZONTAL, 2, 10),
    new Mot("manche", "Mer épicontinentale", 8, HORIZONTAL, 1, 4),
    new Mot("canot", "Petite embarcation", 9, HORIZONTAL, 0, 0)

];

var grille = new Grille(mots);

function toString(grille){
    var s = "";

    grille.mots.forEach(mot => {

        s += mot.mot;
    
    });

    return s;
}

var motCroises = document.querySelector("div.mot-croise");

function maxX(){
    var max = 0;

    grille.mots.forEach(mot => {
        if (mot.x > max + mot.mot.length){
            max = mot.x + mot.mot.length;
        }
    });

    return max;
}

function maxY(){
    var max = 0;

    grille.mots.forEach(mot => {
        if (mot.y > max){
            max = mot.y;
        }
    });

    return max;
}

function setCellSize(){
    cellSize = maxX();

    if (maxY() > cellSize)
        cellSize = maxY();

    document.body.setAttribute("style", "--cellSize:calc(100%/" + cellSize + ")");
}

setCellSize();

function loadMotCroises(){

    grille.mots.forEach(mot => {

        var div = document.createElement("div");
        var div2 = document.createElement("div");
        var input = document.createElement("input");
        div.classList.add('case');
        div2.classList.add('case-indice');
        div.setAttribute('style', "left:calc(("+(mot.x) + "/" + cellSize + ")*100%);" + "bottom:calc(("+(mot.y) + "/" + cellSize + ")*100%);");
        div.id = "cell" + mot.x + "" + mot.y;
        input.classList.add('case');
        input.setAttribute('maxlength', 1);
        input.setAttribute('oninput', "onChangeCellule(\"" + div.id + "\");");

        div2.innerText = mot.index;
        div.appendChild(input);
        div.appendChild(div2);
        motCroises.appendChild(div);

        for (var i = 1; i < mot.mot.length ; i++) {

            var div = document.createElement("div");
            var input = document.createElement("input");
            div.classList.add('case');

            if (mot.direction == VERTICAL){
                div.setAttribute('style', "left:calc(("+(mot.x) + "/" + cellSize + ")*100%);" + "bottom:calc(("+(mot.y - i) + "/" + cellSize + ")*100%);");
                div.id = "cell" + mot.x + "" + (mot.y - i);
            }

            else{
                div.setAttribute('style', "left:calc(("+(mot.x + i) + "/" + cellSize + ")*100%);" + "bottom:calc(("+(mot.y) + "/" + cellSize + ")*100%);");
                div.id = "cell" + mot.x + i + "" + mot.y;
            }
    
            input.classList.add('case');
            input.setAttribute('maxlength', 1);
            input.setAttribute('oninput', "onChangeCellule(\"" + div.id + "\");");
    
            div.appendChild(input);
            motCroises.appendChild(div);

        }
    
    });
}

function checkMotCroise(){

    var motsInputs = motCroises.querySelectorAll("div.case");

    var s = "";

    motsInputs.forEach(minput => {

        s += minput.firstChild.value;
    
    });

    return s;
}

function writeDescriptionMotCroise(){
    grille.mots.forEach(mot => {

        var div = document.createElement("div");
        div.classList.add('description');
        div.innerText = mot.index + ". " + mot.description;

        if(mot.direction == HORIZONTAL){
            document.querySelector("div.horizontal").appendChild(div);
        }

        else{
            document.querySelector("div.vertical").appendChild(div);
        }
    });
}

loadMotCroises();
writeDescriptionMotCroise();

var valider = document.querySelector('button#valider');
var resultat = document.querySelector('div.resultat');

valider.addEventListener("click", () => {
    if(checkMotCroise().toLowerCase() == toString(grille))
        resultat.innerText = "Bravo ! Vous avez fini le mot croisé";
    else
        resultat.innerText = "Le mot croisé n'est pas fini !";
}, false);

function onChangeCellule(id){
    var motsInputs = motCroises.querySelectorAll("#" + id);

    motsInputs.forEach(minput => {

        //minput.firstChild.value = "0";
    
    });
}