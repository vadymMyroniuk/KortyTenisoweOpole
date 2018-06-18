<?php
$q = "SELECT * FROM `uzytkownicy` WHERE `id`=".$_SESSION['uid'];
$result = mysqli_query($db, $q);
$user_c = mysqli_fetch_assoc($result);
$today = getdate();
if(isset($_POST['submit_r'])):
    $username = mysqli_real_escape_string($db, $_POST['user_name']);
    $email = mysqli_real_escape_string($db, $_POST['user_email']);
    $surname =  mysqli_real_escape_string($db, $_POST['user_surname']);
    $phone = mysqli_real_escape_string($db, $_POST['user_phone']);
    $city = mysqli_real_escape_string($db, $_POST['user_city']);

	$query = "UPDATE `uzytkownicy` SET `name` ='{$username}', `surname` = '{$surname}',`email`='{$email}',`city` = '{$city}',`phone` = '{$phone}' WHERE `id`= {$_SESSION['uid']}  ;";
//    $query = "INSERT INTO `uzytkownicy` (`id`, `name`, `surname`, `email`, `city`, `phone`, 'state`, `gender`)
//                VALUES (NULL, '".$username."', '".$surname."', '".$email."','".$city."', '".$phone."', '".$_POST['state']."', '".$gender."');";
    if(mysqli_query($db, $query)):
        echo "update";
    else:
        echo "error";
    endif;
endif;
?>

<div id="booking_success">
<?php
if(isset($_POST['submit_rez'])):
	$kort_number = $_POST['number_kort'];
	$czas = $_POST['time'];
	$select_date_rez= $today['year']."-".$today['mon']."-".$_POST['day_k'];
	$query1 = "SELECT * FROM `rezerwacje` WHERE `kort` ={$kort_number} AND `date` = DATE_FORMAT('1999-01-01', '$select_date_rez') and  `czas` = {$czas} LIMIT 1; "; 
	$results= mysqli_query($db, $query1);
	if (mysqli_num_rows($results) > 0) {
	echo "rezerwacja istnieje";
	}
    else{
	$query = "INSERT INTO `rezerwacje`(`kort`, `date`, `uzytkownik`, `czas`) VALUES ({$kort_number},DATE_FORMAT('1999-01-01', '$select_date_rez'), {$_SESSION['uid']}, {$czas})";
	if(mysqli_query($db, $query)):
        echo "Kort został zarezerwowany";
    else:
        echo "Błąd rezerwacji";
    endif;
	}
endif;
?>
</div>

<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
    <br>
    <span style="margin-left: 10px; font-family: Ubuntu; font-size: 1.2em;">Your username: </span><input type="text" class="user_character_info" name="user_name" value="<?=$user_c['name']?>">
    <br>
    <br>
    <span style="margin-left: 10px; font-family: Ubuntu; font-size: 1.2em;">Your surname: </span><input type="text" class="user_character_info" name="user_surname" value="<?=$user_c['surname']?>">
    <br>
    <br>
    <span style="margin-left: 10px; font-family: Ubuntu; font-size: 1.2em;">Your email: </span><input type="email" class="user_character_info" name="user_email" value="<?=$user_c['email']?>">
    <br>
    <br>
    <span style="margin-left: 10px; font-family: Ubuntu; font-size: 1.2em;">Your city: </span><input type="text" class="user_character_info" name="user_city" value="<?=$user_c['city']?>">
    <br>
    <br>
    <span style="margin-left: 10px; font-family: Ubuntu; font-size: 1.2em;">Your phone: </span><input type="text" class="user_character_info" name="user_phone" value="<?=$user_c['phone']?>">
    <br>
    <br>
    <input type="submit" class="user_character_info" style="margin-left: 150px;" name="submit_r" value="Zmień">
</form>

<div class="actual_bookings">
<form action="<?=$_SERVER['PHP_SELF']?>" method="post" id="today_bookings">
    <h1 style="font-size: 1.5em; font-family: 'Ubuntu';">Aktualne rezerwacje</h1>
    <br>
    <span style="font-size: 1.2em; font-family: 'Ubuntu';">Dzień</span>
    <select name="day" style="font-size: 1.1em;">
        <?php for($i=$today['mday']; $i<31;$i++) {
        echo "<option value=".$i.">".$i."</option>";
        }
        ?>
    </select>
    <br>
    <br>
    <input type="submit" name="submit_t" value="Sprawdż" class="check_actual_res">
</form>
</div>

<div id="actual_courts">
<?php 
if(isset($_POST['submit_t'])):   
    $select_date= $today['year']."-".$today['mon']."-".$_POST['day'];
    $query = "SELECT * FROM `rezerwacje` WHERE `date` = DATE_FORMAT('1999-01-01', '$select_date') ORDER BY `rezerwacje`.`kort` ASC";
	$result_t = mysqli_query($db, $query);
	if ($result_t){
		while ($row = mysqli_fetch_assoc($result_t)):
			echo "id: {$row['id']} - kort: #{$row['kort']} - godzina:{$row['czas']} - data: {$row['date']}<br/>";
		endwhile;
	}
else{
	echo "Nie ma rezerw<br/>";
}
endif;
	?>
</div>
<!--<table border="1" bgcolor="blue">
    <tr>
        <th>N/A</th>
        <th> 8</th>
        <th> 9</th>
        <th>10</th>
        <th>11</th>
        <th>12</th>
        <th>13</th>
        <th>14</th>
        <th>15</th>
        <th>16</th>
        <th>17</th>
        <th>18</th>
    </tr>
	
    

</table> -->
<form action="<?=$_SERVER['PHP_SELF']?>" method="post" class="booking_form">
    <h1 style="font-family: Ubuntu;">Rezerwacja kortu</h1>
	<span style="font-size: 1.2em; font-family: 'Ubuntu';">Godzina</span>
	<select name="time" style="font-size: 1.1em;">
    <?php for($i=8; $i<21;$i++) {
        echo "<option value=".$i.">".$i."</option>";
        }
    ?>
    </select>


    <br>
    <br>
    <span style="font-size: 1.2em; font-family: 'Ubuntu';">Numer kortu: </span>
    <input type="number" style="font-size: 1.1em;" name="number_kort" min=1 max=5 value="1">
    <br>
    <br>
    <span style="font-size: 1.2em; font-family: 'Ubuntu';">Dzien: </span>
	<select name="day_k" style="font-size: 1.1em;">
        <?php for($i=$today['mday']; $i<31;$i++) {
        echo "<option value=".$i.">".$i."</option>";
        }
        ?>
    </select>
    <br>
	<input type="submit" name="submit_rez" id="zarezerwuj" value="Zarezerwuj">
</form>

<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
	<input type="submit" id="my_reservations" name="submit_mrez" value="moje rezerwacje" 
    style="position: absolute; left: 1050px; bottom: 300px;">
</form>


<div style="margin-left: 900px;
    position: absolute;
    top: 570px; font-size: 1.3em; font-family: 'Ubuntu'; ">
<?php
if(isset($_POST['submit_mrez'])){
	$select_date= $today['year']."-".$today['mon']."-".$today['mday'];
	$query = "SELECT * FROM `rezerwacje` WHERE `date` >= DATE_FORMAT('1999-01-01', '$select_date') and `uzytkownik`={$user_c['id']} ORDER BY `rezerwacje`.`date` ASC";
	$result_moj = mysqli_query($db, $query);
	if($result_moj){
		while ($row1 = mysqli_fetch_assoc($result_moj)){
			echo "nr rezerwacji: {$row1['id']}; nr kortu: {$row1['kort']}; godzina rezerwacji: {$row1['czas']}; data: {$row1['date']};<br/>";
		} 
	}
	else{
		echo "Nie ma rezerw<br/>";
	}
}
?>
</div>

<div id="kort_usun">
<?php
if(isset($_POST['submit_dell'])){
	$id = $_POST['number_rez'];
	$query = "DELETE FROM `rezerwacje` WHERE `id` = {$id} and `uzytkownik`={$user_c['id']}";
	if(mysqli_query($db, $query)):
        echo "Twoja rezerwacja została usunięta";
    else:
        echo "error";
    endif;
}
?>
</div>

<form action="<?=$_SERVER['PHP_SELF']?>" method="post" class="booking_form_my_bookings">
	<input type="number" name="number_rez" min=1 id="nr_rezerwacji"  value="" placeholder="Numer rezerwacji">
	<input type="submit" name="submit_dell" value="Usunąć rezerwacje" id="nr_rezerwacji">
</form>