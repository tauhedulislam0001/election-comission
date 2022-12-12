<?php

namespace App\Console\Commands;

use App\session as AppSession;
use DateInterval;
use DateTime;
use DateTimeZone;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Session;

class DestroySessionData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sessionData:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Booking Session Data Delete';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $SingleTripId = session()->forget('SingleTripId');
        Session::forget('SingleTripId'); 

        if ($SingleTripId != null) {
            $dataSingleTrip = AppSession::where('id', '8')->delete();
            $dataSingleTrip = AppSession::where('id', $SingleTripId)->first();
            $Dtime = 2;
            $time = new DateTime($dataSingleTrip->created_at);
            $time->add(new DateInterval('PT' . $Dtime . 'M'));
            $expiredTime = $time->format('Y-m-d H:i');
            $oldTime = new DateTime($dataSingleTrip->created_at);
            $oldTimeD = $oldTime->format('Y-m-d H:i');
            $dataSingleTripDateTime = new \Datetime($expiredTime, new DateTimeZone('Asia/Dhaka'));
            $dataSingleTripDateTimeStr = $dataSingleTripDateTime->format('l d F Y, h:i A');
            $date = new DateTime('now', new DateTimeZone('Asia/Dhaka'));
            $interval = $dataSingleTripDateTime->diff($date);
            $diff = $interval->days * 24 + $interval->h * 60 + +$interval->i;
            // dd(   $diff , 'Minute' , $interval->s, 'Second');
            if ($dataSingleTripDateTime > $date){

            }else {
                $dataSingleTrip = AppSession::where('id', $SingleTripId)->delete();
                Session::forget('SingleTripId'); 
            }
        }
    }
}
