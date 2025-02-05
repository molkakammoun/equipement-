<?php

class Produit {
    // Propriétés
    public $id;
    public $image;
    public $nom;
    public $prix;
    public $description;

    // Constructeur
    public function __construct($id, $image, $nom, $prix, $description) {
        $this->id = $id;
        $this->image = $image;
        $this->nom = $nom;
        $this->prix = $prix;
        $this->description = $description;
    }
    public function getId() {
        return $this->id;
    }

    public function getImage() {
        return $this->image;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function getDescription() {
        return $this->description;
    }
}
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Album example · Bootstrap v5.3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
 
   body {
    /* Existing styles */
    font-family: 'Roboto', sans-serif;
    background-color: black;
    margin: 0;
    padding: 0;
    background-repeat: no-repeat;
    background-size: cover;
    background-image: url("http://localhost/projet2/img/cuisine3.jpg");
   }

body div {
    /* Add your custom styles here */
    border: 2px solid #fff;
    border-radius: 10px;
    padding: 10px;
    background-color: rgba(255, 255, 255, 0.5);
}
            header {
            background-color: #000;
            color: #fff;
            padding: 30px;
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
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            border-radius: 5px;
        }

        nav ul li a:hover {
            border-color: #fff;
        }
        .custom-btn {
    /* Existing styles */
    background-color: #f1f1f1;
    color: #333;
    border: 1px solid #ccc;
    padding: 5px 10px;
    border-radius: 3px;

    /* Additional styles */
    /* Add your custom styles here */
    /* Example: */
    font-weight: bold;
    text-transform: uppercase;
    transition: background-color 0.3s ease-in-out;
}

.custom-btn:hover {
    /* Additional styles for hover state */
    /* Example: */
    background-color: #eaeaea;
}
.custom-btn i {
    margin-right: 8px; /* Ajustez l'espacement selon vos besoins */
}
      
    </style>
</head>
<body>
    <?php
    require("confg/function.php");
    $produits = Afficher();
    if(!empty($_POST['search'])){
        $produits= searchProduit($_POST['search']);

    }else{
       // echo'fema 8alta'; 
    }

    ?>
<header style="border-bottom: 0.3px solid #fff; display: flex; align-items: center; padding: 15px;">
    <img src="img\logo.png" alt="Logo" style="width: 70px; height: 70px; margin-right: 20px;">
    <nav style="margin-left: auto;">
            <ul>
            <i class="fa-solid fa-magnifying-glass"></i>
                <li><a href="http://localhost/projet2/search.php ">recherche</a></li>
                <i class="fa-solid fa-book-open"></i>
                <li><a href="about.html">À propos</a></li>
                <li><a href="#">Services</a></li>
                <li>
                    <form action="logout.php" method="post">
                    <a href="http://localhost/projet2/admin/login.php" class="logout-button"><i class="fa-sharp fa-solid fa-user-secret"></i></i></a>
                    </form>
                </li>
            </ul>
        </nav>

    
    </header>

    <main>
        <div class="album py-5 bg-body-tertiary">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <?php
                    
                    if (is_array($produits)) {
                        foreach ($produits as $produit) {
                            ?>
                            <div class="col">
                            <div class="card shadow-sm">
        <img src="<?php echo $produit['image']; ?>" class="bd-placeholder-img card-img-top" width="100%" height="225" alt="Product Image">
        <div class="card-body">
            <p class="card-text">ID: <?php echo $produit['id']; ?></p>
            <h5 class="card-title"><?php echo $produit['nom']; ?></h5>
            <p class="card-text"><?php echo $produit['description']; ?></p>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                <button type="button" class="custom-btn">
    <i class="fa-solid fa-cart-plus"></i> Ajouter au panier
</button>
                </div>
                
 

<i class="fa-solid fa-sack-dollar"></i>
                <small class="text-muted"><?php echo $produit['prix']; ?></small>
            </div>
        </div>
    </div>
</div>

                            <?php
                        }
                    } else {
                        echo "La variable \$produits n'est pas un tableau.";
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>

    <footer class="text-center py-4">
      
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
