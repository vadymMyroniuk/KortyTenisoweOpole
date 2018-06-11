<?php
$q = "SELECT * FROM `uzytkownicy` WHERE `id`=".$_SESSION['uid'];
$result = mysqli_query($db, $q);
$user_c = mysqli_fetch_assoc($result);
$today = getdate();
if(isset($_POST['submit_r'])):
    $username = mysqli_real_escape_string($db, $_POST['user_name']);
    $email = mysqli_real_escape_string($db, $_POST['user_email']);
    $surname =  mysqli_real_escape_string($db, $_POST['user_surname']);
    $phone = "";
    $gender = $_POST['user_gender'];//mysqli_real_escape_string($db, $_POST['gender']);
    $city = mysqli_real_escape_string($db, $_POST['user_city']);

	$query = "UPDATE `uzytkownicy` set `name` ='{$username}', `surname` = '{$surname}',`email`='{$email}',`city` = '{$city}',`phone` = {$phone},`gender' = {$gender} WHERE `id`= {$_SESSION['uid']}  ";
//    $query = "INSERT INTO `uzytkownicy` (`id`, `name`, `surname`, `email`, `city`, `phone`, 'state`, `gender`)
//                VALUES (NULL, '".$username."', '".$surname."', '".$email."','".$city."', '".$phone."', '".$_POST['state']."', '".$gender."');";
    if(mysqli_query($db, $query)):
        echo "update";
    else:
        echo "error";
    endif;
endif;

if(isset($_POST['submit_rez'])):
	$kort_number = $_POST['number_kort'];
	$czas = $_POST['time'];
	
	$select_date_rez= $today['year']."-".$today['mon']."-".$_POST['day_k'];
	$query = "INSERT INTO `rezerwacje`(`kort`, `date`, `uzytkownik`, `czas`) VALUES ({$kort_number},DATE_FORMAT('1999-01-01', '$select_date_rez'), {$_SESSION['uid']}, {$czas})";
	if(mysqli_query($db, $query)):
        echo "rezerw";
    else:
        echo "Nad";
    endif;
endif;

?>
<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
    <input type="text" name="user_name" placeholder="User name" value="<?=$user_c['name']?>">
    <input type="text" name="user_surname" placeholder="User Surname" value="<?=$user_c['surname']?>">
    <input type="text" name="user_email" placeholder="User Email" value="<?=$user_c['email']?>">
    <input type="text" name="user_city" placeholder="User city" value="<?=$user_c['city']?>">
    <input type="text" name="user_phone" placeholder="User phone" value="<?=$user_c['phone']?>">
    <input type="number" name="user_gender" value="<?=$user_c['gender']?>">
    <input type="submit" name="submit_r" value="Zmień">
</form>

<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
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
    $query = "SELECT `id`, `kort`, `czas` FROM `rezerwacje` WHERE `date` = DATE_FORMAT('1999-01-01', '$select_date') ORDER BY `rezerwacje`.`kort` ASC";
	$result_t = mysqli_query($db, $query);
	if ($result_t){
		while ($row = mysqli_fetch_assoc($result_t)):
			echo "id: {$row['id']} - kort: #{$row['kort']} - godzina:{$row['czas']} :<br/>";
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
<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
	Godzina
	<select name="time" placeholder="Czas">
	<?php for($i=$today['hours']+1; $i<21;$i++) {
        echo "<option value=".$i.">".$i."</option>";
        }
        ?>
	</select>
	
	<input type="number" name="number_kort" value="" placeholder="Numer kortu">
	Dzien
	<select name="day_k">
        <?php for($i=$today['mday']; $i<31;$i++) {
        echo "<option value=".$i.">".$i."</option>";
        }
        ?>
    </select>
	<input type="submit" name="submit_rez" value="rezerwuj">
</form>
<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
	<input type="submit" name="submit_mrez" value="moje rezerwacje">
</form>
<div style=" background-color:white">
<?php
if(isset($_POST['submit_mrez'])){
	$select_date= $today['year']."-".$today['mon']."-".$today['mday'];
	$query = "SELECT `id`, `kort`, `czas`, `date` FROM `rezerwacje` WHERE `date` >= DATE_FORMAT('1999-01-01', '$select_date') and `uzytkownik`={$user_c['id']} ORDER BY `rezerwacje`.`date` ASC";
	$result_moj = mysqli_query($db, $query);
	if($result_moj){
		while ($row1 = mysqli_fetch_assoc($result_moj)){
			echo "id: {$row1['id']} kort: #{$row1['kort']} godzina: {$row1['czas']} <br/>";
		}
	}
	else{
		echo "Nie ma rezerw<br/>";
	}
}
?>
</div>
<?php
if(isset($_POST['submit_dell'])){
	$id = $_POST['number_rez'];
	$query = "DELETE FROM `rezerwacje` WHERE `id` = {$id} and `uzytkownik`={$user_c['id']}";
	if(mysqli_query($db, $query)):
        echo "deleted";
    else:
        echo "error";
    endif;
}
?>

<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
	<input type="number" name="number_rez" value="" placeholder="Numer rezerwacji">
	<input type="submit" name="submit_dell" value="usunąć rezerwacje">
</form>