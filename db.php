<?php
$credentials = file_get_contents(__DIR__."/credentials.json");
$credentials = json_decode($credentials);
$name = $credentials->name;
$pass = $credentials->password;
$db = $credentials->database_name;
$conn= mysqli_connect("localhost",$name,$pass,$db);