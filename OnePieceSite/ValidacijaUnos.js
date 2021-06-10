document.getElementById("send").onclick = function(event) {
    var slanje_forme = true;


    // Naslov
    var poljeNaslov = document.getElementById("naslov");
    var Naslov = poljeNaslov.value;
    if (Naslov.length < 5 || Naslov.length > 30) {
        slanje_forme = false;
        poljeNaslov.style.border = "1px dashed red";
        document.getElementById("PorukaNaslov").innerHTML = "Naslov mora imati između 5 i 30 znakova!<br>";
    } else {
        poljeNaslov.style.border = "1px solid green";
        document.getElementById("PorukaNaslov").innerHTML = "";
    }

    // Kratki sadržaj
    var poljeKratakSadrzaj = document.getElementById("krataksadrzaj");
    var KratakSadrzaj = poljeKratakSadrzaj.value;
    if (KratakSadrzaj.length < 10 || KratakSadrzaj.length > 100) {
        slanje_forme = false;
        poljeKratakSadrzaj.style.border = "1px dashed red";
        document.getElementById("PorukaKratakSadrzaj").innerHTML = "Kratki sadržaj mora imati između 10 i 100 znakova!<br>";
    } else {
        poljeKratakSadrzaj.style.border = "1px solid green";
        document.getElementById("PorukaKratakSadrzaj").innerHTML = "";
    }
    
    // Sadržaj
    var poljeSadrzaj = document.getElementById("sadrzaj");
    var Sadrzaj = poljeSadrzaj.value;
    if (Sadrzaj.length == 0) {
        slanje_forme = false;
        poljeSadrzaj.style.border = "1px dashed red";
        document.getElementById("PorukaSadrzaj").innerHTML = "Sadržaj mora biti unesen!<br>";
    } else {
        poljeSadrzaj.style.border = "1px solid green";
        document.getElementById("PorukaSadrzaj").innerHTML = "";
    }

    // Kategorija
    var poljeKategorija = document.getElementById("Kategorija");
    var Kategorija = poljeKategorija.value;
    if (poljeKategorija.selectedIndex == 0) {
        slanje_forme = false;
        poljeKategorija.style.border = "1px dashed red";
        document.getElementById("PorukaKategorija").innerHTML = "Kategorija mora biti odabrana!<br>";
    } else {
        poljeKategorija.style.border = "1px solid green";
        document.getElementById("PorukaKategorija").innerHTML = "";
    }

    if (slanje_forme != true) {
        event.preventDefault();
    }

    // Slika
    var poljeSlika = document.getElementById("Slika");
    var Slika = poljeSlika.value;
    if (Slika.length == 0) {
        slanje_forme = false;
        poljeSlika.style.border = "1px dashed red";
        document.getElementById("PorukaSlika").innerHTML = "<br>Slika mora biti unesena!<br>";
    } else {
        poljeSlika.style.border = "1px solid green";
        document.getElementById("PorukaSlika").innerHTML = "";
    }

    

};