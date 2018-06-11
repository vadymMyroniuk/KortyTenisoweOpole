<?php
if(isset($_POST['submit_add_court'])):
    $c_name = mysqli_real_escape_string($db, $_POST['kort_name']);
    $c_a = 0;
    if(isset($_POST['c_active'])) $c_a = '1';
    $query = "INSERT INTO `korty` (`id`, `name`, `is_available`) VALUES (NULL, '".$c_name."', '".$c_a."');";
    if(mysqli_query($db, $query)):
        echo "K YES";
    else:
        echo "K No";
    endif;
endif;
if(isset($_POST['submit_add_user'])):
    $username = mysqli_real_escape_string($db, $_POST['user_name']);
    $email = mysqli_real_escape_string($db, $_POST['user_email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['user_pwd']);
    $surname =  mysqli_real_escape_string($db, $_POST['user_surname']);
    $phone = "";
    $gender = $_POST['user_gender'];//mysqli_real_escape_string($db, $_POST['gender']);
    $city = mysqli_real_escape_string($db, $_POST['user_city']);

    $password = md5($password_1);

    $query = "INSERT INTO `uzytkownicy` (`id`, `name`, `surname`, `email`, `password`, `city`, `phone`, `state`, `gender`) 
                VALUES (NULL, '".$username."', '".$surname."', '".$email."', '".$password."', '".$city."', '".$phone."', '".$_POST['state']."', '".$gender."');";
    if(mysqli_query($db, $query)):
        echo "12312";
    else:
        echo "Nasd";
    endif;
endif;
?>
<h1>Add new tenis cort</h1>
<form action="<?=$_SERVER['PHP_SELF']?>" method='post'>
    <input type="text" name="kort_name" placeholder="Name">
    <input type="checkbox" name="c_active">
    <input type="submit" name="submit_add_court" value="Dodać">
</form>
<br>
<h2>Add new costumer</h2>
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
    <input type="text" name="user_gender">
    <input type="submit" name="submit_add_user" value="Dodać">
</form>
