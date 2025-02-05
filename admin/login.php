
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Votre code CSS personnalisé */
        body {
    /* Existing styles */
    font-family: 'Roboto', sans-serif;
    background-color: black;
    margin: 0;
    padding: 0;
    opacity: 0.9; /* Modifier la valeur d'opacité ici */
}

body::before {
    content: "";
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url("http://localhost/projet2/img/cuisine3.jpg");
    opacity: 0.9; /* Rétablir l'opacité de l'image à 1 */
    z-index: -1;
}
    


form {
    max-width: 1000px; /* Modifier la largeur maximale du formulaire */
    padding: 150px; /* Modifier l'espacement intérieur du formulaire */
    background-color: rgba(255, 255, 255, 0.8); /* Modifier la couleur de fond avec une transparence */
    border: 2px solid #ccc;
    border-radius: 10px;
    box-shadow: 0 2px 9px rgba(0, 0, 0, 0.1);
}

.form-label {
    font-weight: bold;
    color: #333;
    margin-bottom: 15px;
    width: 300px 
}

.form-control {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-bottom: 20px; 

.btn {
    background-color: gray;
    color: black;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    font-weight: bold; 
    text-transform: uppercase;
    transition: background-color 0.3s ease-in-out;
}

.btn:hover {
    background-color: burlywood;
}

.error-message {
    color: #dc3545;
    margin-top: 10px;
}
.label-with-icon i {
    margin-right: 8px; 

}
.btn i {
    margin-right: 8px;}
    </style>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <form action="" method="post">
            <div class="mb-3">
            <div class="label-with-icon">
            <i class="fa-regular fa-envelope"></i>
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email">
               
            </div>
            <div class="mb-3">
            <div class="label-with-icon">
            <i class="fa-solid fa-lock"></i>

                <label for="mot de passe" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" name="motdepasse">
            </div>
            <button type="submit" class="btn btn-danger">
    <i class="fa-solid fa-key"></i> Se connecter
</button>

            <?php
 // Start session
 session_start();

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $username = $_POST["email"];
     $password = $_POST["motdepasse"];
     $errors = [];

     if (empty($username)) {
         $errors[] = "Veuillez entrer une adresse e-mail.";
     }

     if (empty($password)) {
         $errors[] = "Veuillez entrer un mot de passe.";
     }

     if (empty($errors)) {
         $db = new PDO('mysql:host=localhost;dbname=equipement de cuisine', 'root', '');
         $stmt = $db->prepare("SELECT * FROM admin WHERE email = :email AND motdepasse = :motdepasse");
         $stmt->bindParam(':email', $username);
         $stmt->bindParam(':motdepasse', $password);
         $stmt->execute();

         if ($stmt->rowCount() > 0) {
             $_SESSION["loggedin"] = true;
             $_SESSION["email"] = $username;
             header("location: http://localhost/projet2/admin/ajout.php");
         } else {
             echo "<div class='error-message'>Adresse e-mail ou mot de passe incorrect.</div>";
         }
     } else {
         foreach ($errors as $error) {
             echo "<div class='error-message'>$error</div>";
         }
     }
 }
 ?>

        </form>
    </div>
    <script>
        function validateForm() {
            const email = document.forms["loginForm"]["email"].value;
            const password = document.forms["loginForm"]["motdepasse"].value;
            let errors = [];

            if (email === "") {
                errors.push("Veuillez entrer une adresse e-mail.");
            }

            if (password === "") {
                errors.push("Veuillez entrer un mot de passe.");
            }

            if (errors.length > 0) {
                const errorContainer = document.getElementById("errorContainer");
                errorContainer.innerHTML = "";
                errors.forEach(function(error) {
                    const errorMessage = document.createElement("div");
                    errorMessage.className = "error-message";
                    errorMessage.innerText = error;
                    errorContainer.appendChild(errorMessage);
                });
                return false;
            }

            return true;
        }
    </script>
</body>
</html>

