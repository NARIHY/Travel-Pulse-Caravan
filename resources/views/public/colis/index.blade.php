@extends('public')

@section('title', 'Colis Express')

@section('content')
<div class="container" style="margin-top: 100px">
    <div class="row mb-3">
        <div class="col-md-6">
            <video src="{{asset('public/video/evito.mp4')}}" width="600px" controls autoplay class="myVid"></video>
        </div>
        <div class="col-md-6">
            <h2 class="colis-title">Envoyez votre Colis Toute Confiance avec Travel Pulse Caravan</h2>
            <p class="colis-content">
                Dans l'effervescent univers de Travel Pulse Caravan, notre "Flotte Colis Express" se distingue comme le fer de lance de la rapidité et de la fiabilité dans le domaine du transport de colis et de marchandises.
                Cette flotte incarne la quintessence de la livraison rapide, idéale pour les envois urgents et les biens précieux. Nous nous engageons à offrir une expérience client exceptionnelle en garantissant que chaque colis atteigne sa destination dans les délais impartis. Que vous soyez une entreprise en quête d'une gestion transparente de vos expéditions ou un particulier cherchant la tranquillité d'esprit, notre Flotte Colis Express est là pour vous. Optez pour Travel Pulse Caravan et découvrez une livraison rapide et fiable qui défie les attentes.
            </p>
        </div>
    </div>

    <div class="colis-next">
        <h2 class="colis-titre">Nos conditions</h2>
        <p class="colis-content">
            Pour garantir une expérience harmonieuse et fiable avec notre service de colis express, Travel Pulse Caravan met en place des conditions générales qui englobent les droits et responsabilités de nos clients et de notre entreprise. Ces conditions visent à assurer la sécurité, la transparence et la qualité de nos services tout en respectant les lois en vigueur. Nous vous invitons à prendre connaissance de ces conditions pour une expédition en toute confiance avec notre flotte Colis Express.
        </p>
        <ol>
            <li>Réservation et Paiement</li>
            <p class="colis-ol-content">
                Les utilisateurs doivent réserver le service de colis express en fournissant des détails précis sur l'expédition, y compris les adresses d'expédition et de destination, les dimensions et le poids du colis, la date de ramassage souhaitée, etc. Le paiement des frais d'expédition doit être effectué conformément aux modalités de paiement de l'entreprise.
            </p>
            <li>Responsabilité de l'Expéditeur</li>
            <p class="colis-ol-content">
                L'expéditeur est généralement responsable de s'assurer que le colis est correctement emballé, étiqueté et que son contenu est conforme aux lois et règlements locaux et internationaux. L'expéditeur est également responsable de fournir des informations de contact précises.
            </p>

            <li>Responsabilité de la Société de Transport </li>
            <p class="colis-ol-content">
                La société de transport, en l'occurrence Travel Pulse Caravan, s'engage à prendre en charge le colis conformément aux spécifications convenues, à le livrer dans les délais impartis et à le préserver de tout dommage pendant le transport. La société de transport est généralement responsable en cas de perte, de retard ou de dommage au colis, sous réserve des conditions contractuelles.
            </p>
            <li>Suivi et Notifications</li>
            <p class="colis-ol-content">
                Les utilisateurs ont généralement accès à un système de suivi en temps réel pour surveiller l'état de leurs colis. Des notifications peuvent être envoyées aux utilisateurs pour les informer des mises à jour importantes.
            </p>

            <li>Limitations de responsabilité</li>
            <p class="colis-ol-content">
                Les contrats de transport peuvent inclure des limitations de responsabilité pour certaines marchandises, en particulier celles de grande valeur. Les utilisateurs doivent être informés de ces limitations au moment de la réservation.
            </p>

            <li>Droits de Douane et Taxes </li>
            <p class="colis-ol-content">
                Les utilisateurs sont responsables du respect des lois et réglementations douanières et du paiement des droits de douane et taxes éventuelles pour les envois internationaux.
            </p>

            <li>Conditions de Livraison </li>
            <p class="colis-ol-content">
                Les conditions spécifiques de livraison, telles que les heures de livraison, les emplacements de dépôt et de ramassage, doivent être convenues au moment de la réservation.
            </p>

            <li>Annulations et Remboursements</li>
            <p class="colis-ol-content">
                Les politiques d'annulation et de remboursement doivent être détaillées, y compris les frais éventuels associés à une annulation.
            </p>

            <li>Protection des Données </li>
            <p class="colis-ol-content">
                La protection des données personnelles des utilisateurs doit être garantie conformément aux lois applicables sur la confidentialité et la sécurité des données.
            </p>

            <li>Modification des Conditions</li>
            <p class="colis-ol-content">
                La société de transport se réserve généralement le droit de modifier ses conditions générales, et les utilisateurs doivent être informés de ces modifications.
            </p>
        </ol>
    </div>

</div>
@endsection
