<?php
if(isset($_POST['submit_add_court'])):
    $c_name = mysqli_real_escape_string($db, $_POST['kort_name']);
    $c_a = 0;
    if(isset($_POST['c_active'])) $c_a = '1';
    $query = "INSERT INTO `korty` (`id`, `name`) VALUES (NULL, '".$c_name."');";
    if(mysqli_query($db, $query)):
        echo "Kort zostaw dodany";
    else:
        echo "Błąd dodawania kortu";
    endif;
endif;
if(isset($_POST['submit_add_user'])):
    $username = mysqli_real_escape_string($db, $_POST['user_name']);
    $email = mysqli_real_escape_string($db, $_POST['user_email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['user_pwd']);
    $surname =  mysqli_real_escape_string($db, $_POST['user_surname']);
    $phone = "";
    $city = mysqli_real_escape_string($db, $_POST['user_city']);

    $password = md5($password_1);

    $query = "INSERT INTO `uzytkownicy` (`id`, `name`, `surname`, `email`, `password`, `city`, `phone`, `state`) 
                VALUES (NULL, '".$username."', '".$surname."', '".$email."', '".$password."', '".$city."', '".$phone."', '".$_POST['state']."');";
    if(mysqli_query($db, $query)):
        echo "uzytkownik {$username} zostaw dodany";
    else:
        echo "błąd dodawania uzytkownika";
    endif;
endif;
if(isset($_POST['submit_delete_user'])):
    $email = mysqli_real_escape_string($db, $_POST['user_email']);
	$query = "DELETE FROM `uzytkownicy` WHERE `email`='{$email}';";
	if(mysqli_query($db, $query)):
        echo "uzytkownik z  {$email} usunięty";
    else:
        echo "błąd usuwania uzytkownika";
    endif;
endif;

?>
<h1>Add new tenis cort</h1>
<form action="<?=$_SERVER['PHP_SELF']?>" method='post'>
    <input type="text" name="kort_name" placeholder="Name">
    <input type="submit" name="submit_add_court" value="Dodać">
</form>
<br>
<h1>Add new costumer</h1>
<form action="<?=$_SERVER['PHP_SELF']?>" method='post'>
    <input type="text" name="user_name" placeholder="User name">
    <input type="text" name="user_surname" placeholder="User Surname">
    <input type="text" name="user_email" placeholder="User Email">
    <input type="text" name="user_pwd" placeholder="User password">
    <input type="text" name="user_city" placeholder="User city">
	<hr>
    <input type="radio" name="state" value="1">Admin
    <input type="radio" name="state" value="2">Moderator
    <input type="radio" name="state" value="3">Simple User   
	<hr>
    <input type="submit" name="submit_add_user" value="Dodać">
</form>
<h1>Delete costumer</h1>
<form action="<?=$_SERVER['PHP_SELF']?>" method='post'>
    <input type="email" name="user_email" placeholder="User email"> 
	<hr>
    <input type="submit" name="submit_delete_user" value="Usuń">
</form>
