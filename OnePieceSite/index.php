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
        <br><br>

        <hr>
        <div class="clear"></div>
        
        <h2 class="Naslovi">Characters</h2>
        <section>
        <?php
            $query = "SELECT * FROM onepiece WHERE arhiva=0 AND kategorija='Characters' ORDER BY Id DESC LIMIT 3 ";
            $result = mysqli_query($dbc, $query);
            while($row = mysqli_fetch_array($result)) {
                echo '
                <article>
                    <a href="clanak.php?id='.$row['Id'].'"><img src="'. UPLPATH . $row['slika'] .'" alt="" class="small-img"></a>
                    <a href="clanak.php?id='.$row['Id'].'"><img src="'. UPLPATH . $row['slika'] .'" alt=""></a>
                    <h2>'. $row['naslov'] .'</h2>
                    <p>'. $row['sazetak'] .'</p>
                </article>';
            }
        ?>
        </section>
        <hr>   
        <h2 class="Naslovi">Islands</h2>
        <section>
        <?php
            $query = "SELECT * FROM onepiece WHERE arhiva=0 AND kategorija='Islands' ORDER BY Id DESC LIMIT 3";
            $result = mysqli_query($dbc, $query);
            while($row = mysqli_fetch_array($result)) {
                echo '
                <article>
                    <a href="clanak.php?id='.$row['Id'].'"><img src="'. UPLPATH . $row['slika'] .'" alt=""></a>
                    <h2>'. $row['naslov'] .'</h2>
                    <p>'. $row['sazetak'] .'</p>
                </article>';
            }
        ?>
        </section>
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