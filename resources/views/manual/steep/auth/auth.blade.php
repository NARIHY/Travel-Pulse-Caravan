@extends('manual')
@section('css')
    <style>

        .home {
            transition: transform 1s;
        }
        .home:hover{
            transform: translateX(20px);
            cursor: pointer;
            color: red;
        }
        .information {
            transition: transform 1s;
        }
        .information:hover{
            transform: translateX(20px);
            cursor: pointer;
            color: red;
        }
        .service {
            transition: transform 1s;
        }
        .service:hover{
            transform: translateX(20px);
            cursor: pointer;
            color: red;
        }
        .book {
            transition: transform 1s;
        }
        .book:hover{
            transform: translateX(20px);
            cursor: pointer;
            color: red;
        }
        .register {
            transition: transform 1s;
        }
        .register:hover{
            transform: translateX(20px);
            cursor: pointer;
            color: red;
        }
        .login {
            transition: transform 1s;
        }
        .login:hover{
            transform: translateX(20px);
            cursor: pointer;
            color: red;
        }
    </style>
@endsection

@section('content')
    <h3>Steep 1: Your view after clicking start</h3>
    <img src="{{asset('manual/menu.jpg')}}" alt="Menu" width="100%">
    <div class="row mb-3">
        <div class="col-md-6">
            <p style="text-align: justify">
                Welcome to our platform, meticulously crafted to provide you with a peerless experience. We're overjoyed to have you here, and our commitment is to ensure your journey with us is nothing short of exceptional. Whether you're seeking leisure, professional opportunities, or the excitement of exploration, you've found the perfect destination.
                Our versatile platform caters to a world of possibilities, offering a diverse array of features and services expertly tailored to meet your unique needs. The homepage serves as your gateway to an exciting journey, offering intuitive navigation and access to valuable resources.
                We encourage you to fully explore our offerings and immerse yourself in an extraordinary experience. Your satisfaction is our utmost priority, and our unwavering dedication to delivering quality is the cornerstone of your journey with us. Our platform is here to empower you, whether you're pursuing moments of relaxation or professional advancement. Your aspirations are the heartbeat of our platform, and we're excited to be part of your remarkable journey. Welcome to an extraordinary experience beyond compare.
            </p>
        </div>
        <div class="col-md-6">
            <p style="text-align: justify">
                In the top navigation bar, you see all the mother menus of our application, which are:
                <ul class="list-group list-group-flush">

                    <li class="list-group-item">
                        <p class="home" onclick="getClassOnClick('home')">
                            Home
                        </p>
                    </li>

                    <li class="list-group-item">
                        <p class="service" onclick="getClassOnClick('service')">
                            Our Service
                        </p>
                    </li>
                    <li class="list-group-item">
                        <p class="book" onclick="getClassOnClick('book')">
                            To Book
                        </p>
                    </li>
                    <li class="list-group-item">
                        <p class="information" onclick="getClassOnClick('information')">
                            Information
                        </p>
                    </li>
                    <li class="list-group-item">
                        <p class="register" onclick="getClassOnClick('register')">
                            Register
                        </p>
                    </li>
                    <li class="list-group-item">
                        <p class="login" onclick="getClassOnClick('login')">
                            Login
                        </p>
                    </li>
                </ul>
            </p>
        </div>
    </div>
    <div id="home">
        <h3 >Home</h3>
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="row mb-3">
                    <img src="{{asset('manual/home-1.jpg')}}" alt="homes" width="100%">
                    <div class="col-md-6">
                        <img src="{{asset('manual/home-2.jpg')}}" alt="homes" width="100%">
                    </div>
                    <div class="col-md-6">
                        <img src="{{asset('manual/home-3.jpg')}}" alt="homes" width="100%">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <p style="text-align: justify">
                    Our homepage is your starting point to an exceptional experience. There you will find a wealth of information, services and opportunities, carefully organized to meet all your needs. Whether you're a curious visitor or a seasoned user, you've come to the right place to discover everything our app has to offer
                    Explore a variety of engaging content. Our homepage features articles, videos, images and more, all designed to inform, entertain and educate. Immerse yourself in a world of exciting discoveries, adapted to your preferences and interests.
                    Discover our exclusive services and special offers directly from the home page. From booking travel to ordering products, you'll find everything you need to simplify your life. Our app provides quick access to a variety of services, all just a click away.
                    Stay informed with our important information and announcements section. Our homepage displays essential updates, news and real-time alerts to keep you informed of important events and news.
                    Need to contact us? Our contact form is at your disposal. Whether it's to ask questions, report issues or share your feedback, we're listening. Simply fill out the form, and our team will respond quickly.
                    We value your experience. Customize the home page according to your preferences. Whether you're looking for specific news, products, or services, our easy-to-use user interface makes it easy to navigate and customize to meet your needs.
                </p>
            </div>
        </div>
    </div>
    <div id="service">
        <div class="row mb-3">
            <div class="col-md-6">
                <h5>What does our service page do?</h5>
                <p style="text-align: justify">
                    Our "Service" page is a gateway to a world of solutions and opportunities. It outlines our diverse range of offerings, meticulously designed to cater to your distinct needs. Whether you seek expert advice, top-notch products, or specialized assistance, you'll find it here. Dive into comprehensive service descriptions, detailed features, and pricing information. Discover what sets our services apart, as we showcase unique advantages and success stories from satisfied clients. Get in touch effortlessly through our contact options and explore personalized service recommendations. Your journey to finding the perfect solution starts right here on our "Service" page.
                </p>
            </div>
            <div class="col-md-6">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <img src="{{asset('manual/service-1.jpg')}}" alt="service" width="100%">
                    </div>
                    <div class="col-md-6">
                        <img src="{{asset('manual/service-1.jpg')}}" alt="service" width="100%">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="book">
        <h3>To book</h3>
        <div class="row mb-3">
            <div class="col-md-6">
                <img src="{{asset('manual/booking.jpg')}}" alt="booking" width="100%">
            </div>
            <div class="col-md-6">
                <p style="text-align: justify">
                    Our "Booking" page streamlines the process of reserving and scheduling services, ensuring a seamless and convenient experience for our customers. It allows users to book appointments, accommodations, tickets, or any service we offer. On this page, you can check availability, select preferred dates and times, and make secure online payments. It simplifies the booking process, saving you time and effort. Additionally, it provides instant confirmations and updates, making it easy to stay informed about your upcoming appointments or reservations. Our "Booking" page is your go-to destination for efficient and hassle-free reservations.
                    To be able to book in your application, make sure that you already have: an account in our application, an orange money account or an mvola account, or an airtel money account, or various others and most importantly a CIN or passport.
                </p>
            </div>

        </div>
    </div>
    <div id="information">
        <h5>What did you see in our information page?</h5>
        <p style="text-align: justify">
            In the information page, we list all the information relating to our company. Why choose us, what are our advantages. On the other hand we are also enthusiastic to give you a better time, to give the customer what they really want, whether a luxury trip or other but in complete safety with the customer who is the only master on board our cars recent.
        </p>
    </div>
    <div id="register">
        <h5>How to create an account with us?</h5>
        <p style="text-align: justify">
            To create an account with us, in the navigation bar, it says register. Click on register, and you are redirected to a page. On this page, you should see the name of the company, and some fields to fill out. First of all, you need to fill in the first field which is the username. In this field, you should give your username for the application (important: this field is no longer editable after having been validated), then you should give your email address, and your passwords, the email address that you sent must be your own email address, as this email address will be verified by our security system, and you will send a security key to activate your account.
        </p>
        <div class="text-center">
            <img src="{{asset('manual/register.jpg')}}" alt="register" width="50%">
        </div>
    </div>
    <div id="login">
        <h5>how to log in in our application?</h5>
        <p style="text-align: justify">
            login to our application is really very simple, our user-friendly authentication system. To get started, simply visit our application's login page. There, you'll find fields to enter your email address and password. If you're a registered user, enter your credentials. If you've forgotten your password, don't worry; just click on the 'Forgot your password?' link. Follow the instructions to reset your password through your email. Upon submitting your login details, Travel Pulse Caravan securely authenticates your information. Once logged in, you'll have access to your personalized dashboard and all the features our application offers. We've prioritized security and ease of use to make your experience seamless and secure.
        </p>
        <div class="text-center">
            <img src="{{asset('manual/login.jpg')}}" alt="register" width="50%">
        </div>
    </div>
    <script>
        function getClassOnClick(id) {
            var h3Element = document.getElementById(id);
            if (h3Element) {
                h3Element.scrollIntoView();
            }
        }
    </script>
@endsection
