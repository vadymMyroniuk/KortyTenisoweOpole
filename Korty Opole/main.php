<?php
session_start();
include('config.php');
if(!isset($_SESSION['username'])):

    header('Location: index.php');
endif;
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
            <a href="index.php"><img id="logo" src="images/logo.png" width="200px"></a>
        </header>
        <div id="main_info_php">
            <a href="logout.php"><button class="user_character_info">Wyloguj się</button></a>
		
<?php
switch ($_SESSION['state']):
case 1:
    include_once ('admin.php');
    break;
case 2:
    include_once ('worker.php');
    break;
default:
    include_once ('user_character.php');
    break;
endswitch;
?>
     </div>
        <footer>
            <ul>
                <li><a href="onas.html">O nas</a></li>
                <li><a href="regulamin.html">Regulamin</a></li>
                <li><a href="contact.html">Kontakt</a></li>
            </ul>
            <a href="http://facebook.com"><i class="fa fa-facebook-f" style="font-size:35px;color:#fff; margin-left: 1000px; margin-top: 15px;"></i></a>
            <a href="http://instagram.com"><i class="fa fa-instagram" style="font-size:35px;color:#fff; margin-left: 20px;"	></i></a>
        </footer>
    </main>
</body>

</html>
