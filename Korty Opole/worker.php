<?php
$q = "SELECT * FROM `uzytkownicy` WHERE `id`=".$_SESSION['uid'];
$result = mysqli_query($db, $q);
$user_c = mysqli_fetch_assoc($result);
$today = getdate();
if(isset($_POST['submit_r'])):
	$username = mysqli_real_escape_string($db, $_POST['user_name']);
    $email = mysqli_real_escape_string($db, $_POST['user_email']);
    $surname =  mysqli_real_escape_string($db, $_POST['user_surname']);
    $phone = mysqli_real_escape_string($db, $_POST['user_phone']);;
    $gender = $_POST['user_gender'];//mysqli_real_escape_string($db, $_POST['gender']);
    $city = mysqli_real_escape_string($db, $_POST['user_city']);
	$query = "UPDATE IGNORE `uzytkownicy` set `name` ='{$username}', `surname` = '{$surname}',`email`='{$email}',`city` = '{$city}',`phone` = {$phone},`gender' = {$gender} WHERE `id`= {$_SESSION['uid']}  ";
	if(mysqli_query($db, $query)):
        echo "update";
    else:
        echo "error";
    endif;
endif;?>
<br>

<form action="<?$_SERVER['PHP_SELF']?>" method="post">
	name:
    <input type="text" name="user_name" placeholder="User name" value="<?=$user_c['name']?>">
	surname:
    <input type="text" name="user_surname" placeholder="User Surname" value="<?=$user_c['surname']?>">
	email:
    <input type="text" name="user_email" placeholder="User Email" value="<?=$user_c['email']?>">
	city:
    <input type="text" name="user_city" placeholder="User city" value="<?=$user_c['city']?>">
	phona:
    <input type="" name="user_phone" placeholder="User phone" value="<?=$user_c['phone']?>">
	Gender:
    <input type="number" name="user_gender" value="<?=$user_c['gender']?>">
    <input type="submit" name="submit_r" value="Zmień">
</form>
<br>
<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
    day:
	<select name="day">
	
        <?php for($i=$today['mday']; $i<31;$i++) {
        echo "<option value=".$i.">".$i."</option>";
        }
        ?>
    </select>
    <input type="submit" name="submit_t" value="send">

</form>
<br/>
<div  style=" background-color:white">
<?php 
if(isset($_POST['submit_t'])):   
    $select_date= $today['year']."-".$today['mon']."-".$_POST['day'];
    $query = "SELECT * FROM `rezerwacje` WHERE `date` = DATE_FORMAT('1999-01-01', '$select_date') ORDER BY `rezerwacje`.`kort` ASC";
	$result_t = mysqli_query($db, $query);
	if ($result_t){
		while ($row = mysqli_fetch_assoc($result_t)):
			echo "id: {$row['id']} - kort: #{$row['kort']} - godzina: {$row['czas']} - data: {$row['date']} <br/>";
		endwhile;
	}
else{
	echo "Nie ma rezerw<br/>";
}
endif;

?>
</div>
<div id="kort_usun">
<?php
if(isset($_POST['submit_dell'])){
	$id = $_POST['number_rez'];
	$query = "DELETE FROM `rezerwacje` WHERE `id` = {$id} ;";
	if(mysqli_query($db, $query)):
        echo "Rezerwacja została usunięta";
    else:
        echo "Błąd usuwania rezerwacji";
    endif;
}
?>
</div>

<form action="<?=$_SERVER['PHP_SELF']?>" method="post" class="booking_form_my_bookings">
	<input type="number" name="number_rez" min=1 id="nr_rezerwacji"  value="" placeholder="Numer rezerwacji">
	<input type="submit" name="submit_dell" value="Usunąć rezerwacje" id="nr_rezerwacji">
</form>