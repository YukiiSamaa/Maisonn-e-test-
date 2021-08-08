var nom = document.getElementById("Nom");
var filtreNom = new RegExp("^[A-Z]{1}[a-z]*$");

var prenom = document.getElementById("Prenom");
var filtrePrenom = new RegExp("^[A-Z]{1}[a-z]*$");

var cp = document.getElementById("Code Postal");
var filtreCp = new RegExp("^[0-9]{5}$");

var date = document.getElementById("date");
var filtredate = new RegExp("^[0-9]{2}/[0-9]{2}/[0-9]{4}$");

var adress = document.getElementById("Adresse");
var filtreAd = new RegExp("^[1-9]+ .* [0-9]{5} [A-Z]{1}[a-z]*$");

var mail = document.getElementById("courriel"); 
var filtreMail = new RegExp("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z]+.[a-z]{2,3}$");

var quest = document.getElementById("question"); 
var filtrequest = new RegExp("^.+$");

var s1 = document.getElementById("sexe1");
var s2 = document.getElementById("sexe2");


addEventListener("submit",function(evenement){

if(filtreNom.test(nom.value) == false){
        evenement.preventDefault();
        document.getElementById("alerte-nom").textContent = "Veuillez entrer un nom valide sur le format Nom !";
        nom.focus();
    }
else document.getElementById("alerte-nom").textContent = "";

if(filtrePrenom.test(prenom.value) == false){
    evenement.preventDefault();
    document.getElementById("alerte-prenom").textContent = "Veuillez entrer un prenom valide sur le format Prenom!";
    prenom.focus();
}
else  document.getElementById("alerte-prenom").textContent = "";

if (filtreCp.test(cp.value) == false){
    evenement.preventDefault();  // La méthode preventDefault() de l 'interface Event indique à l'agent utilisateur que si l'événement n'est pas traité explicitement, son action par défaut ne doit pas être prise en compte comme elle le serait normalement 
    document.getElementById("alerte-codep").textContent = "Veuillez entrer un code postal valide à 5 chiffres !"; 
    cp.focus();
}
else document.getElementById("alerte-codep").textContent = "";

if (filtredate.test(date.value) == false){
    evenement.preventDefault(); 
    document.getElementById("alerte-date").textContent = "Veuillez entrer une date de naissance valide format JJ/MM/AAAA !"; 
    date.focus();
}
else document.getElementById("alerte-date").textContent = "";

if (filtreAd.test(adress.value) == false){
    evenement.preventDefault(); 
    document.getElementById("alerte-adresse").textContent = "Veuillez entrer une adresse valide !"; 
    adress.focus();
}
else document.getElementById("alerte-adresse").textContent = "";

if(filtreMail.test(mail.value) == false){
    evenement.preventDefault();
    document.getElementById("alerte-courriel").textContent = "Entrer un mail valide !";
    // window.alert("Entrer un mail valide !");
    mail.focus();
}
else document.getElementById("alerte-courriel").textContent = "";

if (filtrequest.test(quest.value) == false){
    evenement.preventDefault();  // La méthode preventDefault() de l 'interface Event indique à l'agent utilisateur que si l'événement n'est pas traité explicitement, son action par défaut ne doit pas être prise en compte comme elle le serait normalement 
    document.getElementById("alerte-question").textContent = "Veuillez entrer une question !"; 
    quest.focus();
}
else document.getElementById("alerte-question").textContent = "";
/* Pas reussi encore
if((s1.value == "") && (s2.value == "")){
    evenement.preventDefault();
    document.getElementById("alerte-sexe").textContent = "Veuillez choisir un sexe";
}
else document.getElementById("alerte-sexe").textContent = "";
*/
});


document.querySelector("#efface").onclick= function(){

    if(confirm("êtes-vous sur(e)?")){
    document.getElementById("formulaire").reset();
    }
}