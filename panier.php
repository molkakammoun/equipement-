<?php
session_start();

// Définir les prix des équipements
$prixEquipements = [
    "EQ123" => 129.99, // Prix de l'équipement EQ123
    "EQ124" => 79.99, // Prix de l'équipement EQ124
    "EQ125" => 599.99, // Prix de l'équipement EQ125
    "EQ126" => 49.99, // Prix de l'équipement EQ126
    "EQ127" => 399.99, // Prix de l'équipement EQ127
    "EQ128" => 249.99, // Prix de l'équipement EQ128
];

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// Ajouter un équipement au panier si un code d'équipement est reçu via POST
if (isset($_POST['codeEquipement'])) {
    $codeEquipement = $_POST['codeEquipement'];
    // Vérifiez si le code d'équipement est valide et existe dans le tableau des prix
    if (isset($prixEquipements[$codeEquipement])) {
        // Ajoutez l'équipement au panier
        $_SESSION['panier'][] = $codeEquipement;
        // Répondez avec un message ou une confirmation si nécessaire
        echo "L'équipement $codeEquipement a été ajouté au panier.";
    } else {
        // Répondez avec un message d'erreur si le code d'équipement est invalide
        echo "Code d'équipement invalide.";
    }
}


if (isset($_POST['removeCodeEquipement'])) {
    // Supprimer l'équipement du panier
    $removeCodeEquipement = $_POST['removeCodeEquipement'];
    $key = array_search($removeCodeEquipement, $_SESSION['panier']);
    if ($key !== false) {
        unset($_SESSION['panier'][$key]);
    }
}
if (isset($_POST['procederAuPaiement']) && !empty($_SESSION['panier'])) {
    // Rediriger vers la page d'inscription
    header("Location: accueil.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color:  background-color: rgba(255, 255, 255, 0.5);
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border: 3px solid black; /* Modification de la couleur de la bordure */
}
body {
        background-image: url("img/panier.jpg");
        background-repeat: no-repeat;
        background-size: cover;
    }
.payment-button {
        position: relative;
        bottom: 20px;
        right: 20px;
    }
    .payment-container {
        position: relative;
        text-align: center; /* Optionnel : aligne le bouton au centre horizontalement */
        margin-top: 20px; /* Ajustez la valeur selon votre préférence */
    }
    
        h1 {
            text-align: center;
            color: #333;
            font-size: 35px;
            margin-bottom: 20px;
            animation: rotateText 2s infinite alternate; /* Ajout de l'animation */
        }
        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
         
        
        }
        .back-btn {
            padding: 5px 10px;
            background-color: rgba(10, 10, 10, 0.5);;
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .back-btn:hover {
            background-color: #666;
            border: 2px solid #fff;
            border-style: dotted;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 20px;
            padding: 20px;
            background-color:transparent;
            border: 1px solid black;
            border-radius: 5px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            transition: transform 0.3s ease-in-out;
        }
        li:hover {
            transform: translateY(-5px);
        }
        li img {
            max-width: 100px;
            margin-right: 20px;
            transition: transform 0.3s ease-in-out;
        }
        li:hover img {
            transform: scale(1.1);
        }
        .product-details {
            flex-grow: 1;
        }
        .product-name {
            font-size: 18px;
            color: #333;
            margin-bottom: 5px;
        }
        .product-price {
            font-size: 16px;
            color: #666;
            margin-bottom: 5px;
        }
        .btn {
            background-color: rgba(10, 10, 10, 0.5);
            border: 2px solid #fff;
            border-style: dotted;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }
        .btn:hover {
            border-color: #fff;
            transform: scale(1.1);
        }
        .empty-message {
            text-align: center;
            font-style: italic;
            color: black;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="toolbar">
        <button class="back-btn" onclick="window.location.href = 'equipement.php'"><i class="fas fa-arrow-left"></i> Retour</button>
            <h1><i class="fas fa-shopping-cart"></i> Panier</h1>
        </div>

        <?php if (!empty($_SESSION['panier'])): ?>
             <ul id="cartList">
                <?php foreach ($_SESSION['panier'] as $codeEquipement): ?>
                    <li>
                        <img src="chemin/vers/image/<?php echo $codeEquipement; ?>.jpg" alt="Image du produit">
                        <div class="product-details">
                            <p class="product-name"><?php echo $codeEquipement; ?></p>
                            <p class="product-price">
                            <?php 
                            // Vérifier si le prix de l'équipement est défini dans le tableau $prixEquipements
                            if (isset($prixEquipements[$codeEquipement])) {
                                echo "Prix: " . $prixEquipements[$codeEquipement] . " dt";
                            } else {
                                echo "Prix non disponible";
                            }
                        ?>
                        </div>
                        <button class="btn" onclick="removeFromCart('<?php echo $codeEquipement; ?>')">Supprimer</button>
                    </li>
                <?php endforeach; ?>
            </ul>
            <button class="btn" onclick=" clearCart() ">Vider le panier</button>
            <form action="accueil.php" method="POST">
    <button class="btn" type="submit" name="procederAuPaiement">Payer</button>
</form>
            <p class="empty-message">Le panier est vide.</p>
        <?php endif; ?>
    </div>

    <script>
        function removeFromCart(codeEquipement) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Actualiser la page après la suppression
                    location.reload();
                }
            };
            xhttp.open("POST", "panier.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("removeCodeEquipement=" + codeEquipement);
        }
        function clearCart() {
    // Réinitialiser les données du panier (par exemple, un tableau vide)
    var cartItems = [];
    
    // Mettre à jour l'affichage du panier (par exemple, en vidant la liste des éléments du panier)
    var cartList = document.getElementById('cartList');
    cartList.innerHTML = '';

    // Mettre à jour d'autres éléments d'interface utilisateur liés au panier si nécessaire

    // Afficher un message indiquant que le panier a été vidé
    alert('Le panier a été vidé avec succès !');
}
   
    </script>
</body>
</html>