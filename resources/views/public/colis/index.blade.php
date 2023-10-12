@extends('public')

@section('title', 'Colis Express')

@section('content')
<div class="container" style="margin-top: 100px">
    <div class="row mb-3">
        <div class="col-md-6">
            <video src="{{asset('public/video/evito.mp4')}}" width="600px" controls autoplay class="myVid"></video>
        </div>
        <div class="col-md-6">
            <h2 class="colis-title">Send your Package Confidently with Travel Pulse Caravan</h2>
            <p class="colis-content">
                In the bustling world of Travel Pulse Caravan, our “Parcel Express Fleet” stands out as the spearhead of speed and reliability in the field of parcel and goods transport.
                This fleet embodies the epitome of fast delivery, ideal for urgent shipments and valuable goods. We are committed to providing an exceptional customer experience by ensuring that every package reaches its destination on time. Whether you are a company looking for transparent management of your shipments or an individual looking for peace of mind, our Parcel Express Fleet is there for you. Opt for Travel Pulse Caravan and experience fast, reliable delivery that defies expectations.
            </p>
        </div>
    </div>

    <div class="colis-next">
        <h2 class="colis-titre">Our conditions</h2>
        <p class="colis-content">
            To ensure a smooth and reliable experience with our express parcel service, Travel Pulse Caravan puts in place terms and conditions that encompass the rights and responsibilities of our customers and our company. These conditions aim to ensure the security, transparency and quality of our services while respecting the laws in force. We invite you to read these conditions for shipping with complete confidence with our Parcel Express fleet.
        </p>
        <ol>
            <li>Reservation and Payment</li>
            <p class="colis-ol-content">
                Users need to book the express parcel service by providing accurate shipping details, including shipping and destination addresses, parcel dimensions and weight, desired pickup date, etc. Payment for shipping charges must be made in accordance with the company's payment terms.
            </p>
            <li>Responsabilité de l'Expéditeur</li>
            <p class="colis-ol-content">
                The shipper is generally responsible for ensuring that the package is properly packaged, labeled, and that its contents comply with local and international laws and regulations. The sender is also responsible for providing accurate contact information.
            </p>

            <li>Responsibility of the Transport Company </li>
            <p class="colis-ol-content">
                The transport company, in this case Travel Pulse Caravan, undertakes to take charge of the parcel in accordance with the agreed specifications, to deliver it within the stipulated time and to protect it from any damage during transport. The shipping company is generally responsible for any loss, delay or damage to the package, subject to contractual conditions.
            </p>
            <li>Tracking and Notifications</li>
            <p class="colis-ol-content">
                Users usually have access to a real-time tracking system to monitor the status of their packages. Notifications can be sent to users to notify them of important updates.
            </p>

            <li>Limitations of Liability</li>
            <p class="colis-ol-content">
                Contracts of carriage may include limitations of liability for certain goods, particularly those of high value. Users must be informed of these limitations at the time of booking.
            </p>

            <li>Customs Duties and Taxes </li>
            <p class="colis-ol-content">
                Users are responsible for complying with customs laws and regulations and paying any customs duties and taxes for international shipments.
            </p>

            <li>Conditions de Livraison </li>
            <p class="colis-ol-content">
                Specific delivery terms, such as delivery times, drop-off and pick-up locations, must be agreed at the time of booking.
            </p>

            <li>Cancellations and Refunds</li>
            <p class="colis-ol-content">
                Cancellation and refund policies should be detailed, including any fees associated with a cancellation.
            </p>

            <li>Data protection </li>
            <p class="colis-ol-content">
                The protection of users' personal data must be guaranteed in accordance with applicable data privacy and security laws.
            </p>

            <li>Modification of the Conditions</li>
            <p class="colis-ol-content">
                The transport company generally reserves the right to modify its terms and conditions, and users must be informed of these modifications.
            </p>
        </ol>
    </div>

</div>
@endsection
