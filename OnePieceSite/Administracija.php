<?php
    include 'connect.php';
    define('UPLPATH', 'img/');
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css" type="text/css">
    <link rel="stylesheet" href="/Split.css" type="text/css">
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
    <div class="container--main">
        <div style="padding: 1rem;">
        
        <?php 
        
        $query = "SELECT * FROM onepiece";
        $result = mysqli_query($dbc, $query);
        while($row = mysqli_fetch_array($result)) {

            echo '<hr class="hr--Administracija">
                <form enctype="multipart/form-data" action="" method="POST">
                <div class="form-item">
                <label for="title">Naslov:</label>
                <div class="form-field">
                <input type="text" name="naslov" class="form-field-textual"
                value="'.$row['naslov'].'">
                </div>
                </div>
                <div class="form-item">
                <label for="about">Kratki sadržaj (do 50
                znakova):</label>
                <div class="form-field">
                <textarea name="sazetak" id="" cols="30" rows="10" class="formfield-textual">'.$row['sazetak'].'</textarea>
                </div>
                </div>
                <div class="form-item">
                <label for="content">Sadržaj:</label>
                <div class="form-field">
                <textarea name="tekst" id="" cols="30" rows="10" class="formfield-textual">'.$row['tekst'].'</textarea>
                </div>
                </div>
                <div class="form-item">
                <label for="pphoto">Slika:</label>
                <div class="form-field">
                <input type="file" class="input-text" id="slika"
                value="'.$row['slika'].'" name="slika" accept="image/*" value="/img/'. $row['slika'] .'" > <br><img src="' . UPLPATH .
                $row['slika'] . '" width=100px>
                </div>
                </div>
                <div class="form-item">
                <label for="kategorija">Kategorija:</label>
                <div class="form-field">
                <select name="kategorija" id="" class="form-field-textual"
                value="'.$row['kategorija'].'">
                <option value="Characters">Characters</option>
                <option value="Islands">Islands</option>
                </select>
                </div>
                </div>
                <div class="form-item">
                <label>Spremiti u arhivu:</label>
                <div class="form-field">';
            if($row['arhiva'] == 0) {
                echo '<input type="checkbox" name="arhiva" id="archive"/>
                Arhiviraj?';
            } else {
                echo '<input type="checkbox" name="arhiva" id="archive"
                checked/> Arhiviraj?';
            }
            echo '</div>
                </div>
                <div class="form-item">
                <input type="hidden" name="Id" class="form-field-textual"
                value="'.$row['Id'].'">
                <button type="reset" value="Poništi">Poništi</button>
                <button type="submit" name="update" value="Prihvati">
                Izmjeni</button>
                <button type="submit" name="delete" value="Izbriši">
                Izbriši</button>
                </div>
                </form>';
            }


            if(isset($_POST['delete'])){
                $Id=$_POST['Id'];
                $query = "DELETE FROM onepiece WHERE Id=$Id ";
                $result = mysqli_query($dbc, $query);
            }
               
            if (isset($_POST['update'])) {

                $Naslov = $_POST['naslov'];
                $KratkiSadrzaj = $_POST['sazetak'];
                $TekstVijesti = $_POST['tekst'];
                $Kategorija = $_POST['kategorija'];
                $Slika = $_FILES['slika']['name'];  
    
                if (isset($_POST['arhiva'])) {
                    $Arhiva = 1;
                } else {
                    $Arhiva = 0;
                }
                

                $target_dir = 'img/'.$Slika;
                move_uploaded_file($_FILES["slika"]["tmp_name"], $target_dir);
                

                $Id=$_POST['Id'];
                $query = "UPDATE onepiece SET naslov=?,sazetak=?,tekst=?,slika=?,kategorija=?,arhiva=? WHERE Id=$Id ";

                $stmt=mysqli_stmt_init($dbc);
                if (mysqli_stmt_prepare($stmt, $query)){
                    mysqli_stmt_bind_param($stmt,'sssssi',$Naslov,$KratkiSadrzaj,$TekstVijesti,$Slika,$Kategorija,$Arhiva);
                    mysqli_stmt_execute($stmt);
                } 


            }
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