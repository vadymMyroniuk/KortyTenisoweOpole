<?php
session_start();
include('config.php');
if(isset($_SESSION['username'])) header('Location: main.php');
if(isset($_POST['submit'])):
    if(!empty($_POST['email'])&&!empty($_POST['password'])):
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        $password = md5($password);
        $query = "SELECT * FROM uzytkownicy WHERE email='$email' AND password='$password'";

        $results = mysqli_query($db, $query);

        if (mysqli_num_rows($results) == 1) {
            $user = mysqli_fetch_assoc($results);
            $_SESSION['username'] = $user['name'];
            $_SESSION['state'] = $user['state'];
            $_SESSION['email'] = $email;
            $_SESSION['uid'] = $user['id'];
            $_SESSION['success'] = "You are now logged in";
            header('Location: main.php');
        }
    endif;
else:
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta content="tennis courts">
    <title>Korty Opole</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Patua+One" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <main>
        <header>
            <a href="index.php"><img id="logo" src="images/logo.png" width="200px"></a>
        </header>
        <div id="main_info2">
            <div id="login_inf">
                <form id="login_form" method="post" action="login.php">
                    <h1 style="font-family: 'Patua One', cursive;">Logowanie</h1>
                    <span>email</span> <input type="email" id="email" name="email">
                    <br>
                    <span>hasło</span> <input type="password" id="password" name="password">
                    <BR>
                    <input type="submit" name="submit" id="login_but" value="Zaloguj się">
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
<?php
    endif;
?>