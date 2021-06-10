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
    <div class="container--main regg">
        <div style="padding: 1rem;">
            <div>
                <form action="" method="post">
                <label for="Ime">Ime: </label>
                <input type="text" name="Ime" id="Ime" required><br>

                <label for="Prezime">Prezime: </label>
                <input type="text" name="Prezime" id="Prezime" required><br>

                <label for="Username">Username: </label>
                <input type="text" name="Username" id="Username" required><br>
                
                <label for="Pass">Lozinka: </label>
                <input type="password" name="Pass" id="Pass" required><br>

                <label for="PassPon">Ponovite Lozinku: </label>
                <input type="password" name="PassPon" id="PassPon" required><br> 

                <button type="submit" class="Login--Button" name="Register" required>Register</button>
                <button type="reset" class="Reset">Cancel</button>
                </form>
                <?php 
                    if (isset($_POST['Register'])) {
                        
                        $Ime = $_POST['Ime'];
                        $Prezime = $_POST['Prezime'];
                        $Username = $_POST['Username'];
                        $lozinka = $_POST['Pass'];
                        $PonLozinka = $_POST['PassPon'];
                        $hashed_password = password_hash($lozinka, CRYPT_BLOWFISH);
                    
                            
                        $query = "SELECT KorisnickoIme FROM korisnik";
                        $result = mysqli_query($dbc, $query);

                        if ($result) {
                            $PostojiIme = FALSE; 
                            while ($row = mysqli_fetch_array($result)) {
                                if ($row['KorisnickoIme'] == $Username) {
                                    $PostojiIme = TRUE;
                                }    
                            }
                            if ($PostojiIme) {
                                echo "Korisničko ime se već koristi";
                            } else {
                                
                                if ($lozinka != $PonLozinka) {
                                    echo "Lozinke se ne podudaraju!";
                                } else {
                                    
                                    $sql = "INSERT INTO korisnik(KorisnickoIme, Lozinka, Ime, Prezime) VALUES(?, ?, ?, ?)";
                                    
                                    $stmt=mysqli_stmt_init($dbc);

                                    if (mysqli_stmt_prepare($stmt, $sql)){

                                        mysqli_stmt_bind_param($stmt,'ssss',$Username,$hashed_password, $Ime, $Prezime);
                                        mysqli_stmt_execute($stmt);
                                    } 
                                    
                                    
                                    
                                    if ($result) {
                                        
                                        echo "Registracija je uspješna"; 
                                        
                                    }
                                    else {
                                        echo "Result couldnt go thru: ". mysqli_error($dbc);
                                    }
                                }
                                

                            }
                        }
                        else {
                        echo "Result couldnt go thru: ". mysqli_error($dbc);
                        }
                                        
                    }
                ?>
            </div>
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