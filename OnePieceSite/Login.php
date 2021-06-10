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
    <div class="container--main logg">
        <div style="padding: 1rem;">
            <div>
                <form action="" method="post">
                <label for="Username"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="Username" id="Username" required>

                <label for="Pass"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="Pass" id="Pass" required>
                <span class="LoginPoruka"></span>    
                <button type="submit" class="Login--Button" name="Login">Login</button>
                <button type="reset" class="Reset">Cancel</button>
                
                </form>
                
                <form action="" method="post">
                <button type="submit" name="SignOut" class="Reset">Sign Out</button>
                </form>
                <?php 
                    if (isset($_POST['SignOut'])) {
                        $_SESSION['Username'] = "";
                        $_SESSION['Razina'] = 0;
                    }
                    if (isset($_POST['Login'])) {
                    
                        $Username = $_POST['Username'];
                        $lozinka = $_POST['Pass'];
                    
                        $query = "SELECT KorisnickoIme, Lozinka, Razina FROM korisnik WHERE KorisnickoIme=?";
                                    
                        $stmt=mysqli_stmt_init($dbc);
                
                        if (mysqli_stmt_prepare($stmt, $query)){
                                
                            mysqli_stmt_bind_param($stmt,'s',$Username);
                                
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_store_result($stmt);
                        }

                        mysqli_stmt_bind_result($stmt, $Username, $PassBaza, $Razina);
                        mysqli_stmt_fetch($stmt); 

                            
                        if (mysqli_stmt_num_rows($stmt)>0){
                            if (password_verify($lozinka,$PassBaza)) {
                                
                                echo "Uspješno ste se ulogirali.";
                                $_SESSION['Username'] = $Username;
                                $_SESSION['Razina'] = $Razina;

                            }else {
                                echo "Unijeli ste pogrešno korisničko ime ili lozinku";
                            }

                        } else {
                            echo "Unijeli ste pogrešno korisničko ime ili lozinku";
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