<?php
$dbhost = $_ENV["DBHOST"];
$database = $_ENV["DATABASE"];
$dbuser = $_ENV["DBUSER"];
$dbpassword = $_ENV["DBPASSWORD"];

if (empty($dbhost) || empty($database) || empty($dbuser) || empty($dbpassword) ) {
    echo 'Missing environment variables: you need to set DBHOST, DATABASE, DBUSER and DBPASSWORD';
    exit();
}

$conn = new mysqli($dbhost, $dbuser, $dbpassword,$database);
// check connection
if ($conn->connect_error) {
    echo 'Unable to connect to DB. Error: '  . $conn->connect_error;
    exit();
}

$table = "livre";

$titre = $_POST['titre'];
$auteur = $_POST['auteur'];
$genre = $_POST['genre'];

$sql = "INSERT INTO $table (titre, auteur, genre) VALUES ('$titre', '$auteur', '$genre')";

$rs = $conn->query($sql);

