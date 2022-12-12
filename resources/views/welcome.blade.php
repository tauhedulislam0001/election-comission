@extends('front')

@section('title')
| Home
@endsection

@section('extra-css')
<!-- <link href="{{asset('dashboard/assets/css/passenger.css')}}" rel="stylesheet" /> -->
<link href="{{asset('dashboard/assets/timepicker/dist/wickedpicker.min.css')}}" rel="stylesheet" />
<link href="{{asset('dashboard/assets/font-awesome/css/fontawesome.min.css')}}" rel="stylesheet" />

{{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />--}}
{{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">--}}
<link href="https://fonts.googleapis.com/css?family=Merriweather:400,900,900i" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    function getURLParameter(name) {
            return decodeURI((RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||[,null])[1]);
        }
        function hideURLParams() {
            //Parameters to hide (ie ?success=value, ?error=value, etc)
            var hide = ['success','error'];
            for(var h in hide) {
                if(getURLParameter(h)) {
                    history.replaceState(null, document.getElementsByTagName("title")[0].innerHTML, window.location.pathname);
                }
            }
        }

        //Run onload, you can do this yourself if you want to do it a different way
        window.onload = hideURLParams;
</script>
<style>
    @import url("https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900");

    .float {
        position: fixed;
        width: 60px;
        height: 60px;
        bottom: 40px;
        right: 40px;
        background-color: #25d366;
        color: #FFF;
        border-radius: 50px;
        text-align: center;
        font-size: 30px;
        box-shadow: 2px 2px 3px #999;
        z-index: 100;
    }

    .my-float {
        margin-top: 16px;
    }

    .content {
        position: relative;
    }

    .content h2 {
        margin-top: 50px;
        margin-bottom: 50px;
        color: #fc0000;
        font-size: 1.2em;
        position: absolute;
        transform: translate(-50%, -50%);
    }

    .content h2:nth-child(1) {
        color: transparent;
        -webkit-text-stroke: 2px #f8f7f7;
    }

    .content h2:nth-child(2) {
        color: #ffffff;
        animation: animate 4s ease-in-out infinite;
    }

    @keyframes animate {

        0%,
        100% {
            clip-path: polygon(0% 45%,
                    16% 44%,
                    33% 50%,
                    54% 60%,
                    70% 61%,
                    84% 59%,
                    100% 52%,
                    100% 100%,
                    0% 100%);
        }

        50% {
            clip-path: polygon(0% 60%,
                    15% 65%,
                    34% 66%,
                    51% 62%,
                    67% 50%,
                    84% 45%,
                    100% 46%,
                    100% 100%,
                    0% 100%);
        }
    }

    #button {
        display: inline-block;
        background-color: #85CB65;
        width: 50px;
        height: 50px;
        text-align: center;
        border-radius: 4px;
        position: fixed;
        bottom: 30px;
        left: 30px;
        transition: background-color .3s,
            opacity .5s, visibility .5s;
        opacity: 0;
        visibility: hidden;
        z-index: 1000;
    }

    #button::after {
        content: "\f077";
        font-family: FontAwesome;
        font-weight: normal;
        font-style: normal;
        font-size: 2em;
        line-height: 50px;
        color: #fff;
    }

    #button:hover {
        cursor: pointer;
        background-color: #333;
    }

    #button:active {
        background-color: #555;
    }

    #button.show {
        opacity: 1;
        visibility: visible;
    }
</style>

@endsection

@section('body')

@php
/* $ip=$_SERVER['REMOTE_ADDR'];


$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
$country = $details->country;
if($country == "MY"){
$currency = "RM";
}else{
$currency = "USD";
}*/
//$currency = "USD";
@endphp
<!-- hero container starts here -->
<div class="hero">
    <!-- hero container header starts here -->


    <div class="hero-header">

        <span class="hero-header-upper">BOOK YOUR RIDE IN</span>
        <section>
            <div class="content">
                <h2>BANGLADESH</h2>
                <h2>BANGLADESH</h2>
            </div>
        </section>
    </div>
    <!-- hero container links starts here -->
    <div class="hero-links">

        <a href="#carsection" data-val="Sedan - 2 Seat" class="hero-links-btn select-change"
            style="text-decoration : none;" onclick="$('.form-controllers-btn-car').trigger('click');">SEDAN</a>
        <a href="#carsection" data-val="HiAce - 7 Seat" class="hero-links-btn select-change"
            style="text-decoration : none" id="carsection-h-link"
            onclick="$('.form-controllers-btn-car').trigger('click');">Hi-ACE</a>
        <a href="#carsection" data-val="Noah - 5 seat" class="hero-links-btn select-change"
            style="text-decoration : none;" onclick="$('.form-controllers-btn-car').trigger('click');">NOAH</a>
    </div>


</div>
<!-- hero container ends here -->
<!-- Messenger Chat plugin Code -->
<div id="fb-root"></div>

<!-- Your Chat plugin code -->


<a id="button"></a>

<!-- popup form of destination -->

<div class="destination display-none">
    <div class="destination-cross-row">
        <img src="{{asset('dashboard/assets/Images/backicon.svg' )}}" alt="" class="destination-cross-img">
    </div>
    <!-- row 1 starts here -->
    <div class="destination-row destination-row-1">
        <div class="destination-row-column destination-row-1-column">
            <label class="destination-row-column-label destination-row-1-column-label">Airport</label>
            <select name="airport_name" id="airport_name"
                class="destination-row-column-select destination-row-1-column-select">
                <option>Select</option>
                @foreach($airports as $key =>$value)
                <option value="{{ $value }}">
                    {{ $key }}
                </option>
                @endforeach
            </select>
            @error('airport_name')
            <label id="airport_name-error" class="error" for="airport_name">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <!-- row 1 ends here -->
    <!-- row 2 starts here -->
    <div class="destination-row destination-row-2">
        <div class="destination-row-column destination-row-2-column">
            <label class="destination-row-column-label destination-row-2-column-label">Division</label>
            <select name="division_name" id="division_name" onchange="division_to_district(this)"
                class="destination-row-column-select destination-row-2-column-select">
                <option>Select</option>
                @foreach($divisions as $key =>$value)
                <option value="{{ $value }}">
                    {{ $key }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="destination-row-column destination-row-2-column">
            <label class="destination-row-column-label destination-row-2-column-label">District</label>
            <!-- <select name="" id="" class="destination-row-column-select destination-row-2-column-select"> -->
            <select name="district_name" id="district_name" onchange="district_to_thana(this)"
                class="destination-row-column-select destination-row-2-column-select">
                <option></option>
            </select>
            @error('district_name')
            <label id="district_name-error" class="error" for="district_name">{{ $message }}</label>
            @enderror
        </div>
        <div class="destination-row-column destination-row-2-column">
            <label class="destination-row-column-label destination-row-2-column-label">Thana</label>
            <select name="thana_name" id="thana_name"
                class="destination-row-column-select destination-row-2-column-select">
                <option></option>
            </select>
            @error('thana_name')
            <label id="thana_name-error" class="error" for="thana_name">{{ $message }}</label>
            @enderror
        </div>
        <div class="destination-row-column destination-row-2-column">
            <div class="destination-row-column-pricing destination-row-2-column-pricing" onclick="dSigleTripFair()">
                Pricing
            </div>
        </div>
    </div>
    <!-- row 2 ends here -->
    <!-- row 3 starts here -->
    <div class="destination-row destination-row-3" id="dCarFair">
        <!--                <div class="destination-row-column destination-row-3-column">
                                <div class="destination-row-column-price destination-row-3-column-price destination-row-column-price-best">
                                    RM 600
                                </div>
                                <div class="destination-row-column-car destination-row-3-column-car">
                                    Sedan - 4 Seat
                                </div>
                            </div>
                            <div class="destination-row-column destination-row-3-column">
                                <div class="destination-row-column-price destination-row-3-column-price">
                                    RM 600
                                </div>
                                <div class="destination-row-column-car destination-row-3-column-car">
                                    Sedan - 4 Seat
                                </div>
                            </div>
                            <div class="destination-row-column destination-row-3-column">
                                <div class="destination-row-column-price destination-row-3-column-price">
                                    RM 600
                                </div>
                                <div class="destination-row-column-car destination-row-3-column-car">
                                    Sedan - 4 Seat
                                </div>
                            </div>-->
    </div>
    <!-- row 3 ends here -->
    <!-- row 4 starts here -->
    <div class="destination-row destination-row-4">
        <div class="destination-row-column destination-row-4-column">
            <a href="#" class="destination-row-column-submit destination-row-4-column-submit">
                Submit
            </a>
        </div>
    </div>
    <!-- row 4 ends here -->
</div>

<!-- agent login popup starts here -->

<!-- popup form of agentlogin starts here -->

<div class="agentlogin display-none">
    <div class="agentlogin-cross-row">
        <img src="{{asset('dashboard/assets/Images/backicon.svg' )}}" alt="" class="agentlogin-cross-img">
    </div>
    <!-- row 1 starts here -->
    <div class="agentlogin-row agentlogin-row-1">
        <div class="agentlogin-row-column agentlogin-row-1-column">
            <label class="agentlogin-row-column-label agentlogin-row-1-column-label">ID / Email</label>
            <input type="text" name="" id="" class="agentlogin-row-column-input agentlogin-row-1-column-input">
        </div>
    </div>
    <!-- row 1 ends here -->
    <!-- row 2 starts here -->
    <div class="agentlogin-row agentlogin-row-2">
        <div class="agentlogin-row-column agentlogin-row-1-column">
            <label class="agentlogin-row-column-label agentlogin-row-1-column-label">Password</label>
            <input type="text" name="" id="" class="agentlogin-row-column-input agentlogin-row-1-column-input">
        </div>
    </div>
    <!-- row 2 ends here -->
    <div class="agentlogin-row agentlogin-row-3">
        <div class="agentlogin-row-column agentlogin-row-3-column">
            You don't have an account? <a href="#" class="agentloginlink">Become an Agent</a>
        </div>
    </div>
    <!-- row 4 starts here -->
    <div class="agentlogin-row agentlogin-row-4">
        <div class="agentlogin-row-column agentlogin-row-4-column">
            <a href="#" class="agentlogin-row-column-login agentlogin-row-4-column-login">
                Login
            </a>
        </div>
    </div>
    <!-- row 4 ends here -->
</div>

<!-- agent login popup ends here -->

<!-- popup form of signin starts here -->

<div class="agentlogin signinpopup display-none">
    <div class="agentlogin-cross-row">
        <img src="{{asset('dashboard/assets/Images/backicon.svg' )}}" alt=""
            class="agentlogin-cross-img signinpopup-cross-img">
    </div>
    <!-- row 1 starts here -->
    <div class="agentlogin-row agentlogin-row-1">
        <div class="agentlogin-row-column agentlogin-row-1-column">
            <label class="agentlogin-row-column-label agentlogin-row-1-column-label">ID / Email</label>
            <input type="text" name="" id="" class="agentlogin-row-column-input agentlogin-row-1-column-input">
        </div>
    </div>
    <!-- row 1 ends here -->
    <!-- row 2 starts here -->
    <div class="agentlogin-row agentlogin-row-2">
        <div class="agentlogin-row-column agentlogin-row-1-column">
            <label class="agentlogin-row-column-label agentlogin-row-1-column-label">Password</label>
            <input type="text" name="" id="" class="agentlogin-row-column-input agentlogin-row-1-column-input">
        </div>
    </div>
    <!-- row 2 ends here -->
    <div class="agentlogin-row agentlogin-row-3">
        <div class="agentlogin-row-column agentlogin-row-3-column">
            You don't have an account? <a href="#" class="signuplink">Signup</a>
        </div>
    </div>
    <!-- row 4 starts here -->
    <div class="agentlogin-row agentlogin-row-4">
        <div class="agentlogin-row-column agentlogin-row-4-column">
            <a href="#" class="agentlogin-row-column-login agentlogin-row-4-column-login">
                Signin
            </a>
        </div>
    </div>
    <!-- row 4 ends here -->
</div>

<!-- signin popup ends here -->

<!-- form controller start here -->
<div class="form-controller">
    <!-- form controllers (inner section) start here -->
    <div class="form-controllers">
        <!-- form controllers btn start here -->
        <div class="form-controllers-btn form-controllers-btn-car">
            <img id="1" src="{{asset('dashboard/assets/Images/f-btn-car-icon-blue.svg' )}}" alt="car icon"
                class="form-controllers-btn-img form-controllers-btn-img-car">

            <div class="form-controllers-btn-text">Car</div>
        </div>
        <!-- form controllers btn start here -->
        <div class="form-controllers-btn form-controllers-btn-air">
            <img id="2" src="{{ asset('dashboard/assets/Images/baggage.svg') }}" style="height: 50%" alt="air icon"
                class="form-controllers-btn-img form-controllers-btn-img-air">

            <div class="form-controllers-btn-text">Baggage & Seating Arrangements</div>
        </div>
        <!-- form controllers btn start here -->
        <!--            <div class="form-controllers-btn form-controllers-btn-car-air">
                <img id="3" src="{{asset('dashboard/assets/Images/f-btn-car-air-icon-blue.svg' )}}" alt="car air icon" class="form-controllers-btn-img form-controllers-btn-img-car-air">

                <div class="form-controllers-btn-text">Car + Air Ticket</div>
            </div>-->
        <div class="form-controllers-btn form-controllers-btn-car-air">
            <img id="3" src="{{asset('dashboard/assets/Images/f-btn-discount-icon.svg' )}}" alt="car air icon"
                class="form-controllers-btn-img form-controllers-btn-img-car-air">

            <div class="form-controllers-btn-text">Special Offer</div>
        </div>
        <!-- form controllers btn start here -->

    </div>
    <!-- form controllers (inner section) ends here -->
</div>

<script>


</script>
<!-- form controller ends here -->

<!-- booking form starts here -->
<div class="booking-form">
    <form method="POST" id="car_book_form">
        @csrf
        <!-- booking form for car starts here -->
        <div class="bookingform bookingform-car" id="carsection">
            <div class="bookingform-heading bookingform-car-heading">
                <img src="{{asset('dashboard/assets/Images/carbookingform-heading.svg' )}}" alt="car icon"
                    class="bookingform-heading-img bookingform-car-heading-img">
                <div class="bookingform-heading-text bookingform-car-heading-text">CAR</div>
            </div>
            <div class="bookingform-inner bookingform-car-inner">
                <!-- booking form inner column 1 starts here -->
                <div class="bookingform-inner-column bookingform-inner-column-1 bookingform-car-inner-column">
                    <div class="bookingform-inner-column-heading bookingform-car-inner-column-heading">
                        PICKUP
                    </div>
                    <div class="bookingform-inner-column-detail bookingform-car-inner-column-detail">
                        <div class="bookingform-inner-column-detail-input bookingform-car-inner-column-detail-input"
                            id="car-booking-car-type-wrap">
                            <div
                                class="bookingform-inner-column-detail-input-label bookingform-car-inner-column-detail-input-label">
                                Car Type
                            </div>
                            <select name="car_name" id="car_name"
                                class="bookingform-inner-column-detail-input-select bookingform-car-inner-column-detail-input-select"
                                required onchange="SigleTripFair();">
                                <option value="">Select</option>
                                @foreach($cars as $key =>$value)
                                <option value="{{ $value }}" @if($value==$car_name) selected @endif>
                                    {{ $key }}
                                </option>
                                @endforeach
                            </select>
                            @error('car_name')
                            <label id="car_name-error" class="error" for="car_name">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="bookingform-inner-column-detail-input bookingform-car-inner-column-detail-input"
                            style="width: 80%">
                            <div
                                class="bookingform-inner-column-detail-input-label bookingform-car-inner-column-detail-input-label">
                                Pickup Date (Bangladesh Time)
                            </div>
                            <!-- <input type="date" id="datepicker" name="date" id="" class="bookingform-inner-column-detail-input-date bookingform-car-inner-column-detail-input-date"> -->
                            <input
                                class="bookingform-inner-column-detail-input-select bookingform-car-inner-column-detail-input-select form-control border date "
                                id="car_datepicker" name="date" value="{{ $date }}" readonly="readonly" />
                        </div>
                        <div class="bookingform-inner-column-detail-input bookingform-car-inner-column-detail-input">
                            <div
                                class="bookingform-inner-column-detail-input-label bookingform-car-inner-column-detail-input-label">
                                Pickup Time (Bangladesh Time) 
                            </div>
                            <!-- <input type="time" name="" id="" class="bookingform-inner-column-detail-input-time bookingform-car-inner-column-detail-input-time"> -->
                            <input
                                class="bookingform-inner-column-detail-input-select bookingform-car-inner-column-detail-input-select form-control border date hasWickedpicker"
                                id="timepicker" class="form-control border date" type="text" name="time"
                                value="{{ $time }}" />
                        </div>
                        <div class="bookingform-inner-column-detail-input bookingform-car-inner-column-detail-input">
                            <div
                                class="bookingform-inner-column-detail-input-label bookingform-car-inner-column-detail-input-label">
                                Pickup Location
                            </div>
                            <select name="airport_name" id="airport_name_car"
                                class="bookingform-inner-column-detail-input-select bookingform-car-inner-column-detail-input-select"
                                required onchange="SigleTripFair(); dist2tha() ;">
                                <option value="">Select</option>
                                @foreach($airports as $key =>$value)
                                <option value="{{ $value }}" @if($value==$airport_name) selected @endif>
                                    {{ $key }}
                                </option>
                                @endforeach
                                <option value="Dhaka Airport - Hazrat Shahjalal International Airport">Dhaka</option>
                            </select>
                            @error('airport_name')
                            <label id="airport_name-error" class="error" for="airport_name">{{ $message }}</label>
                            @enderror
                        </div>


                        <div class="bookingform-inner-column-detail-input bookingform-car-inner-column-detail-input"
                            id="thana_name_car_pd" style="visibility: hidden">
                            <div
                                class="bookingform-inner-column-detail-input-label bookingform-car-inner-column-detail-input-label">
                                Area
                            </div>
                            <select name="pickup_area" id="thana_name_car_p"
                                class="bookingform-inner-column-detail-input-select bookingform-car-inner-column-detail-input-select"
                                onchange="">
                                <option value="">Select</option>
                                @foreach($thanas as $key =>$value)
                                <option value="{{ $value }}" @if($value==$thana_name) selected @endif>
                                    {{ $key }}
                                </option>
                                @endforeach
                            </select>
                            @error('pickup_area')
                            <label id="thana_name-error_p" class="error" for="pickup_area">{{ $message }}</label>
                            @enderror
                        </div>

                    </div>
                    <div class="bookingform-inner-column-detail-input bookingform-car-inner-column-detail-input"
                        id="pickup_address_d" name="pickup_address" style="margin-right: 0px; visibility: hidden;">
                        <div
                            class="bookingform-inner-column-detail-input-label bookingform-car-inner-column-detail-input-label">
                            Address
                        </div>
                        <input type="text" name="pickup_address" id="pickup_address"
                            class="bookingform-car-inner-column-detail-input-add bookingform-car-inner-column-detail-input-add">
                    </div>
                </div>

                <script>
                    $(document).ready(function(){
                            $('#airport_name_car').change(function () {
                                var select_ac=$('#airport_name_car option:selected').text();
                                //alert(select_ac);
                                if(select_ac =='Dhaka'){

                                    //document.getElementById("district_name_car_pd").style.visibility = "visible";
                                    document.getElementById("thana_name_car_pd").style.visibility = "visible";
                                    document.getElementById("pickup_address_d").style.visibility = "visible";
                                    //  alert(select_ac);
                                }else{

                                    //document.getElementById("district_name_car_pd").style.visibility = "hidden";
                                    document.getElementById("thana_name_car_pd").style.visibility = "hidden";
                                    document.getElementById("pickup_address_d").style.visibility = "hidden";
                                }
                            });


                        });
                </script>
                <!-- booking form inner column 1 ends here -->

                <!-- booking form inner column 2 starts here -->
                <div
                    class="bookingform-inner-column bookingform-inner-column-2 bookingform-inner-column bookingform-car-inner-column-2">
                    <div class="bookingform-inner-column-heading bookingform-car-inner-column-heading">
                        DROP
                    </div>
                    <div class="bookingform-inner-column-detail bookingform-car-inner-column-detail">
                        <div class="bookingform-inner-column-detail-input bookingform-car-inner-column-detail-input">
                            <div
                                class="bookingform-inner-column-detail-input-label bookingform-car-inner-column-detail-input-label">
                                Division
                            </div>

                            <select name="division_name" id="division_name" onchange="division2district(this)"
                                class="bookingform-inner-column-detail-input-select bookingform-car-inner-column-detail-input-select"
                                required>
                                <option value="">Select</option>
                                @foreach($divisions as $key =>$value)
                                <option value="{{ $value }}" @if($value==$division_name) selected @endif>
                                    {{ $key }}
                                </option>
                                @endforeach
                            </select>
                            @error('division_name')
                            <label id="division_name-error" class="error" for="division_name">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="bookingform-inner-column-detail-input bookingform-car-inner-column-detail-input">
                            <div
                                class="bookingform-inner-column-detail-input-label bookingform-car-inner-column-detail-input-label">
                                District
                            </div>
                            <select name="district_name" id="district_name_car" onchange="district2thana(this)"
                                class="bookingform-inner-column-detail-input-select bookingform-car-inner-column-detail-input-select"
                                required>
                                <option value="">Select</option>
                                @foreach($districts as $key =>$value)
                                <option value="{{ $value }}" @if($value==$district_name) selected @endif>
                                    {{ $key }}
                                </option>
                                @endforeach
                            </select>
                            @error('district_name_car')
                            <label id="district_name_car-error" class="error" for="district_name_car">{{ $message
                                }}</label>
                            @enderror
                        </div>
                        <div class="bookingform-inner-column-detail-input bookingform-car-inner-column-detail-input">
                            <div
                                class="bookingform-inner-column-detail-input-label bookingform-car-inner-column-detail-input-label">
                                Thana
                            </div>
                            <select name="thana_name" id="thana_name_car"
                                class="bookingform-inner-column-detail-input-select bookingform-car-inner-column-detail-input-select"
                                required onchange="SigleTripFair();">
                                <option value="">Select</option>
                                @foreach($thanas as $key =>$value)
                                <option value="{{ $value }}" @if($value==$thana_name) selected @endif>
                                    {{ $key }}
                                </option>
                                @endforeach
                            </select>
                            @error('thana_name')
                            <label id="thana_name-error" class="error" for="thana_name">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="bookingform-inner-column-heading bookingform-car-inner-column-heading">
                            TRAVELERS
                        </div>
                        <div class="bookingform-inner-column-detail-input bookingform-car-inner-column-detail-input"
                            style="flex-direction: row;justify-content: left;">
                            <div class="bookingform-inner-column-detail-input bookingform-car-inner-column-detail-input"
                                style="margin-right: 10px;">
                                <div
                                    class="bookingform-inner-column-detail-input-label bookingform-car-inner-column-detail-input-label">
                                    Adults <br /><small>(Above 12 years)</small>
                                </div>
                                <input min="1" max="7" type="number" name="no_of_passenger" id="no_of_passenger_adults"
                                    value="{{$no_of_passenger ?? '1'}}"
                                    class="bookingform-car-inner-column-detail-input-number bookingform-inner-column-detail-input-number">
                            </div>
                            <div class="bookingform-inner-column-detail-input bookingform-car-inner-column-detail-input"
                                style="margin-right: 10px;">
                                <div
                                    class="bookingform-inner-column-detail-input-label bookingform-car-inner-column-detail-input-label">
                                    Children <br /><small>(2-12 Years)</small>
                                </div>
                                <input min="0" max="7" type="number" name="children" id="no_of_passenger_children"
                                    value="{{$children ?? '0'}}"
                                    class="bookingform-car-inner-column-detail-input-number bookingform-inner-column-detail-input-number">
                            </div>
                            <div
                                class="bookingform-inner-column-detail-input bookingform-car-inner-column-detail-input">
                                <div
                                    class="bookingform-inner-column-detail-input-label bookingform-car-inner-column-detail-input-label">
                                    Infants <br /><small>(&lt; 24 months)</small>

                                </div>
                                <input min="0" max="7" type="number" name="infants" id="no_of_passenger_infants"
                                    value="{{$infants ?? '0'}}"
                                    class="bookingform-car-inner-column-detail-input-number bookingform-inner-column-detail-input-number">
                            </div>
                        </div>

                    </div>
                </div>
                <!-- booking form inner column 2 ends here -->

                <!-- booking form inner column 3 starts here -->

                <div
                    class="bookingform-inner-column bookingform-inner-column-3 bookingform-inner-column bookingform-car-inner-column-3">
                    <br>
                    <br>
                    <div class="bookingform-inner-column-pricing bookingform-car-inner-column-pricing"
                        onclick="SigleTripFair()">
                        Pricing
                    </div>
                    <div
                        class="bookingform-inner-column-selected-details bookingform-car-inner-column-selected-details">
                        <div class="bookingform-inner-column-selected-details-car bookingform-car-inner-column-selected-details-car"
                            id="car1">
                            --
                        </div>
                        <div class="bookingform-inner-column-selected-details-price bookingform-car-inner-column-selected-details-price"
                            id="car1_fair">
                            @if($fair != "")
                            <?php echo $currency; ?> {{$fair}}
                            @else
                            <?php echo $currency; ?> 0
                            @endif
                        </div>
                    </div>
                    <div class="bookingform-inner-column-suggestions bookingform-car-inner-column-suggestions">
                        <div class="bookingform-inner-column-suggestions-1 bookingform-car-inner-column-suggestions-1"
                            id="car2">
                            <div class="bookingform-inner-column-suggestions-1-price bookingform-car-inner-column-suggestions-1-price"
                                id="car2_fair" onclick="selectThisCar(2)" data-car-id="2">
                                <?php echo $currency; ?> 0
                            </div>
                            <div class="bookingform-inner-column-suggestions-1-car bookingform-car-inner-column-suggestions-1-car"
                                id="car2_name" onclick="selectThisCar(3)" data-car-id="2">Noah - 7 Seat</div>
                        </div>
                        <div class="bookingform-inner-column-suggestions-2 bookingform-car-inner-column-suggestions-2"
                            id="car3">
                            <div class="bookingform-inner-column-suggestions-1-price bookingform-car-inner-column-suggestions-1-price"
                                id="car3_fair" onclick="selectThisCar(3)" data-car-id="3">
                                <?php echo $currency; ?> 0
                            </div>
                            <div class="bookingform-inner-column-suggestions-1-car bookingform-car-inner-column-suggestions-1-car"
                                id="car3_name" onclick="selectThisCar(3)" data-car-id="3">HiAce - 12 Seat</div>
                        </div>
                    </div>
                    <div class="bookingform-inner-column-submit bookingform-car-inner-column-submit">
                        <div class="bookingform-inner-column-submit-check bookingform-car-inner-column-submit-check">
                            <input type="checkbox" name="" id="bookingform-inner-column-submit-check-box"
                                class="bookingform-inner-column-submit-check-box bookingform-car-inner-column-submit-check-box"
                                required>
                            <label for="bookingform-inner-column-submit-check-box"
                                class="bookingform-inner-column-submit-check-text bookingform-car-inner-column-submit-check-text">I
                                accept the <a href="{{route('tnc')}}" target="_blank">terms & condition</a>.</label>
                        </div>
                        <input name="fair" id="car-booking-fair" type="number" step=".01" style="display: none;"
                            value="{{$fair}}">
                        <input type="hidden" id="currency" name="currency" value="{{$currency}}">

                        <!-- <a href="passengerdetails.html" class="bookingform-inner-column-submit-btn bookingform-car-inner-column-submit-btn">
                                SUBMIT
                            </a> -->
                        <button type="submit" id="car_book_submit"
                            class="bookingform-inner-column-submit-btn bookingform-car-inner-column-submit-btn">NEXT</button>
                    </div>

                </div>
                <!-- booking form inner column 3 ends here -->

            </div>

        </div>
    </form>
    <!-- booking form for car ends here -->

    <!-- booking form for air starts here -->
    <div class="bookingform bookingform-air" id="airsection">
        <div class="bookingform-heading bookingform-air-heading">
            <!--                <img src="{{ asset('dashboard/assets/Images/baggage.svg') }}" alt="" style="height: 50%; color:white;" class="bookingform-heading-img bookingform-air-heading-img">-->
            <div class="bookingform-heading-text bookingform-air-heading-text">Baggage & Seating Arangements</div>
        </div>
        <div class="bookingform-inner bookingform-air-inner">


            <table border="0" cellpadding="0" cellspacing="0" id="sheet0" class="sheet0 gridlines">
                <col class="col0">
                <col class="col1">
                <col class="col2">
                <col class="col3">
                <tbody>
                    <tr class="row0">
                        <td class="column0 style1 s style1" colspan="3">Baggage Allocation </td>
                        <td class="column3 style2 s">Maximum Baggage can carry Dimensions wise </td>
                    </tr>
                    <tr class="row1">
                        <td class="column0 style3 s style3" rowspan="8">Dimensions of Baggage </td>
                        <td class="column1 style4 s style4" rowspan="2">Sedan</td>
                        <td class="column2 style5 s">The sum of all dimensions (L+B+H) must not exit 115 cm or 46 inches
                        </td>
                        <td class="column3 style6 n">1</td>
                    </tr>
                    <tr class="row2">
                        <td class="column2 style5 s">The sum of all dimensions (L+B+H) must not exit 72 cm or 28 inches
                        </td>
                        <td class="column3 style6 n">2</td>
                    </tr>
                    <tr class="row3">
                        <td class="column1 style7 s style7" rowspan="3">Noah</td>
                        <td class="column2 style5 s">The sum of all dimensions (L+B+H) must not exit 115 cm or 46 inches
                        </td>
                        <td class="column3 style6 n">2</td>
                    </tr>
                    <tr class="row4">
                        <td class="column2 style5 s">The sum of all dimensions (L+B+H) must not exit 72 cm or 28 inches
                        </td>
                        <td class="column3 style6 n">4</td>
                    </tr>
                    <tr class="row5">
                        <td class="column2 style5 s">The sum of all dimensions (L+B+H) must not exit 158 cm or 62 inches
                        </td>
                        <td class="column3 style6 n">2</td>
                    </tr>
                    <tr class="row6">
                        <td class="column1 style4 s style4" rowspan="3">Hiace </td>
                        <td class="column2 style5 s">The sum of all dimensions (L+B+H) must not exit 115 cm or 46 inches
                        </td>
                        <td class="column3 style6 n">3</td>
                    </tr>
                    <tr class="row7">
                        <td class="column2 style5 s">The sum of all dimensions (L+B+H) must not exit 72 cm or 28 inches
                        </td>
                        <td class="column3 style6 n">5</td>
                    </tr>
                    <tr class="row8">
                        <td class="column2 style5 s">The sum of all dimensions (L+B+H) must not exit 158 cm or 62 inches
                        </td>
                        <td class="column3 style6 n">3</td>
                    </tr>
                </tbody>
            </table><br>
            <div class="bookingform-inner-column-submit "
                style="font-size: 12px; flex-direction: row; align-items: center; text-align: center">
                <font color="#ffffff"><u style="font-size: 15px">Seating Arrangements</u></font><br /><br>

                Sedan = Maximum 2 person including child. <br />
                Noah = Maximum 5 person including child. <br />
                HiAce = Maximum 7 person including child. <br />

                <b> * Baggage space will be compromised with seating arrangement </b>
            </div>
            {{--
            <!-- booking form inner column 1 starts here -->
            <div class="bookingform-inner-column bookingform-inner-column-1 bookingform-air-inner-column">
                <div class="bookingform-inner-column-detail bookingform-air-inner-column-detail">
                    <div class="bookingform-inner-column-detail-input bookingform-air-inner-column-detail-input">
                        <div
                            class="bookingform-inner-column-detail-input-label bookingform-air-inner-column-detail-input-label">
                            Departure Airport
                        </div>
                        <!-- <select name="" id="" class="bookingform-inner-column-detail-input-select bookingform-air-inner-column-detail-input-select"> -->
                        <select name="airport_name" id="airport_name"
                            class="bookingform-inner-column-detail-input-select bookingform-air-inner-column-detail-input-select">
                            <option>Select</option>
                            @foreach($airports as $key =>$value)
                            <option value="{{ $value }}">
                                {{ $key }}
                            </option>
                            @endforeach
                        </select>
                        @error('airport_name')
                        <label id="airport_name-error" class="error" for="airport_name">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="bookingform-inner-column-detail-input bookingform-air-inner-column-detail-input">
                        <div
                            class="bookingform-inner-column-detail-input-label bookingform-air-inner-column-detail-input-label">
                            Passenger
                        </div>
                        <select name="" id=""
                            class="bookingform-inner-column-detail-input-select bookingform-air-inner-column-detail-input-select">
                            <option value="">Sedan - 4 seat</option>
                            <option value="">Sedan - 4 seat</option>
                            <option value="">Sedan - 4 seat</option>
                            <option value="">Sedan - 4 seat</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- booking form inner column 1 ends here -->

            <!-- booking form inner column 2 starts here -->
            <div class="bookingform-inner-column bookingform-inner-column-2 bookingform-air-inner-column">
                <div class="bookingform-inner-column-detail bookingform-air-inner-column-detail">
                    <div class="bookingform-inner-column-detail-input bookingform-air-inner-column-detail-input">
                        <div
                            class="bookingform-inner-column-detail-input-label bookingform-air-inner-column-detail-input-label">
                            Arrival Airport
                        </div>
                        <select name="" id=""
                            class="bookingform-inner-column-detail-input-select bookingform-air-inner-column-detail-input-select">
                            <option value="">Sedan - 4 seat</option>
                            <option value="">Sedan - 4 seat</option>
                            <option value="">Sedan - 4 seat</option>
                            <option value="">Sedan - 4 seat</option>
                        </select>
                    </div>
                    <div class="bookingform-inner-column-detail-input bookingform-air-inner-column-detail-input">
                        <div
                            class="bookingform-inner-column-detail-input-label bookingform-air-inner-column-detail-input-label">
                            BDT
                        </div>
                        <select name="" id=""
                            class="bookingform-inner-column-detail-input-select bookingform-air-inner-column-detail-input-select">
                            <option value="">Sedan - 4 seat</option>
                            <option value="">Sedan - 4 seat</option>
                            <option value="">Sedan - 4 seat</option>
                            <option value="">Sedan - 4 seat</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- booking form inner column 2 ends here -->

            <!-- booking form inner column 3 starts here -->
            <div class="bookingform-inner-column bookingform-inner-column-3 bookingform-air-inner-column">
                <div class="bookingform-inner-column-detail bookingform-air-inner-column-detail">
                    <div class="bookingform-inner-column-detail-input bookingform-air-inner-column-detail-input">
                        <div
                            class="bookingform-inner-column-detail-input-label bookingform-air-inner-column-detail-input-label">
                            Departing
                        </div>
                        <input type="date" name="" id=""
                            class="bookingform-inner-column-detail-input-date bookingform-air-inner-column-detail-input-date">
                    </div>
                    <div class="bookingform-inner-column-detail-input bookingform-air-inner-column-detail-input">
                        <div
                            class="bookingform-inner-column-detail-input-label bookingform-air-inner-column-detail-input-label">
                            Airlines
                        </div>
                        <select name="" id=""
                            class="bookingform-inner-column-detail-input-select bookingform-air-inner-column-detail-input-select">
                            <option value="">Sedan - 4 seat</option>
                            <option value="">Sedan - 4 seat</option>
                            <option value="">Sedan - 4 seat</option>
                            <option value="">Sedan - 4 seat</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- booking form inner column 3 ends here -->

            <!-- booking form inner column 4 starts here -->
            <div class="bookingform-inner-column bookingform-inner-column-4 bookingform-air-inner-column">
                <div class="bookingform-inner-column-detail bookingform-air-inner-column-detail">
                    <div
                        class="bookingform-inner-column-detail-input bookingform-air-inner-column-detail-input bookingform-air-inner-column-detail-input-pricing-btn">
                        <div
                            class="bookingform-inner-column-detail-input-label bookingform-air-inner-column-detail-input-label">
                            Returning
                        </div>
                        <input type="date" name="" id=""
                            class="bookingform-inner-column-detail-input-date bookingform-air-inner-column-detail-input-date">
                    </div>
                    <div
                        class="bookingform-inner-column-pricing bookingform-air-inner-column-pricing bookingform-air-pricing-btn">
                        Pricing
                    </div>
                </div>
            </div>
            <!-- booking form inner column 4 ends here -->
            --}}
        </div>
    </div>
    <!-- booking form for air ends here -->

    <!-- booking form for car and air ticket -->

    <div class="bookingform-car-air" id="carairsection">

        <!-- booking form for car starts here -->
        <div class="bookingform bookingform-car">
            <div class="bookingform-heading bookingform-car-heading">
                <!-- <img src="./Images/carbookingform-heading.svg" alt="car icon" class="bookingform-heading-img bookingform-car-heading-img"> -->
                <img src="{{ asset('dashboard/assets/Images/carbookingform-heading.svg') }}" alt="car icon"
                    class="bookingform-heading-img bookingform-car-heading-img">
                <div class="bookingform-heading-text bookingform-car-heading-text">Special Offer!!!</div>
            </div>
            <div class="bookingform-inner bookingform-car-inner">
                <p>Coming Soon...</p>
            </div>

            {{--
            <div class="bookingform-heading bookingform-car-heading">
                <!-- <img src="./Images/carbookingform-heading.svg" alt="car icon" class="bookingform-heading-img bookingform-car-heading-img"> -->
                <img src="{{ asset('dashboard/assets/Images/carbookingform-heading.svg') }}" alt="car icon"
                    class="bookingform-heading-img bookingform-car-heading-img">
                <div class="bookingform-heading-text bookingform-car-heading-text">CAR</div>
            </div>
            <div class="bookingform-inner bookingform-car-inner">

                <!-- booking form inner column 1 starts here -->
                <div class="bookingform-inner-column bookingform-inner-column-1 bookingform-car-inner-column">
                    <div class="bookingform-inner-column-heading bookingform-car-inner-column-heading">
                        PICKUP
                    </div>
                    <div class="bookingform-inner-column-detail bookingform-car-inner-column-detail">
                        <div class="bookingform-inner-column-detail-input bookingform-car-inner-column-detail-input">
                            <div
                                class="bookingform-inner-column-detail-input-label bookingform-car-inner-column-detail-input-label">
                                Car Type
                            </div>
                            <select name="" id=""
                                class="bookingform-inner-column-detail-input-select bookingform-car-inner-column-detail-input-select">
                                <option value="">Sedan - 4 seat</option>
                                <option value="">Sedan - 4 seat</option>
                                <option value="">Sedan - 4 seat</option>
                                <option value="">Sedan - 4 seat</option>
                            </select>
                        </div>
                        <div class="bookingform-inner-column-detail-input bookingform-car-inner-column-detail-input">
                            <div
                                class="bookingform-inner-column-detail-input-label bookingform-car-inner-column-detail-input-label">
                                Date
                            </div>
                            <input type="date" name="" id=""
                                class="bookingform-inner-column-detail-input-date bookingform-car-inner-column-detail-input-date">
                        </div>
                        <div class="bookingform-inner-column-detail-input bookingform-car-inner-column-detail-input">
                            <div
                                class="bookingform-inner-column-detail-input-label bookingform-car-inner-column-detail-input-label">
                                Time
                            </div>
                            <input type="time" name="" id=""
                                class="bookingform-inner-column-detail-input-time bookingform-car-inner-column-detail-input-time">
                        </div>
                        <div class="bookingform-inner-column-detail-input bookingform-car-inner-column-detail-input">
                            <div
                                class="bookingform-inner-column-detail-input-label bookingform-car-inner-column-detail-input-label">
                                Airport
                            </div>
                            <select name="" id=""
                                class="bookingform-inner-column-detail-input-select bookingform-car-inner-column-detail-input-select">
                                <option value="">Sedan - 4 seat</option>
                                <option value="">Sedan - 4 seat</option>
                                <option value="">Sedan - 4 seat</option>
                                <option value="">Sedan - 4 seat</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- booking form inner column 1 ends here -->

                <!-- booking form inner column 2 starts here -->
                <div
                    class="bookingform-inner-column bookingform-inner-column-2 bookingform-inner-column bookingform-car-inner-column-2">
                    <div class="bookingform-inner-column-heading bookingform-car-inner-column-heading">
                        DROP
                    </div>
                    <div class="bookingform-inner-column-detail bookingform-car-inner-column-detail">
                        <div class="bookingform-inner-column-detail-input bookingform-car-inner-column-detail-input">
                            <div
                                class="bookingform-inner-column-detail-input-label bookingform-car-inner-column-detail-input-label">
                                Division
                            </div>
                            <select name="division_name" id="division_name" onchange="division_to_district(this)"
                                class="bookingform-inner-column-detail-input-select bookingform-car-inner-column-detail-input-select">
                                <option>Select</option>
                                @foreach($divisions as $key =>$value)
                                <option value="{{ $value }}">
                                    {{ $key }}
                                </option>
                                @endforeach
                            </select>
                            @error('division_name')
                            <label id="division_name-error" class="error" for="division_name">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="bookingform-inner-column-detail-input bookingform-car-inner-column-detail-input">
                            <div
                                class="bookingform-inner-column-detail-input-label bookingform-car-inner-column-detail-input-label">
                                District
                            </div>
                            <!-- <select name="" id="" class="bookingform-inner-column-detail-input-select bookingform-car-inner-column-detail-input-select"> onchange="district_to_thana(this)"  -->
                            <select name="district_name" id="district_name"
                                class="bookingform-inner-column-detail-input-select bookingform-car-inner-column-detail-input-select">
                                <option></option>
                            </select>
                            @error('district_name7')
                            <label id="district_name-error" class="error" for="district_name7">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="bookingform-inner-column-detail-input bookingform-car-inner-column-detail-input">
                            <div
                                class="bookingform-inner-column-detail-input-label bookingform-car-inner-column-detail-input-label">
                                Thana
                            </div>
                            <select name="" id=""
                                class="bookingform-inner-column-detail-input-select bookingform-car-inner-column-detail-input-select">
                                <option value="">Sedan - 4 seat</option>
                                <option value="">Sedan - 4 seat</option>
                                <option value="">Sedan - 4 seat</option>
                                <option value="">Sedan - 4 seat</option>
                            </select>
                        </div>
                        <div class="bookingform-inner-column-detail-input bookingform-car-inner-column-detail-input">
                            <div
                                class="bookingform-inner-column-detail-input-label bookingform-car-inner-column-detail-input-label">
                                How Many People (INCLUDING CHILDREN)?
                            </div>
                            <input min="1" max="12" type="number" name="" id=""
                                class="bookingform-car-inner-column-detail-input-number bookingform-inner-column-detail-input-number">
                        </div>
                    </div>
                </div>
                <!-- booking form inner column 2 ends here -->


            </div>
            --}}
        </div>

        <!-- booking form for car ends here -->

        {{--
        <!-- booking form for air starts here -->
        <div class="bookingform bookingform-air bookingform-air-after-car" id="airbooksection">
            <div class="bookingform-heading bookingform-air-heading">
                <img src="{{ asset('dashboard/assets/Images/airbookingform-heading.svg') }}" alt="air icon"
                    class="bookingform-heading-img bookingform-air-heading-img">
                <div class="bookingform-heading-text bookingform-air-heading-text">AIR TICKET</div>
            </div>
            <div class="bookingform-inner bookingform-air-inner">
                <!-- booking form inner column 1 starts here -->
                <div class="bookingform-inner-column bookingform-inner-column-1 bookingform-air-inner-column">
                    <div class="bookingform-inner-column-detail bookingform-air-inner-column-detail">
                        <div class="bookingform-inner-column-detail-input bookingform-air-inner-column-detail-input">
                            <div
                                class="bookingform-inner-column-detail-input-label bookingform-air-inner-column-detail-input-label">
                                Departure Airport
                            </div>
                            <select name="" id=""
                                class="bookingform-inner-column-detail-input-select bookingform-air-inner-column-detail-input-select">
                                <option value="">Sedan - 4 seat</option>
                                <option value="">Sedan - 4 seat</option>
                                <option value="">Sedan - 4 seat</option>
                                <option value="">Sedan - 4 seat</option>
                            </select>
                        </div>
                        <div class="bookingform-inner-column-detail-input bookingform-air-inner-column-detail-input">
                            <div
                                class="bookingform-inner-column-detail-input-label bookingform-air-inner-column-detail-input-label">
                                Passenger
                            </div>
                            <select name="" id=""
                                class="bookingform-inner-column-detail-input-select bookingform-air-inner-column-detail-input-select">
                                <option value="">Sedan - 4 seat</option>
                                <option value="">Sedan - 4 seat</option>
                                <option value="">Sedan - 4 seat</option>
                                <option value="">Sedan - 4 seat</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- booking form inner column 1 ends here -->

                <!-- booking form inner column 2 starts here -->
                <div class="bookingform-inner-column bookingform-inner-column-2 bookingform-air-inner-column">
                    <div class="bookingform-inner-column-detail bookingform-air-inner-column-detail">
                        <div class="bookingform-inner-column-detail-input bookingform-air-inner-column-detail-input">
                            <div
                                class="bookingform-inner-column-detail-input-label bookingform-air-inner-column-detail-input-label">
                                Arrival Airport
                            </div>
                            <select name="" id=""
                                class="bookingform-inner-column-detail-input-select bookingform-air-inner-column-detail-input-select">
                                <option value="">Sedan - 4 seat</option>
                                <option value="">Sedan - 4 seat</option>
                                <option value="">Sedan - 4 seat</option>
                                <option value="">Sedan - 4 seat</option>
                            </select>
                        </div>
                        <div class="bookingform-inner-column-detail-input bookingform-air-inner-column-detail-input">
                            <div
                                class="bookingform-inner-column-detail-input-label bookingform-air-inner-column-detail-input-label">
                                BDT
                            </div>
                            <select name="" id=""
                                class="bookingform-inner-column-detail-input-select bookingform-air-inner-column-detail-input-select">
                                <option value="">Sedan - 4 seat</option>
                                <option value="">Sedan - 4 seat</option>
                                <option value="">Sedan - 4 seat</option>
                                <option value="">Sedan - 4 seat</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- booking form inner column 2 ends here -->

                <!-- booking form inner column 3 starts here -->
                <div class="bookingform-inner-column bookingform-inner-column-3 bookingform-air-inner-column">
                    <div class="bookingform-inner-column-detail bookingform-air-inner-column-detail">
                        <div class="bookingform-inner-column-detail-input bookingform-air-inner-column-detail-input">
                            <div
                                class="bookingform-inner-column-detail-input-label bookingform-air-inner-column-detail-input-label">
                                Departing
                            </div>
                            <input type="date" name="" id=""
                                class="bookingform-inner-column-detail-input-date bookingform-air-inner-column-detail-input-date">
                        </div>
                        <div class="bookingform-inner-column-detail-input bookingform-air-inner-column-detail-input">
                            <div
                                class="bookingform-inner-column-detail-input-label bookingform-air-inner-column-detail-input-label">
                                Airlines
                            </div>
                            <select name="" id=""
                                class="bookingform-inner-column-detail-input-select bookingform-air-inner-column-detail-input-select">
                                <option value="">Sedan - 4 seat</option>
                                <option value="">Sedan - 4 seat</option>
                                <option value="">Sedan - 4 seat</option>
                                <option value="">Sedan - 4 seat</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- booking form inner column 3 ends here -->

                <!-- booking form inner column 4 starts here -->
                <div class="bookingform-inner-column bookingform-inner-column-4 bookingform-air-inner-column">
                    <div class="bookingform-inner-column-detail bookingform-air-inner-column-detail">
                        <div
                            class="bookingform-inner-column-detail-input bookingform-air-inner-column-detail-input bookingform-air-inner-column-detail-input-pricing-btn">
                            <div
                                class="bookingform-inner-column-detail-input-label bookingform-air-inner-column-detail-input-label">
                                Returning
                            </div>
                            <input type="date" name="" id=""
                                class="bookingform-inner-column-detail-input-date bookingform-air-inner-column-detail-input-date">
                        </div>
                        <div
                            class="bookingform-inner-column-pricing bookingform-air-inner-column-pricing bookingform-air-pricing-btn">
                            Pricing
                        </div>
                    </div>
                </div>
                <!-- booking form inner column 4 ends here -->
            </div>
        </div>
        <!-- booking form for air ends here -->
        --}}
    </div>
    <!-- booking form for car and air ticket ends here -->

    <!-- air ticket pricing row starts here -->

    <div class="airpricing-row display-none">

        <!-- air pricing row 1 starts here -->

        <div class="airpricing-row-1">
            <div class="airpricing-row-1-column airpricing-row-1-column-1">
                <div class="airpricing-row-1-column-heading">
                    <img src="{{asset('dashboard/assets/Images/airbookingform-heading.svg' )}}" alt="plane icon"
                        class="airpricing-row-1-column-heading-img">
                    <div class="airpricing-row-1-column-heading-text">US Bangla Airlines</div>
                </div>
                <div class="airpricing-row-1-column-price">
                    30,000 /-
                </div>
            </div>
            <div class="airpricing-row-1-column airpricing-row-1-column-2">
                <div class="airpricing-row-1-column-heading">
                    <img src="{{asset('dashboard/assets/Images/airbookingform-heading.svg' )}}" alt="plane icon"
                        class="airpricing-row-1-column-heading-img">
                    <div class="airpricing-row-1-column-heading-text">US Bangla Airlines</div>
                </div>
                <div class="airpricing-row-1-column-price">
                    30,000 /-
                </div>
            </div>
            <div class="airpricing-row-1-column airpricing-row-1-column-3">
                <div class="airpricing-row-1-column-heading">
                    <img src="{{asset('dashboard/assets/Images/airbookingform-heading.svg' )}}" alt="plane icon"
                        class="airpricing-row-1-column-heading-img">
                    <div class="airpricing-row-1-column-heading-text">US Bangla Airlines</div>
                </div>
                <div class="airpricing-row-1-column-price">
                    30,000 /-
                </div>
            </div>
        </div>

        <!-- air pricing row 2 starts here -->

        <div class="airpricing-row-2">
            <input type="checkbox" name="" id="airpricing-row-2-checkbox" class="airpricing-row-2-check">
            <label for="airpricing-row-2-checkbox" class="airpricing-row-2-text">I accept the <a href="#">terms of
                    sale</a>.</label>
        </div>
        <!-- air pricing row 2 starts here -->

        <div class="airpricing-row-3">
            <a href="#" class="airpricing-row-3-submit">SUBMIT</a>
        </div>
    </div>

    <!-- air ticket pricing row ends here -->

</div>

<div class="partners-header">

    <img class="img-fluid" src="{{ asset('dashboard/assets/Images/Howto.jpg') }}">
</div>

<!-- booking form ends here -->

<!-- services start here -->
<div class="services" id="services">
    <h1>Our Services</h1>
    <p style="text-align: center; text-color: white;">Often passengers face difficulties to pick up a car from Airport.
        Garibook.com is giving a hassle-free ride booking platform from Airport pickup to your home drop. Now you can
        book your desire car before coming to Bangladesh and complete the entire journey smoother.</p>
    <!-- services row starts here -->
    <div class="services-row">

        <!-- services row column starts here -->
        <div class="services-row-column">
            <div class="services-row-column-icon">
                <img style=" max-width:230px; max-height:95px;"
                    src="{{asset('dashboard/assets/Images/Car-Pickup.png' )}}">
            </div>
            <div class="services-row-column-text">
                <div class="services-row-column-text-heading">
                    Car Pickup & Drop
                </div>
                <div class="services-row-column-text-detail">
                    Maximum Arrangements<br>
                    Proper Support
                </div>
            </div>
        </div>
        <!-- services row column starts here -->
        <div class="services-row-column">
            <div class="services-row-column-icon">
                <!-- <img src="./Images/services-icon.svg" alt="services-icon" class="services-row-column-icon-img"> -->
                <img style=" max-width:230px; max-height:95px;"
                    src="{{asset('dashboard/assets/Images/Car-Drop.png' )}}">
            </div>
            <div class="services-row-column-text">
                <div class="services-row-column-text-heading">
                    Easy Payment
                </div>
                <div class="services-row-column-text-detail">
                    No Hidden Costs<br>
                    Pay via Trusted Partners<br>
                    Easy Cancellation Policy

                </div>
            </div>
        </div>
        <!-- services row column starts here -->
        <div class="services-row-column">
            <div class="services-row-column-icon">
                <img style=" max-width:230px; max-height:95px;"
                    src="{{asset('dashboard/assets/Images/Air-Ticket.png' )}}">
            </div>
            <div class="services-row-column-text">
                <div class="services-row-column-text-heading">
                    Multiple Types of Cars
                </div>
                <div class="services-row-column-text-detail">
                    4 Seats Sedan plus Boot<br>
                    6 Seats Noah plus Boot<br>
                    8 Seats HiAce plus Boot<br>

                </div>
            </div>
        </div>
    </div>
    <!-- services row ends here -->

    <!-- services row starts here -->
    <div class="services-row">
        <!-- services row column starts here -->
        <div class="services-row-column">
            <div class="services-row-column-icon">
                <img style=" max-width:230px; max-height:95px;"
                    src="{{asset('dashboard/assets/Images/Car-Air-Ticket.png' )}}">
            </div>
            <div class="services-row-column-text">
                <div class="services-row-column-text-heading">
                    Worldwide Coverage
                </div>
                <div class="services-row-column-text-detail">
                    10 Countries.<br>
                    30 Cities. <br>
                    20 Airports

                </div>
            </div>
        </div>
        <!-- services row column starts here -->
        <div class="services-row-column">
            <div class="services-row-column-icon">
                <img style=" max-width:230px; max-height:95px;"
                    src="{{asset('dashboard/assets/Images/Special-Offer.png' )}}">
            </div>
            <div class="services-row-column-text">
                <div class="services-row-column-text-heading">
                    Country-wise Network
                </div>
                <div class="services-row-column-text-detail">
                    City based agent. <br>
                    Easy customer solution. <br>
                    Calculation in local currency.

                </div>
            </div>
        </div>
        <!-- services row column starts here -->
        <div class="services-row-column">
            <div class="services-row-column-icon">
                <img style=" max-width:230px; max-height:95px;" src="{{asset('dashboard/assets/Images/Others.png' )}}">
            </div>
            <div class="services-row-column-text">
                <div class="services-row-column-text-heading">
                    Coverage Area (Bangladesh)
                </div>
                <div class="services-row-column-text-detail">
                    Dhaka & Chittagong Airport <br>
                    Destination (Teknaf to Tetulia).



                </div>
            </div>
        </div>
    </div>
    <!-- services row ends here -->

    <!-- services row starts here -->
    <div class="services-row">
        <!-- services row column starts here -->
        <div class="services-row-column">
            <div class="services-row-column-icon">
                <img style=" max-width:230px; max-height:95px;"
                    src="{{asset('dashboard/assets/Images/Schedule.png' )}}">
            </div>
            <div class="services-row-column-text">
                <div class="services-row-column-text-heading">
                    Security
                </div>
                <div class="services-row-column-text-detail">
                    Quality, safe & licensed vehicles <br>
                    Professional & licensed Drivers

                </div>
            </div>
        </div>
        <!-- services row column starts here -->
        <div class="services-row-column">
            <div class="services-row-column-icon">
                <img style=" max-width:230px; max-height:95px;"
                    src="{{asset('dashboard/assets/Images/Payment-and-Relax.png' )}}">

            </div>
            <div class="services-row-column-text">
                <div class="services-row-column-text-heading">
                    Pricing
                </div>
                <div class="services-row-column-text-detail">
                    Maximum service in best economy price.
                    Affordable pricing & rent

                </div>
            </div>
        </div>
        <!-- services row column starts here -->
        <div class="services-row-column">
            <div class="services-row-column-icon">
                <img style=" max-width:230px; max-height:95px;"
                    src="{{asset('dashboard/assets/Images/Customer-Service.png' )}}">

            </div>
            <div class="services-row-column-text">
                <div class="services-row-column-text-heading">
                    24/7 Customer Service
                </div>
                <div class="services-row-column-text-detail">
                    24 Hours Helpline <br>
                    365 Days Support

                </div>
            </div>
        </div>
    </div>
    <!-- services row ends here -->

</div>
<!-- services end here -->

<!-- blogs start here -->
<div class="blogs">
    <!-- blogs container start here -->
    <div class="blogs-container">
        <div class="blogs-container-thumbnail">
            <img src="{{ asset('dashboard/assets/Images/blogthumbnail1.png') }}" alt="" title="blog thumbnail"
                class="blogs-container-thumbnail-img">
        </div>
        <div class="blogs-container-text">
            <div class="blogs-container-text-heading">
                Toyota HiAce Minibus
            </div>
            <div class="blogs-container-text-detail">
                2010 to 2019 Model <br />
                7+ Comfortable Seats
            </div>
        </div>
        <!-- <a href="#" class="blogs-container-link">
                Read More >>
            </a> -->
    </div>
    <!-- blogs container start here -->
    <div class="blogs-container">
        <div class="blogs-container-thumbnail">
            <!-- <img src="./Images/blogthumbnail2.png" alt="blog thumbnail" class="blogs-container-thumbnail-img"> -->
            <img src="{{ asset('dashboard/assets/Images/blogthumbnail2.png') }}" alt="blog thumbnail"
                class="blogs-container-thumbnail-img">
        </div>
        <div class="blogs-container-text">
            <div class="blogs-container-text-heading">
                Toyota NOAH Minivan
            </div>
            <div class="blogs-container-text-detail">
                2010 to 2019 Model <br />
                7+ Comfortable Seats
            </div>
        </div>
        <!-- <a href="#" class="blogs-container-link">
                Read More >>
            </a> -->
    </div>
    <!-- blogs container start here -->
    <div class="blogs-container">
        <div class="blogs-container-thumbnail">
            <img src="{{ asset('dashboard/assets/Images/blogthumbnail3.png') }}" alt="blog thumbnail"
                class="blogs-container-thumbnail-img">
        </div>
        <div class="blogs-container-text">
            <div class="blogs-container-text-heading">
                Toyota Sedan
            </div>
            <div class="blogs-container-text-detail">
                2010 to 2019 Model <br />
                3+ Comfortable Seats
            </div>
        </div>
        <!-- <a href="#" class="blogs-container-link">
                Read More >>
            </a> -->
    </div>
</div>
<!-- blogs end here -->


<!--    <div class="partners">

&lt;!&ndash;        <div class="partners-logo">
            <img src="{{ asset('dashboard/assets/Images/partner-logo.png') }}" alt="partner-logo"  class="partners-logo-img">
            <img src="{{ asset('dashboard/assets/Images/partner-logo.png') }}" alt="partner-logo"  class="partners-logo-img">
            <img src="{{ asset('dashboard/assets/Images/partner-logo.png') }}" alt="partner-logo"  class="partners-logo-img">
            <img src="{{ asset('dashboard/assets/Images/partner-logo.png') }}" alt="partner-logo"  class="partners-logo-img">
            <img src="{{ asset('dashboard/assets/Images/partner-logo.png') }}" alt="partner-logo"  class="partners-logo-img">
        </div>&ndash;&gt;
    </div>-->

@endsection

@section('extra-script')
<script src="{{asset('dashboard/assets/timepicker/dist/wickedpicker.min.js')}}"></script>

<script src="{{asset('dashboard/assets/js/app.js')}}" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
<script>
    var mobilecountrycode = document.querySelector(".mobilecountrycode-input")
        $(".mobilecountrycode-input").intlTelInput({
            initialCountry: "auto",
            geoIpLookup: function(callback) {
                $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
                    let countryCode = (resp && resp.country) ? resp.country : "bd";
                    callback(countryCode);
                    //  alert (countryCode);
                });
            },
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.4.6/js/utils.js"
        });

        //pickup


        function division_to_district(val) {
            var id = val.value;
            // alert(id);
            $('#district_name').html("");


            $.ajax({
                url: "{{ route('divTodistrict') }}",
                type: 'get',
                data: {
                    id: id,
                },
                success: function(data) {
                    // console.log(data);
                    $('#district_name').html(data);
                    //                 $('select').select2({
                    //                    placeholder: "Select" ,
                    // allowClear: true
                    // });

                }
            });
        }

        function division2district(val) {
            $('#car-booking-car-type-wrap').show();
            var id = val.value;
            // alert(id);
            $('#district_name_car').html("");


            $.ajax({
                url: "{{ route('divTodistrict') }}",
                type: 'get',
                data: {
                    id: id,
                },
                success: function(data) {
                    // console.log(data);
                    $('#district_name_car').html(data);
                    //                 $('select').select2({
                    //                    placeholder: "Select" ,
                    // allowClear: true
                    // });

                }
            });
        }



        function district_to_thana(val) {
            var id = val.value;
            // alert(id);
            $('#thana_name').html("");


            $.ajax({
                url: "{{ route('district2thana') }}",
                type: 'get',
                data: {
                    id: id,
                },
                success: function(data) {
                    // console.log(data);
                    $('#thana_name').html(data);
                    //                 $('select').select2({
                    //                    placeholder: "Select" ,
                    // allowClear: true
                    // });

                }
            });
        }

        function dist2tha() {
            var id = "Dhaka";
            // alert(id);
            $('#pickup_area').html("");


            $.ajax({
                url: "{{ route('district2thana') }}",
                type: 'get',
                data: {
                    id: id,
                },
                success: function(data) {
                    // console.log(data);
                    $('#thana_name_car_p').html(data);
                    //                 $('select').select2({
                    //                    placeholder: "Select" ,
                    // allowClear: true
                    // });

                }
            });
        }


        function district2thana(val) {
            $('#car-booking-car-type-wrap').show();
            var id = val.value;
            // alert(id);
            $('#thana_name_car').html("");
            //var airport = "Dhaka Airport - Hazrat Shahjalal International Airport"
            // alert($('#airport_name_car').val());


            $.ajax({
                url: "{{ route('district2thana') }}",
                type: 'get',
                data: {
                    id: id,
                    car_name: $('#car_name').val(),
                    airport_name: $('#airport_name_car').val(),
                },
                success: function(data) {
                    // console.log(data);
                    $('#thana_name_car').html(data);
                    //                 $('select').select2({
                    //                    placeholder: "Select" ,
                    // allowClear: true
                    // });

                }
            });
        }




        function SigleTripFair() {
            //  var location = countryCode;
            var location = "<?php echo $currency; ?>";
            var car_name = $('#car_name').val();
            var airport_name = $('#airport_name_car').val();
            var thana_name = $('#thana_name_car').val();
            var district_name = $('#district_name_car').val();
            //alert(district_name);
            if (car_name == "") {
                // alert("Car Type not Selected");
                return;
            }
            if (airport_name == "") {
                // alert("Car Type not Selected");
                return;
            }
            if (thana_name == "") {
                // alert("Car Type not Selected");
                district2thana($('#district_name_car').get(0));
                return;
            }

            //    if ($('#airport_name').val() == "Select") {
            //        alert("Airport not Selected");
            //    }
            //    if ($('#thana_name').val() == "" || $('#thana_name').val() == "Select") {
            //        alert("Thana not Selected");
            //    }

            $.ajax({
                url: "{{ route('SingleFair') }}",
                type: 'get',
                dataType: 'json',
                data: {
                    car_name: car_name,
                    airport_name: airport_name,
                    thana_name: thana_name,
                    currency: location,
                    district_name :district_name ,
                },
                success: function(data) {
                    // alert(data);
                    // console.log(data);
                    if (data.fair == 0) {
                        alert("The destination fair not set yet for "+car_name+"! Select other car");
                    }

                    $('#car1_fair').html("");

                    $('#car1').html(car_name);
                    $('#car1_fair').html('<?php echo $currency; ?> '+data.fair.toLocaleString());
                    $('#car-booking-fair').val(data.fair);
                    console.log(data.otherFair);
                    if (data.otherFair) {
                        let i = 1;
                        for (const [key, value] of Object.entries(data.otherFair)) {
                            i++;
                            $('#car'+i+"_fair").html('<?php echo $currency; ?> '+value.fair.toLocaleString()).show();
                            $('#car'+i+"_name").html(value.car_name).show();
                            console.log(`${key}: ${value}`);
                        }
                        if (i==2) {
                            $('#car3_fair').hide();
                            $('#car3_name').hide();
                            // $('#car-booking-car-type-wrap').hide();
                        }
                    }

                }
            });
        }

        function selectThisCar(car_id) {
            let car_name = $('#car'+car_id+"_name").html();
            $('#car_name').val(car_name).trigger('change');
            $('#car1').html('Loading ...');
            $('#car1_fair').html('<?php echo $currency; ?> ');
        }

        function dSigleTripFair() {
            var car_name = $('#car_name').val();
            var airport_name = $('#airport_name').val();
            var thana_name = $('#thana_name').val();
            // alert(airport_name);
            if ($('#airport_name').val() == "Select") {
                alert("Airport not Selected");
            }

            $.ajax({
                url: "{{ route('dSingleFair') }}",
                type: 'get',
                data: {
                    car_name: car_name,
                    airport_name: airport_name,
                    thana_name: thana_name,
                },
                success: function(data) {
                    // alert(data);
                    // console.log(data);
                    if (data == 0) {
                        alert("The destination fair not set yet!");
                    }
                    $('#dCarFair').html("");

                    //    $('#car1').html(car_name);
                    $('#dCarFair').html(data);

                    //                 $('select').select2({
                    //                    placeholder: "Select" ,
                    // allowClear: true
                    // });

                }
            });
        }


        function car2Fair() {
            var car_name = $('#car_name').val();
            var airport_name = $('#airport_name_car').val();
            var thana_name = $('#thana_name_car').val();
            // alert(airport_name);
            if ($('#car_name').val() == "Select") {
                alert("Car Type not Selected");
            }

            $.ajax({
                url: "{{ route('SingleFair') }}",
                type: 'get',
                data: {
                    car_name: car_name,
                    airport_name: airport_name,
                    thana_name: thana_name,
                },
                success: function(data) {
                    // alert(data);
                    // console.log(data);
                    if (data == 0) {
                        alert("The destination fair not set yet!");
                    }
                    $('#car1_fair').html("");

                    $('#car1').html(car_name);
                    $('#car1_fair').html('<?php echo $currency; ?> '+data);

                }
            });
        }

        $(document).ready(function() {
            @if ($car_name != '' && $thana_name != '')
            SigleTripFair();

            $('html, body').animate({
                scrollTop: $("#carsection").offset().top
            }, 400);
            @endif
            $('#car_name').change(function() {
                if ($('#thana_name_car').val() != "") {
                    return;
                }

                switch ($('#car_name').val()) {
                    case 'HiAce - 7 Seat':
                        $("#car2_name").html("Noah - 5 seat");
                        $("#car3_name").html("Sedan - 2 Seat");
                        break;
                    case 'Noah - 5 seat':
                        $("#car2_name").html("HiAce - 7 Seat");
                        $("#car3_name").html("Sedan - 2 Seat");
                        break;
                    case 'Sedan - 2 Seat':
                    default:
                        $("#car2_name").html("Noah - 5 seat");
                        $("#car3_name").html("HiAce - 7 Seat");
                        break;
                }
            });
            // for car_booking-------------
            $('form#car_book_form').submit(function(e) {
                //    alert($('#bookingform-inner-column-submit-check-box').val());
                if ($('#car_name').val() == "") {
                    alert("Car Type Field Requird");
                    return false;
                }
                // console.log($('#car_name').val());
                if ($('#airport_name').val() == "") {
                    alert("Airport Field Requird");
                    return false;
                }
                if ($('#thana_name_car').val() == "") {
                    alert("Thana must be Selected");
                    return false;
                }

                if ($('#car_name').val().indexOf('Sedan') !== -1) {
                    if( ( parseInt($('#no_of_passenger_adults').val()) + parseInt($('#no_of_passenger_children').val()) ) > 3 ) {
                        alert("Passenger can't be more then 3 person.");
                        return false;
                    }
                }

                if ($('#car_name').val().indexOf('HiAce') !== -1) {
                    if( (parseInt($('#no_of_passenger_adults').val()) + parseInt($('#no_of_passenger_children').val()) ) > 7 ) {
                        alert("Passenger can't be more then 7 person.");
                        return false;
                    }
                }

                if ($('#car_name').val().indexOf('Noah') !== -1) {
                    if( (parseInt($('#no_of_passenger_adults').val()) + parseInt($('#no_of_passenger_children').val()) ) > 5 ) {
                        alert("Passenger can't be more then 5 person.");
                        return false;
                    }
                }

                let pickupTime = $('#timepicker').val();


                pickupTime = pickupTime.replace(/\s/g, '');

                var convertedTime = moment(pickupTime, 'hh:mm A').format('HH:mm')
                // console.log(convertedTime);
// Output: 13:00
                // alert(convertedTime);


                if (!isDateBeforeTwelveHoursBDTime($('#car_datepicker').val()+' '+convertedTime+':00')) {
                    alert("You can't Book when your Pickup Time left less then 12 hours.");
                    return false;
                }

                e.preventDefault();

                // savePageState('home', '#carsection');

                /*Ajax Request Header setup*/
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                //alert('hjkkjkj');
                //$('#send_form').html('Sending..');

                /* Submit form data using ajax*/
                $.ajax({
                    url: "{{ route('carBookForm')}}",
                    method: 'post',
                    data: $('#car_book_form').serialize(),
                    success: function(response) {
                        //    alert (response);
                        if (response == 1) {
                            // alert("Car booking successfully!");
                            window.location.href = "{{ route('carBookingStep2')}}";
                        } else {
                            alert("Must be fill Requird Field!");
                        }

                        //------------------------
                        //$('#send_form').html('Submit');
                        //$('#res_message').html(response.msg);
                        //$('#msg_div').removeClass('d-none');

                        //    document.getElementById("car_book_form").reset();
                        setTimeout(function() {
                            //$('#res_message').hide();
                            //$('#msg_div').hide();
                        }, 10000);
                        //--------------------------
                    }
                });
            });
            //close car booking


            $('#car_datepicker').datepicker({
                uiLibrary: 'bootstrap4',
                minDate: new Date(new Date().setDate(new Date().getDate() - 1)),
                maxDate: new Date(new Date().setDate(new Date().getDate() + 90))



            });


            $('#datepicker').datepicker({
                uiLibrary: 'bootstrap4'

            });
            // $('#timepicker').timepicker({
            //     uiLibrary: 'bootstrap4',
            //     showInputs: false,
            //     showMeridian: false
            // });
            $('#timepicker').wickedpicker({twentyFour: false});

        });




</script>
<script>
    var btn = $('#button');

        $(window).scroll(function() {
            if ($(window).scrollTop() > 300) {
                btn.addClass('show');
            } else {
                btn.removeClass('show');
            }
        });

        btn.on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({scrollTop:0}, '300');
        });
        $('.select-change').click(function(){
            $('#car_name').val($(this).data('val')).trigger('change');
        })


        //url hide

</script>
@endsection