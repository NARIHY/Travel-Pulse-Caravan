@extends('public')

@section('title', 'Personal transport')

@section('content')
<div class="container" style="margin-top: 100px">
    <div class="introduction">
        <p>
            Welcome aboard Travel Pulse Caravan, much more than just a ground transportation company. We are your gateway to a truly exceptional travel experience. Let us take you on a journey to the heart of our universe, where each fleet we offer tells its own story and embodies a unique philosophy of service.

            Each of our fleets is the product of deep thought, an unwavering dedication to quality and a commitment to excellence. They are designed to exceptionally meet your travel needs, whatever they may be. Whether you are looking for an economical solution, superior comfort, a luxurious travel experience or even fast and secure management of your packages, we have a fleet dedicated to your service.
        </p>
        <h5>Allow us to introduce you to these different fleets that make up our company, each with its own personality and specific objective:</h5>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <video src="{{asset('public/video/vito.mp4')}}" width="600px" controls autoplay class="myVid"></video>
        </div>
        <div class="col-md-6">
            <h2 class="colis-title">Economy Without Compromise at Travel Pulse Caravan</h2>
            <p class="colis-content">
                Our company's Lite Fleet offers a transportation solution focused on economic efficiency without compromising on quality.
                Designed for budget-conscious travelers, it highlights fuel-efficient vehicles and a reliable standard delivery service.
                This fleet ensures that your packages and trips are handled with care, even for less urgent shipments. Whether you are a cost-conscious traveler or a business looking to optimize transportation costs, Fleet Lite offers an affordable option without sacrificing reliability.
                 At Travel Pulse Caravan, we invite you to embark on this quality, economical experience.
            </p>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <h2 class="colis-title"> A Trip of Comfort and Prestige with Travel Pulse Caravan</h2>
            <p class="colis-content">
                Our Premium Travel Pulse Caravan Fleet is designed to satisfy travelers looking for a more comfortable and personalized travel experience. With superior quality vehicles, this fleet offers an unrivaled level of comfort. Delivery times are faster, meeting the needs of busy travelers. Additionally, advanced tracking ensures complete shipment traceability, while attentive customer service is on hand to assist with any specific requests. Whether for business or personal travel, the Premium Fleet guarantees a premier travel experience, combining comfort, speed and exceptional service.

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
            <h2 class="colis-title">The Elegance of Personalized Travel with Travel Pulse Caravan</h2>
            <p class="colis-content">
                Our Travel Pulse Caravan VIP Fleet invites you on a journey where luxury and detail are in the spotlight. Featuring premium vehicles, this fleet guarantees a stylish and tailor-made travel experience to meet your specific needs. Our experienced drivers ensure impeccable driving, while our dedicated customer support is ready to respond to all your requests. Whether for a business trip or a personal getaway, the VIP Fleet offers the ultimate in comfort and sophistication. Let yourself be pampered and enjoy a memorable trip where every detail is carefully orchestrated for your satisfaction.
            </p>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <h2 class="colis-title"> Exclusivity Redefined with Travel Pulse Caravan</h2>
            <p class="colis-content">
                Our Travel Pulse Caravan VVIP Fleet embodies the pinnacle of personalized and exclusive travel. With prestigious vehicles at the cutting edge of technology, this fleet is designed to meet the expectations of the most demanding travelers. Every detail of your trip is carefully orchestrated, from booking to final destination. Our dedicated concierge service is at your disposal to respond to your most specific requests. Whether for high-profile business trips, special events or luxurious getaways, the VVIP Fleet offers a tailor-made experience that exceeds all expectations. Embark on the world of exclusivity and refinement with Travel Pulse Caravan.
            </p>
        </div>
        <div class="col-md-6">
            <video src="{{asset('public/video/crafter.mp4')}}" width="600px" controls autoplay class="myVid"></video>
        </div>
    </div>
</div>
@endsection
