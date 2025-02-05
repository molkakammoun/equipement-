<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Bienvenue</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        body {
            background-color: black;
            color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        #welcomeMessage {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 48px;
            text-align: center;
            opacity: 1;
            animation: fadeInOut 2s infinite;
        }

        #imageContainer, #videoContainer {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: none;
        }

        #imageContainer img, #videoContainer video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        @keyframes fadeInOut {
            0% {
                opacity: 1;
            }
            50% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }
        #aboutUsButton {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            z-index: 1; /* Assurez-vous que le bouton est au-dessus de la vidéo */
        }
    </style>
</head>
<body>
<header>
        <button id="aboutUsButton" onclick="window.location.href = 'about.html';">About Us</button>
    </header>

  
    <div id="welcomeMessage" class="animate__animated">Bienvenue</div>
  
    <div id="videoContainer">
        <video autoplay loop muted>
            <source src="img\436406114_7284416991612794_4412971037672629309_n.mp4" type="video/mp4">
        </video>
    </div>

    <script>
        // Fonction pour animer le message avec une alternance d'apparition et de disparition
        function animerMessageBienvenue() {
            var welcomeMessage = document.getElementById("welcomeMessage");
            welcomeMessage.classList.add("animate__fadeInOut");
        }

        // Fonction pour afficher l'image de présentation
        function afficherImagePresentation() {
            var imageContainer = document.getElementById("imageContainer");
            imageContainer.style.display = "block"; // Assurez-vous que l'image est visible
        }

        // Fonction pour afficher la vidéo après une seconde
        function afficherVideo() {
            var videoContainer = document.getElementById("videoContainer");
            videoContainer.style.display = "block"; // Assurez-vous que la vidéo est visible
        }
        
        // Appeler la fonction animerMessageBienvenue immédiatement
        animerMessageBienvenue();

      

        // Afficher la vidéo après 1 seconde
        setTimeout(afficherVideo, 2600);
    </script>
</body>
</html>