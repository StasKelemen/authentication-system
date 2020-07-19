<?php



$servername = 'localhost';

$dbUsername = 'id10592023_site1';

$dbPassword = 'Evasi0n123';

$dbName = 'id10592023_loginsystemtut';



$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);



if (!$conn) {

	die('Connection failed:'.mysqli_connect_error());

}