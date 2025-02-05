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


<?php

function ajouter($image, $nom, $prix, $desc) {
    global $conn;

    // Check if a product with the same name already exists (or use another unique identifier)
    $check = $conn->prepare("SELECT COUNT(*) FROM produits WHERE nom = ?");
    $check->execute([$nom]);
    $exists = $check->fetchColumn();

    if ($exists) {
        throw new Exception("Le produit '$nom' existe déjà.");
    }

    // If not, proceed to insert the new product
    $req = $conn->prepare("INSERT INTO produits (image, nom, prix, description) VALUES (?, ?, ?, ?)");
    $req->execute([$image, $nom, $prix, $desc]);
    $req->closeCursor();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
   /* Styles personnalisés */
body {
    background-image: url('../img/background.jpg'); /* Chemin vers votre image de fond */
    background-size: cover; /* Pour s'assurer que l'image couvre tout l'arrière-plan */
    color: #212529;
    font-family: Arial, sans-serif;
    margin: 0;
}

header {
    background-color: #000;
    color: #fff;
    padding: 20px;
    display: flex;
    justify-content: flex-end;
    align-items: center;
}

nav ul {
    list-style-type: none;
    display: flex;
    margin: 0;
    padding: 0; /* Ajout de cette ligne pour supprimer le remplissage */
    margin-right: auto; /* Alignement des éléments à droite */
}

nav ul li {
    margin-right: 30px;
    position: relative;
    border-radius: 0.375rem;
    margin-right: 20px;
}

nav ul li a {
    color: #fff;
    text-decoration: none;
    padding: 8px;
    border-radius: 5px;
}

nav ul li a:hover {
    border-color: #fff;
}

.form-label {
    font-weight: bold;
    color: #333;
}

.form-control {
    border-radius: 2px;
    border: 6px solid #bbb;
    box-shadow: none;
}

.form-control:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.btn-primary {
    background-color: gray;
    border-color: grey;
    border-radius: 3px;
    font-weight: bold;
    text-transform: uppercase;
}

.btn-primary:hover {
    background-color: burlywood;
    border-color: beige;
}
</style>
<header style="border-bottom: 0.3px solid #fff; display: flex; align-items: center; padding: 15px;">
    <img src="../img\logo.png" alt="Logo" style="width: 70px; height: 70px; margin-right: 20px;">
    <nav style="margin-left: auto;">
        <ul>
            <li><a href= "C:\xampp\htdocs\projet2\index.php">Accueil</a></li>
            <li><a href="C:\xampp\htdocs\projet2\about.html">À propos</a></li>
          
            <li>
                <form action="logout.php" method="post">
                <a href="admin/index.php" class="logout-button">deconnexion <i class="fas fa-sign-out-alt"></i></a>
                </form>
            </li>
        </ul>
    </nav>
</header>
<body>
    <div class="album py-5 bg-body-tertiary">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <form method="POST">
               
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">image</label>
                        <input type="text" class="form-control" name="image" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nom du produit</label>
                        <input type="text" class="form-control" name="nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Prix</label>
                        <input type="number" class="form-control" name="prix" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">les information</label>
                        <textarea class="form-control" name="desc" required></textarea>
                    </div>
                    <button type="submit" name="valider" class="btn btn-primary">Ajouter nouveau produit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php 

if(isset($_POST['valider'])){
    if(isset($_POST['image']) && isset($_POST['nom']) && isset($_POST['prix']) && isset($_POST['desc'])){
        if(!empty($_POST['image']) && !empty($_POST['nom']) && !empty($_POST['prix']) && !empty($_POST['desc'])){
            $image = htmlspecialchars($_POST['image']);
            $nom = htmlspecialchars($_POST['nom']);
            $prix = htmlspecialchars($_POST['prix']);   
            $desc = htmlspecialchars($_POST['desc']);
            try {
                ajouter($image, $nom, $prix, $desc);
                echo "Produit ajouté avec succès.";
            } catch(Exception $e){
                echo $e->getMessage();
            }     
        }
    }
}
?>
