@extends('public')

@section('title', 'Transport personnel')

@section('content')
<div class="container" style="margin-top: 100px">
    <div class="introduction">
        <p>
            Bienvenue à bord de Travel Pulse Caravan, bien plus qu'une simple entreprise de transport terrestre. Nous sommes votre porte d'entrée vers une expérience de voyage véritablement exceptionnelle. Laissez-nous vous emmener dans un voyage au cœur de notre univers, où chaque flotte que nous proposons raconte sa propre histoire et incarne une philosophie unique du service.

Chacune de nos flottes est le fruit d'une réflexion profonde, d'un dévouement sans faille envers la qualité et d'un engagement envers l'excellence. Elles sont conçues pour répondre de manière exceptionnelle à vos besoins de déplacement, quels qu'ils soient. Que vous recherchiez une solution économique, un confort supérieur, une expérience de voyage luxueuse ou même une gestion rapide et sécurisée de vos colis, nous avons une flotte dédiée à votre service.
        </p>
        <h5>Permettez-nous de vous présenter ces différentes flottes qui composent notre entreprise, chacune avec sa propre personnalité et son objectif spécifique :</h5>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <video src="{{asset('public/video/vito.mp4')}}" width="600px" controls autoplay class="myVid"></video>
        </div>
        <div class="col-md-6">
            <h2 class="colis-title">L'Économie Sans Compromis chez Travel Pulse Caravan</h2>
            <p class="colis-content">
                Notre Flotte Lite de notre compagnie propose une solution de transport axée sur l'efficacité économique sans compromis sur la qualité.
                Conçue pour les voyageurs soucieux de leur budget, elle met en avant des véhicules économes en carburant et un service de livraison standard fiable.
                Cette flotte garantit que vos colis et déplacements sont traités avec soin, même pour les expéditions moins urgentes. Que vous soyez un voyageur conscient de ses dépenses ou une entreprise cherchant à optimiser ses coûts de transport, la Flotte Lite offre une option abordable sans sacrifier la fiabilité.
                 Chez Travel Pulse Caravan, nous vous invitons à embarquer dans cette expérience économique de qualité.
            </p>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <h2 class="colis-title"> Un Voyage de Confort et de Prestige avec Travel Pulse Caravan</h2>
            <p class="colis-content">
                Notre Flotte Premium de Travel Pulse Caravan est conçue pour satisfaire les voyageurs en quête d'une expérience de voyage plus confortable et personnalisée. Avec des véhicules de qualité supérieure, cette flotte offre un niveau de confort inégalé. Les délais de livraison sont plus rapides, répondant ainsi aux besoins des voyageurs pressés. De plus, un suivi avancé assure une traçabilité complète des expéditions, tandis qu'un service client attentionné est à disposition pour répondre à toutes les demandes spécifiques. Que ce soit pour un voyage d'affaires ou un voyage personnel, la Flotte Premium garantit une expérience de voyage de premier ordre, combinant confort, rapidité et service exceptionnel.

            </p>
        </div>
        <div class="col-md-6">
            <video src="{{asset('public/video/crafter.mp4')}}" width="600px" controls autoplay class="myVid"></video>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <video src="{{asset('public/video/evito.mp4')}}" width="600px" controls autoplay class="myVid"></video>
        </div>
        <div class="col-md-6">
            <h2 class="colis-title">L'Élégance du Voyage Personnalisé avec Travel Pulse Caravan</h2>
            <p class="colis-content">
                Notre Flotte VIP de Travel Pulse Caravan vous invite à un voyage où le luxe et les détails sont à l'honneur. Dotée de véhicules haut de gamme, cette flotte garantit une expérience de voyage élégante et sur mesure pour répondre à vos besoins spécifiques. Nos chauffeurs expérimentés assurent une conduite impeccable, tandis que notre assistance client dédiée est prête à répondre à toutes vos demandes. Que ce soit pour un voyage d'affaires ou une escapade personnelle, la Flotte VIP offre le summum du confort et de la sophistication. Laissez-vous choyer et profitez d'un voyage mémorable où chaque détail est soigneusement orchestré pour votre satisfaction.
            </p>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <h2 class="colis-title"> L'Exclusivité Redéfinie avec Travel Pulse Caravan</h2>
            <p class="colis-content">
                Notre Flotte VVIP de Travel Pulse Caravan incarne l'apogée du voyage personnalisé et exclusif. Avec des véhicules de prestige à la pointe de la technologie, cette flotte est conçue pour répondre aux attentes des voyageurs les plus exigeants. Chaque détail de votre voyage est soigneusement orchestré, de la réservation à la destination finale. Notre service de conciergerie dédié est à votre disposition pour répondre à vos demandes les plus spécifiques. Que ce soit pour des voyages d'affaires de haut niveau, des événements spéciaux ou des escapades luxueuses, la Flotte VVIP offre une expérience sur mesure qui dépasse toutes les attentes. Embarquez dans le monde de l'exclusivité et du raffinement avec Travel Pulse Caravan.
            </p>
        </div>
        <div class="col-md-6">
            <video src="{{asset('public/video/crafter.mp4')}}" width="600px" controls autoplay class="myVid"></video>
        </div>
    </div>
</div>
@endsection
