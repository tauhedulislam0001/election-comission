<?php

namespace App\Http\Controllers\Auth;

use App\Airlines;
use App\Airport;
use App\Car;
use App\CustomerFeedBack;
use App\DepartureAirport;
use App\District;
use App\Division;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Thana;
use App\Tracker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PragmaRX\Countries\Package\Services\Countries;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
    public function ResetForm(Request $request){
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
                } elseif ($country == "MV") {
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
                    // }elseif ($SelectedCountry == "BD") {
                    //     $currency = "BDT";

                } elseif ($SelectedCountry == "EU") {
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
        if (Auth::check()) {
            $userType = Auth::guard('admin')->user()->user_type;
            if ($userType != 7 && $userType != 8 && $userType != 10) {
                return redirect()->route('admin.dashboard');
            } elseif ($userType == 7 or $userType == 8 or $userType == 10) {
                return view('frontend.pages.lang.english.home.index', compact('customerFeedback', 'countries', 'cars', 'formData', 'car_name', 'airports', 'divisions', 'division_name', 'airport_name', 'fair', 'districts', 'thanas', 'nationalities', 'airlines', 'paymentMethods', 'currency', 'session', 'departure_aiprort'));
            }
        } else {
            return view('frontend.pages.lang.english.home.index', compact('customerFeedback', 'countries', 'cars', 'formData', 'car_name', 'airports', 'divisions', 'division_name', 'airport_name', 'fair', 'districts', 'thanas', 'nationalities', 'airlines', 'paymentMethods', 'currency', 'session', 'departure_aiprort'));
        }
    }
    use SendsPasswordResetEmails;
}
