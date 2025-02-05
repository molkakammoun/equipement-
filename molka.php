<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fours - Équipements de Cuisine</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            background-image: url("img/cuisine3.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }

        header {
            background-color: #333333;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 2rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
            padding: 10px;
        }

        .equipement {
            border: 1px solid #cccccc;
            margin: 20px;
            padding: 20px;
            width: 300px;
            background-color: transparent;
            border-radius: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: box-shadow 0.3s, transform 0.3s;
            position: relative;
            overflow: hidden;
        }

        .equipement:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: linear-gradient transparent;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .equipement:hover:before {
            opacity: 1;
        }

        .equipement img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            transform: scale(1);
            transition: transform 0.3s;
        }

        .equipement:hover img {
            transform: scale(1.1);
        }

        .equipement h2 {
            margin-top: 10px;
            color: #333333;
            font-size: 1.5rem;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .equipement p {
            color: #666666;
            font-size: 1rem;
            text-align: center;
            margin-top: 20px;
        }

        .equipement button {
            display: block;
            width: 100%;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #333333;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .equipement button:hover {
            background-color: #666666;
            transform: scale(1.05);
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #333333;
            color: #ffffff;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<header>
    <h1>Fours - Équipements de Cuisine</h1>
</header>
<div class="container">
    <?php
    foreach ($articles as $article) {
        echo '<div class="equipement">';
        echo '<img src="' . $article->getImage() . '" alt="' . $article->getNom() . '">';
        echo '<div class="equipement-details">';
        echo '<h2>' . $article->getNom() . '</h2>';
        echo '<p><strong>Type :</strong> ' . $article->getType() . '</p>';
        echo '<p><strong>Prix :</strong> ' . $article->getPrix() . ' dt</p>';
        echo '<p><strong>Caractéristique :</strong> ' . $article->getCaracteristique() . '</p>'; // Correction de la méthode
        echo '<button class="buy-button" onclick="ajouterAuPanier(\'' . $article->getNom() . '\')">Ajouter au panier</button>'; // Correction du passage du paramètre
        echo '</div>';
        echo '</div>';
    }
    ?>
</div>
<footer>
    <!-- Balises footer inchangées -->
</footer>
</body>
</html>

<script>
function ajouterAuPanier(tNom) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            alert(this.responseText); // Afficher la réponse du serveur
        }
    };
    xhttp.open("POST", "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("nom=" + tNom); // Correction de la variable à passer
}
</script>