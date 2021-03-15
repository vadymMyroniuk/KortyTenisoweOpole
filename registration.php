<?php
session_start();
include('config.php');
if(isset($_SESSION['username'])) header("Location: main.php");
if(isset($_POST['reg_user'])){
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $surname =  mysqli_real_escape_string($db, $_POST['surname']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $city = mysqli_real_escape_string($db, $_POST['city']);
    $password = md5($password_1);

    $query = "INSERT INTO `uzytkownicy` ('name', 'email', 'password', 'surname', 'state', 'city', 'phone' ) VALUES('{$username}', '{$email}', '{$password}', '{$surname}', '3','{$city}', '{$phone}');";
    // $query = "INSERT INTO `uzytkownicy` (`id`, `name`, `surname`, `email`, `password`, `city`, `phone`, `state`) 
    // VALUES (NULL, '".$username."', '".$surname."', '".$email."', '".$password."', '".$city."', '".$phone."', '3');";
    if(mysqli_query($db, $query)){
        echo "Welcome";
        $_SESSION['username'] = $username;
        $_SESSION['state'] = $user['state'];
        $_SESSION['email'] = $email;
        $_SESSION['success'] = "You are now logged in";
        header('location: main.php');
    }
    else{
    echo "Jakiś błąd";
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta content="tennis courts">
    <title>Korty Opole</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <!--Font family for the heading-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <main>
        <header>
            <a href="index.html"><img id="logo" src="images/logo.png" width="200px"></a>
        </header>
        <div id="main_info3">
            <div id="register_inf">
                <form id="register_form" method="post" action="registration.php">
				
                    <h4 id="konto"><i class="fa fa-address-book" style="font-size: 20px;"></i> Załóż konto</h4>
                    <span class="text_for_input">adres email</span><input type="text" id="email" name="email">
                    <br>
                    <span class="text_for_input">hasło</span><input type="password" id="password" name="password_1">
                    <br>
                    <span class="text_for_input">powtórz hasło</span><input type="password" id="password_check" name="password_2">
                    <br>
                    <h4 id="twoj_profil">Twój profil</h4>
                    <span class="text_for_input">imie</span><input type="text" id="name" name="username">
                    <br>
                    <span class="text_for_input">nazwisko</span><input type="text" id="surname" name="surname">
                    <br>
                    <span class="text_for_input">numer telefonu</span><input type="tel" id="telephone" name="phone">
                    <br>
                    <span class="text_for_input">miasto</span><input type="text" id="city" name="city">
                    <br>
                    <br>
                    <br>
                    <br>
                    <input type="radio" name="accept" value="accepted"><span class="text_for_input">Wyrażam zgodę na przetwarzanie danych osobowych</span>
                    <br>
                    <br>
                    <input type="submit" id="login_but" name="reg_user" value="Zarejestruj się">
                </form>
            </div>
        </div>
        <footer>
            <ul>
                <li><a href="onas.html">O nas</a></li>
                <li><a href="regulamin.html">Regulamin</a></li>
                <li><a href="contact.html">Kontakt</a></li>
            </ul>
            <a href="http://facebook.com"><i class="fa fa-facebook-f" style="font-size:35px;color:#fff; margin-left: 1050px; margin-top: 15px;"></i></a>
            <a href="http://instagram.com"><i class="fa fa-instagram" style="font-size:35px;color:#fff; margin-left: 20px;"	></i></a>
        </footer>
    </main>
</body>