<?php
    include 'connect.php';
    define('UPLPATH', 'img/');
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=UnifrakturMaguntia">
    <title>Document</title>
</head>
<body>
<header>
    <h1 class="h1-header">One Piece</h1>

    <div class="container--login">
        <span><a href="Login.php">Login</a>  <a href="Register.php">Register</a></span>
        <span>
            <?php
                if (isset($_SESSION['Username']) && isset($_SESSION['Razina'])) {
                    if ($_SESSION['Razina'] > 0) {
                    echo $_SESSION['Username'] . " Admin";
                    } else {
                        echo $_SESSION['Username'];
                    } 
                }
            ?>  
        </span>
        <img src="img/user.png" alt="">
        <div class="clear"></div>
    </div>
    
    <hr class="hr-header">
    <nav>
        <div class="container">
        <ul>
            <a href="index.php"><li>HOME</li></a>
            <a href="kategorija.php?id=Characters"><li>CHARACTERS</li></a>
            <a href="kategorija.php?id=Islands"><li>ISLANDS</li></a>
            <?php
                if (isset($_SESSION['Razina'])) {
                    if ($_SESSION['Razina'] > 0) {
                        echo '<a href="Administracija.php"><li>ADMINISTRACIJA</li></a>';
                    }
                }      
            ?>
            <a href="unos.php"><li>UNOS</li></a>
        </ul>
        </div>
    </nav>
    </header>
    <div class="container--main container--clanak" >
        <div style="padding: 1rem;">
        <h3 style="color:grey;">Unos</h3>
        <div class="clear"></div>
        <br><br>
        <form action="skripta.php" method="post" class="forma--unos" enctype="multipart/form-data">
            
            Naslov: <input type="text" name="Naslov" placeholder="Naslov..." id="naslov"><span id="PorukaNaslov" class="Error--Validacija"></span><br>
            Kratki sadrzaj: <textarea name="KratakSadrzaj" id="krataksadrzaj" cols="30" rows="10" placeholder="Kratki sadrzaj..."></textarea><span id="PorukaKratakSadrzaj" class="Error--Validacija"></span><br>
            Sadržaj: <textarea name="TekstVijesti" id="sadrzaj" cols="30" rows="10" placeholder="Sadržaj..."></textarea><span id="PorukaSadrzaj" class="Error--Validacija"></span><br>
            <select name="Kategorija" id="Kategorija">
                <option value="0" disabled selected>Odabir kategorije</option>
                <option value="Characters">Characters</option>
                <option value="Islands">Islands</option>
            </select><span id="PorukaKategorija" class="Error--Validacija"></span><br><br>
            Slika: <input type="file" name="Slika" id="Slika" accept="image/*" id=""><span id="PorukaSlika" class="Error--Validacija"></span><br><br>
            Pospremiti u arhivu: <input type="checkbox" name="Arhiva" id=""><br><br>
            <input type="reset" value="Poništi" class="submit">
            <input type="submit" value="Pošalji" id="send">
        </form>

        <script src="ValidacijaUnos.js"></script>
        
        </div>
    </div>
    
    <footer>
    <div class="container">
        <hr class="hr-footer">
    </div>
    <h3>Davor Jakopic</h3>
    </footer>
</body>
</html>