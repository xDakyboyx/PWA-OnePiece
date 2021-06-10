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
            <h3 style="color:grey;">Unos:</h3>
            <div class="clear"></div>
            <br><br>

            <?php



                $Naslov = $_POST['Naslov'];
                $Datum = date('Y-m-d');
                $KratkiSadrzaj = $_POST['KratakSadrzaj'];
                $TekstVijesti = $_POST['TekstVijesti'];
                $Kategorija = $_POST['Kategorija'];
                $Slika = $_FILES['Slika']['name'];

                if (isset($_POST['Arhiva'])) {
                    $Arhiva = 1;
                } else {
                    $Arhiva = 0;
                }
                

                $target_dir = 'img/'.$Slika;
                move_uploaded_file($_FILES["Slika"]["tmp_name"], $target_dir);

                $query = "INSERT INTO onepiece(datum,naslov,sazetak,tekst,slika,kategorija,arhiva) 
                    VALUES(?,?,?,?,?,?,?)";
                
                $stmt=mysqli_stmt_init($dbc);

                
                if (mysqli_stmt_prepare($stmt, $query)){

                
                    mysqli_stmt_bind_param($stmt,'ssssssi',$Datum,$Naslov,$KratkiSadrzaj,$TekstVijesti,$Slika,$Kategorija,$Arhiva);
                    mysqli_stmt_execute($stmt);
                } 


                header("Location: /unos.php");

                mysqli_close($dbc);
                
            
            ?>
        
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