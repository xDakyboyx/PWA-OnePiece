<?php
    include 'connect.php';
    define('UPLPATH', 'img/');
    session_start();
    $Kategorija = $_GET['id'];
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

    
        
        <h2 class="Naslovi"><?php echo "$Kategorija" ?></h2>
        <hr>
        <br>
        <?php
            
            $query = "SELECT COUNT(Id) BrojClanaka FROM onepiece WHERE kategorija='$Kategorija'";
            $result = mysqli_query($dbc, $query);
            $Count = mysqli_fetch_array($result); 

            #echo $Count['BrojClanaka'];
            #echo intdiv($Count['BrojClanaka'], 3);
            #echo $Count['BrojClanaka']%3;
           

            if ($Count['BrojClanaka']%3) {
                $Broj = 1;
            } else {
                $Broj = 0;
            }
            #echo (intdiv($Count['BrojClanaka'], 3) + $Broj);
            $query = "SELECT * FROM onepiece WHERE kategorija='$Kategorija'";
            $result = mysqli_query($dbc, $query);

            if ($result) {
                for ($i=0; $i < (intdiv($Count['BrojClanaka'], 3) + $Broj); $i++) {
                echo '<section>'; 

                if ($i == (intdiv($Count['BrojClanaka'], 3) + $Broj)-1) {
                     
                     if ($Count['BrojClanaka']%3 == 0) {
                        for ($j=0; $j < 3; $j++) { 
                            $row = mysqli_fetch_array($result);
                            echo '
                            <article>
                                <a href="clanak.php?id='.$row['Id'].'"><img src="'. UPLPATH . $row['slika'] .'" alt=""></a>
                                <h2>'. $row['naslov'] .'</h2>
                                <p>'. $row['sazetak'] .'</p>
                            </article>'; 
                        }
                     } else {

                        for ($k=0; $k < $Count['BrojClanaka']%3; $k++) {
                            $row = mysqli_fetch_array($result); 
                            echo '
                            <article>
                                <a href="clanak.php?id='.$row['Id'].'"><img src="'. UPLPATH . $row['slika'] .'" alt=""></a>
                                <h2>'. $row['naslov'] .'</h2>
                                <p>'. $row['sazetak'] .'</p>
                            </article>'; 
                        }

                        for ($k=0; $k < 3 - $Count['BrojClanaka']%3; $k++) { 
                            echo '<article></article>'; 
                        }
                     }   
                } else {

                    for ($j=0; $j < 3; $j++) { 
                        $row = mysqli_fetch_array($result);
                        echo '
                        <article>
                            <a href="clanak.php?id='.$row['Id'].'"><img src="'. UPLPATH . $row['slika'] .'" alt=""></a>
                            <h2>'. $row['naslov'] .'</h2>
                            <p>'. $row['sazetak'] .'</p>
                        </article>'; 
                    }

                }     
            
                echo '</section>';
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