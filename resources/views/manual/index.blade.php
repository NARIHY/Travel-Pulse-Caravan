@extends('manual')
@section('css')
<style>
    body{
        text-align: justify;
    }
.get-started-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007BFF;
    color: #fff;
    font-size: 16px;
    text-decoration: none;
    border-radius: 5px;
    border: none;
    cursor: pointer;
    overflow: hidden;
    position: relative;
    transition: all 0.3s;
}
.get-started-button:hover {
    transform: translateX(25px);
}
.get-started-button::before {
    content: '';
    text-align: right;
    position: absolute;
    background: #10ba0a;
    width: 100%;
    height: 0;
    bottom: 0;
    left: 0;
    z-index: -1;
    transition: all 0.3s;
}

.get-started-button:hover::before {
    height: 100%;
}
</style>
@endsection
@section('content')
<div class="container mt-5">
    <div class="jumbotron">
        <h1 class="display-4">Welcome to Our Application</h1>
        <p class="lead">We are delighted to welcome you to our platform. At us, every user is valuable, and we are committed to providing you with the best possible experience. Whether you're a newcomer or a long-time user, rest assured that you are at the heart of our community. Welcome and enjoy everything our platform has to offer!</p>
        <hr class="my-4">
        <p>Welcome to the world of land transport in Madagascar! Our app is your gateway to an exceptional travel experience in the heart of this magnificent island. We are proud to offer you high-quality transportation services, designed to provide comfort, safety and efficiency at every stage of your journey.
            Our company, based in Madagascar, is deeply rooted in the culture and landscape of this unique island. Whether you're traveling for pleasure, business or any other reason, we're here to make your life easier. Explore our app to book trips, get information on destinations, and experience the Malagasy adventure from the comfort of our vehicles. Welcome aboard your next adventure!
        </p>
        <p>Explore our great features and immerse yourself in an experience like no other. Discover everything our app has to offer, designed to make your trip easier and provide you with a premium transportation service in Madagascar.</p>
        <div class="button-container">

            <a href="{{route('Manual.authetificate')}}" ><button class="get-started-button">  Get Started <i class="bi bi-arrow-right-short"></i></button></a>
        </div>
    </div>
</div>
@endsection
