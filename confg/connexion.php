<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = 'equipement de cuisine';
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // Définir le mode d'erreur PDO sur exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully"; // Cela n'est pas nécessaire ici
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
