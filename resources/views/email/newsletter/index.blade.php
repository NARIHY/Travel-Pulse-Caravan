<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$newsletter->title}}</title>
    <style>
        /* Styles pour l'en-tête */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #00030700;
            color: #ff0000;
            text-align: center;
            padding: 20px 0;
        }
        h1 {
            font-size: 24px;
            margin: 0;
        }

        /* Styles pour le contenu */
        .content-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h5 {
            font-size: 18px;
            margin-bottom: 20px;
            color: #333;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 20px;
            color: #555;
        }
    </style>
</head>
<body>
    <header>
        <h1>Accentic Technology</h1>
    </header>
    <div class="content-container">
        <h5>Madame, Monsieur,</h5>

        <!-- Lettre d'introduction à l'actualité du produit -->
        <div>
            <p>
                J'espère que cette lettre vous trouve en bonne santé. Je me permets de vous écrire pour vous présenter notre entreprise, Accentic Technology, spécialisée dans la vente de matériel informatique de haute qualité.
            </p>
            <p>
                Nous sommes fiers d'être un acteur majeur dans le domaine de la technologie et de l'informatique depuis 2 ans. Notre engagement envers l'excellence et la satisfaction du client nous a permis de bâtir une solide réputation dans l'industrie.
            </p>
            <p>
                Chez Accentic Technology, nous proposons une vaste gamme de produits informatiques de pointe, notamment des ordinateurs portables, des ordinateurs de bureau, des composants matériels, des périphériques et bien plus encore. Notre sélection de produits est soigneusement choisie pour répondre aux besoins de nos clients, qu'ils soient des particuliers ou des entreprises.
            </p>
            <p>
                {{$newsletter->content}}
            </p>
            <p>
                Nous vous remercions de votre fidélité continue. Restez à l'affût pour nos prochaines actualités passionnantes. Votre soutien est notre moteur, et nous nous engageons à vous offrir des contenus de qualité, des annonces excitantes et un service exceptionnel. Contactez-nous pour vos questions et suggestions. Restez connecté, soyez informé et prenez soin de vous.
            </p>
            <p>
                Avec gratitude, Accentic Technology.
            </p>
        </div>
        <!-- Fin de la lettre d'introduction à l'actualité du produit -->
    </div>
</body>
</html>
