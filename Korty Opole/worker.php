<?php
$q = "SELECT * FROM `uzytkownicy` WHERE `email`='{$_SESSION['email']}';
$result = mysqli_query($db, $q);
$user_c = mysqli_fetch_assoc($result);
$today = getdate();
?>
<br>
<br>

<br>
<h1> Lista aktualnych rezerwacji</h1>
<hr>
<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
    day:
	<select name="day">
	
        <?php for($i=$today['mday']; $i<31;$i++) {
        echo "<option value=".$i.">".$i."</option>";
        }
        ?>
    </select>
    <input type="submit" name="submit_t" value="Pokaż">

</form>
<br/>
<div  style=" background-color:white">
<?php 
if(isset($_POST['submit_t'])):   
    $select_date= $today['year']."-".$today['mon']."-".$_POST['day'];
    $query = "SELECT * FROM `rezerwacje` WHERE `date` = DATE_FORMAT('1999-01-01', '$select_date') ORDER BY `rezerwacje`.`kort` ASC";
	$result_t = mysqli_query($db, $query);
	if (!empty($result_t)){
		while ($row = mysqli_fetch_assoc($result_t)):
			echo "id: {$row['id']} - kort: #{$row['kort']} - godzina: {$row['czas']} - data: {$row['date']} <br/>";
		endwhile;
	}
else{
	echo "Nie ma rezerwacji<br/>";
}
endif;

?>
<hr>
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