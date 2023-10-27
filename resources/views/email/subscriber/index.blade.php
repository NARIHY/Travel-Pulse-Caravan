<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abonnement à notre newsletter</title>
    <style>
        /* Ajoutez ici votre CSS pour personnaliser l'apparence de la newsletter */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .newsletter-container {
            background-color: #ffffff;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            margin: 20px auto;
        }
        .newsletter-logo {
            width: 100px; /* Personnalisez la taille de votre logo */
            margin-bottom: 20px;
        }
        .newsletter-title {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .newsletter-subtitle {
            font-size: 16px;
            margin-bottom: 30px;
        }
        .subscribe-button {
            background-color: #6eaef2;
            color: #fff;
            padding: 10px 20px;
            font-size: 18px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
        }
        .social-links {
            margin-top: 20px;
        }
        .social-link {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="newsletter-container">
        <img src="http://caravan.briqueweb.com/Travel pulse Caravan-logo.png" alt="Logo de l'entreprise" class="newsletter-logo">
        <h1 class="newsletter-title">Abonnement à notre newsletter</h1>
        <p class="newsletter-subtitle">Merci de nous avoir rejoint !</p>

        <div class="social-links">
            <a href="https://www.facebook.com/briqueweb" class="social-link">Suivez-nous sur Facebook</a>
            <a href="https://www.briqueweb.com/" class="social-link">Suivez-nous sur Twitter</a>
            <a href="{{route('Public.index')}}" class="social-link">Suivez-nous sur notre site</a>
        </div>
    </div>
</body>
</html>

