<?php

namespace App\Http\Controllers\Frontend;

use App\Airlines;
use App\Airport;
use App\Car;
use App\District;
use App\Division;
use App\Http\Controllers\Controller;
use App\Thana;
use App\Tracker;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Countries\Package\Services\Countries;
use Alert;
use App\ContactUs;
use App\CustomerFeedBack;
use App\DepartureAirport;
use App\HolidayFare;
use App\PGCurrencyConversion;
use App\Session as AppSession;
use Illuminate\Support\Facades\Session;

class FrontendController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function getIndex(Request $request)
    {
        if (session()->has('success')) {
            toast(Session('success'), 'success');
        }

        if (session()->has('error')) {
            toast(Session('error'), 'error');
        }
        
        return view('login.login');
    }

    public function getIndexBN(Request $request)
    {
        if (session()->has('success')) {
            toast(Session('success'), 'success');
        }

        if (session()->has('error')) {
            toast(Session('error'), 'error');
        }

        $Countries = new Countries(); // package
        $countries = $Countries->all()->pluck('name.common')->toArray();

        $nationalities = NATIONALITY_LIST;
        $airlines = Airlines::orderBy('airlines_name')->get()->pluck('airlines_name', 'airlines_name');

        $cars = Car::get()->pluck('name', 'name');
        $airports = Airport::get()->pluck('name', 'name');
        $divisions = Division::orderBy('division_name')->get()->pluck('division_name', 'division_name');
        $districts = District::orderBy('district_name')->get()->pluck('district_name', 'district_name');
        $thanas = Thana::orderBy('thana_name')->get()->pluck('thana_name', 'thana_name');

        $paymentMethods = PAYMENT_METHODS;

        Tracker::firstOrCreate([
            'ip' => $_SERVER['REMOTE_ADDR']
        ], [
            'ip' => $_SERVER['REMOTE_ADDR'],
            'current_date' => date('Y-m-d')
        ])->save();

        if (Auth::guard('admin')->check()) {

            $currency = Auth::guard('admin')->user()->currency ?? NULL;
        } else {

            $SelectedCountry = $request['country'] ?? null;

            if ($SelectedCountry == Null) {

                $ip = $_SERVER['REMOTE_ADDR'];
                $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
                $country = $details->country ?? Null;

                if ($country == Null) {
                    $currency = "BDT";
                } elseif ($country == "MY") {
                    $currency = "RM";
                } elseif ($country == "USA") {
                    $currency = "BDT";
                } elseif ($country == "MV") {
                    $currency = "BDT";
                } elseif ($country == "BD") {
                    $currency = "BDT";
                } elseif ($country == "AT" || $country == "BE" || $country == "BG" || $country == "HR" || $country == "CY" || $country == "CZ" || $country == "DK" || $country == "EE" || $country == "FI" || $country == "FR" || $country == "DE" || $country == "GR" || $country == "HU" || $country == "IE" || $country == "IT" || $country == "LV" || $country == "LT" || $country == "LU" || $country == "MT" || $country == "NL" || $country == "PL" || $country == "PT" || $country == "RO" || $country == "SK" || $country == "SI" || $country == "ES" || $country == "SE") {
                    $currency = "BDT";
                } else {
                    $currency = "BDT";
                }
            } else {

                if ($SelectedCountry == "USA") {
                    $currency = "USD";
                } elseif ($SelectedCountry == "MY") {
                    $currency = "RM";
                } elseif ($SelectedCountry == "MV") {
                    $currency = "MUSD";
                } elseif ($SelectedCountry == "EU") {
                    $currency = "EUR";
                }

                // elseif ($SelectedCountry == "BD") {
                //     $currency = "BDT";

                // }
                elseif ($SelectedCountry == "EU") {
                    $currency = "EUR";
                } else {
                    $currency = "BDT";
                }
            }
        }

        // $currency_loggedin = Auth::guard('admin')->user()->currency ?? NULL;

        $districts = [];
        $thanas = [];

        $car_name = $date = $time = $airport_name = $division_name = $district_name = $thana_name = "";
        $no_of_passenger = 1;
        $children = 0;
        $infants = 0;
        $fair = 0;
        $formData = $request->session()->get('carBookingStep1Data', []);
        // dd($formData);
        if ($request->back == 1 and !empty($formData)) {
            $formData = (object) $formData;

            if (isset($formData->division_name)) {
                $districts = District::where('divisions_id', $formData->division_name)->get()->pluck('district_name', 'district_name');
                $division_name = $formData->division_name;
            }

            if (isset($formData->district_name)) {
                $thanas = Thana::where('district_name', $formData->district_name)->get()->pluck('thana_name', 'thana_name');
                $district_name = $formData->district_name;
            }

            if (isset($formData->thana_name)) {
                $thana_name = $formData->thana_name;
            }
            if (isset($formData->car_name)) {
                $car_name = $formData->car_name;
            }
            if (isset($formData->date)) {
                $date = $formData->date;
            }
            if (isset($formData->time)) {
                $time = $formData->time;
            }
            if (isset($formData->airport_name)) {
                $airport_name = $formData->airport_name;
            }
            if (isset($formData->no_of_passenger)) {
                $no_of_passenger = $formData->no_of_passenger;
            }
            if (isset($formData->children)) {
                $children = $formData->children;
            }
            if (isset($formData->infants)) {
                $infants = $formData->infants;
            }
            if (isset($formData->fair)) {
                $fair = $formData->fair;
            }
        }
        $customerFeedback = CustomerFeedBack::where('status', 1)->latest()->get();
        if ($request->session()->has('car')) {
            $session = session()->all();
        } else {
            $session = '';
        }
        $departure_aiprort = DepartureAirport::all();

        return view('frontend.pages.lang.bangla.home.index', compact('customerFeedback', 'countries', 'cars', 'car_name', 'airports', 'divisions', 'division_name', 'airport_name', 'fair', 'districts', 'thanas', 'nationalities', 'airlines', 'paymentMethods', 'currency', 'session', 'departure_aiprort'));
    }

    public function visitSite(Request $request)
    {
        if (session()->has('success')) {
            toast(Session('success'), 'success');
        }

        if (session()->has('error')) {
            toast(Session('error'), 'error');
        }

        $Countries = new Countries(); // package
        $countries = $Countries->all()->pluck('name.common')->toArray();

        $nationalities = NATIONALITY_LIST;
        $airlines = Airlines::orderBy('airlines_name')->get()->pluck('airlines_name', 'airlines_name');

        $cars = Car::get()->pluck('name', 'name');
        $airports = Airport::get()->pluck('name', 'name');
        $divisions = Division::orderBy('division_name', 'ASC')->get()->pluck('division_name', 'division_name');
        $districts = District::pluck('district_name', 'district_name');
        $thanas = Thana::pluck('thana_name', 'thana_name');

        $paymentMethods = PAYMENT_METHODS;

        Tracker::firstOrCreate([
            'ip' => $_SERVER['REMOTE_ADDR']
        ], [
            'ip' => $_SERVER['REMOTE_ADDR'],
            'current_date' => date('Y-m-d')
        ])->save();

        if (Auth::guard('admin')->check()) {

            $currency = Auth::guard('admin')->user()->currency ?? NULL;
        } else {

            $SelectedCountry = $request['country'] ?? null;

            if ($SelectedCountry == Null) {

                $ip = $_SERVER['REMOTE_ADDR'];
                $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
                $country = $details->country ?? Null;

                if ($country == Null) {
                    $currency = "BDT";
                } elseif ($country == "MY") {
                    $currency = "RM";
                } elseif ($country == "USA") {
                    $currency = "BDT";
                    // } elseif ($country == "MV") {
                    //     $currency = "MUSD";
                    // }
                    // elseif ($country == "AT" || $country == "BE"|| $country == "BG"|| $country == "HR"|| $country == "CY"|| $country == "CZ"|| $country == "DK"|| $country == "EE"|| $country == "FI"|| $country == "FR"|| $country == "DE"|| $country == "GR"|| $country == "HU"|| $country == "IE"|| $country == "IT"|| $country == "LV"|| $country == "LT"|| $country == "LU"|| $country == "MT"|| $country == "NL"|| $country == "PL"|| $country == "PT"|| $country == "RO"|| $country == "SK"|| $country == "SI"|| $country == "ES"|| $country == "SE") {
                    //     $currency = "EUR";
                } else {
                    $currency = "BDT";
                }
            } else {

                if ($SelectedCountry == "USA") {
                    $currency = "USD";
                } elseif ($SelectedCountry == "MY") {
                    $currency = "RM";
                } elseif ($SelectedCountry == "MV") {
                    $currency = "MUSD";
                    // }elseif ($SelectedCountry == "BD") {
                    //     $currency = "BDT";
                    // }elseif ($SelectedCountry == "EU") {
                    //     $currency = "EUR";
                } else {
                    $currency = "USD";
                }
            }
        }

        // $currency_loggedin = Auth::guard('admin')->user()->currency ?? NULL;

        $districts = [];
        $thanas = [];

        $car_name = $date = $time = $airport_name = $division_name = $district_name = $thana_name = "";
        $no_of_passenger = 1;
        $children = 0;
        $infants = 0;
        $fair = 0;

        if ($formData = $request->session()->get('car-select-form', []) != "") {

            $formData = $request->session()->get('car-select-form', []);
            // dd($formData);

        } else {
            dd('nai');
        }
        if ($request->back == 1 and !empty($formData)) {
            $formData = (object) $formData;

            if (isset($formData->division_name)) {
                $districts = District::where('divisions_id', $formData->division_name)->get()->pluck('district_name', 'district_name');
                $division_name = $formData->division_name;
            }

            if (isset($formData->district_name)) {
                $thanas = Thana::where('district_name', $formData->district_name)->get()->pluck('thana_name', 'thana_name');
                $district_name = $formData->district_name;
            }

            if (isset($formData->thana_name)) {
                $thana_name = $formData->thana_name;
            }
            if (isset($formData->car_name)) {
                $car_name = $formData->car_name;
            }
            if (isset($formData->date)) {
                $date = $formData->date;
            }
            if (isset($formData->time)) {
                $time = $formData->time;
            }
            if (isset($formData->airport_name)) {
                $airport_name = $formData->airport_name;
            }
            if (isset($formData->no_of_passenger)) {
                $no_of_passenger = $formData->no_of_passenger;
            }
            if (isset($formData->children)) {
                $children = $formData->children;
            }
            if (isset($formData->infants)) {
                $infants = $formData->infants;
            }
            if (isset($formData->fair)) {
                $fair = $formData->fair;
            }
        }

        $customerFeedback = CustomerFeedBack::where('status', 1)->latest()->get();
        if ($request->session()->has('car')) {
            $session = session()->all();
        } else {
            $session = '';
        }
        // $user = Auth::guard('admin')->user()->user_type;
        // // $user = Auth::guard('api')->user()->user_type;
        $departure_aiprort = DepartureAirport::all();
        // dd($user);
        return view('frontend.pages.lang.english.home.index', compact('customerFeedback', 'countries', 'cars', 'formData', 'car_name', 'airports', 'divisions', 'division_name', 'airport_name', 'fair', 'districts', 'thanas', 'nationalities', 'airlines', 'paymentMethods', 'currency', 'session', 'departure_aiprort'));
    }

    // user logout

    public function logout(Request $request)
    {
        $SingleTripId = session()->get('SingleTripId');
        $RoundTripId = session()->get('RoundTrip');
        $MultiCity = session()->get('MultiCity');

        if ($SingleTripId != null) {
            AppSession::where('id', $SingleTripId)->delete();
            Session::forget('SingleTripId');
        }elseif($RoundTripId != null){
            AppSession::where('id', $RoundTripId)->delete();
            Session::forget('RoundTrip');
        }elseif($MultiCity != null){
            AppSession::where('id', $MultiCity)->delete();
            Session::forget('MultiCity');
        }
        Auth::logout();
        return redirect()->back();
        // $this->guard()->logout();

        // if ($response = $this->loggedOut($request)) {
        //     return $response;
        // }

        // return $request->wantsJson()
        //     ? new JsonResponse([], 204)
        //     : back();
    }
    public function ContactFormStore(Request $request){
        $store = new ContactUs();
        $store->first_name =$request->first_name;
        $store->last_name =$request->last_name;
        $store->phone_no =$request->phone_no;
        $store->email =$request->email;
        $store->message =$request->message;
        $store->save();
        return response()->json(['success'=>'success']);
    }

    public function HolidayDate(){
        $holiday=HolidayFare::where('status','1')->latest()->get();
        $allDates=[];
        foreach ($holiday as $key => $value) {
            $date_parse=date_parse( $value->date);
            $date=$date_parse['day'].'-'.$date_parse['month'].'-'.$date_parse['year'];
            // dd($date);
            array_unshift($allDates,$date);

        }
        // dd($allDates[3]);
        return  $allDates;
        
    }
    public function currencyConverRate(){
        $SessionCurrency = session()->get('currency');

        if(Auth::check()){
            $user=Auth::guard('admin')->user();
                if($user->user_type =='7' OR $user->user_type =='8' OR $user->user_type =='10'){
                    $currency= $user->currency;
                }else{

                    if($SessionCurrency){
                        $currency= $SessionCurrency;
                    }else{
                        $currency='USD';
                    }
                }
        }else{
            if($SessionCurrency){
                $currency= $SessionCurrency;
            }else{
                $currency='USD';
            }
        }
        // dd($currency);
         $pg_currency_conversion=PGCurrencyConversion::where('base_currency',$currency)->where('converted_currency','BDT')->first();
         $convert =$pg_currency_conversion->conversion_rate;
        //  dd($convert);
         return response()->json($convert);

    }
}
