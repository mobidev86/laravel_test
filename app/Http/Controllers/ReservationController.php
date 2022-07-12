<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservationController extends BaseController
{
    public function __construct(){

    }
    public function index(){
        $reservation = DB::table('reservations')->get();
        return view('reservations', ["reservations"=>$reservation]);
    }
    public function addReservation(){
        return view('add-reservation');
    }

    public function addNewReservation(Request $request){

        $req =json_decode($request->dataPass,true);

        $no_of_users = $req['people'];
        $date = $req['date_period'];
        $time = $req['time_period'];
        $timezone = $req['timezone'];
        
        $no_of_users_arr = explode(",",$no_of_users);
        if(count($no_of_users_arr) > 1){

            //This will be treated as Group booking
            $check_for_timezone_data = DB::table('restriction_setting')->where('tz', $timezone)->where('g','group')->get();

            $total_space = 0;

            foreach($check_for_timezone_data as $d){
                $total_space += $d->n;
            }

            if(count($check_for_timezone_data) > 0){

                $mytimestamp = strtotime($date.' '.$time);

                DB::table('reservations')->insert(
                    [
                        'user_id' => $no_of_users, 
                        'reservation_timestamp_utc' => $mytimestamp
                    ]
                );

                \Session::flash('success_message', 'Booking successfully done'); 
                \Session::flash('alert-class', 'alert-success');

                $success_data = array(
                    "data" => array(
                        'is_booking_restricted' => false,
                        'restricted_user_ids' => "NA"
                    )
                );

                return $success_data;
            }else{
                $success_data = array(
                    "data" => array(
                        'is_booking_restricted' => true,
                        'restricted_user_ids' => $no_of_users
                    )
                );
                return $success_data;
            }

        }else{

            //This will be treated as Individual booking
            $check_for_timezone_data = DB::table('restriction_setting')->where('tz', $timezone)->where('g','individual')->get();
            
            $total_space = 0;

            foreach($check_for_timezone_data as $d){
                $total_space += $d->n;
            }
            
            if($no_of_users <= $total_space){

                $mytimestamp = strtotime($date.' '.$time);

                DB::table('reservations')->insert(
                    [
                        'user_id' => $no_of_users, 
                        'reservation_timestamp_utc' => $mytimestamp
                    ]
                );

                \Session::flash('success_message', 'Booking successfully done'); 
                \Session::flash('alert-class', 'alert-success');

                $success_data = array(
                    "data" => array(
                        'is_booking_restricted' => false,
                        'restricted_user_ids' => "NA"
                    )
                );

                return $success_data;
            }else{
                $success_data = array(
                    "data" => array(
                        'is_booking_restricted' => true,
                        'restricted_user_ids' => $no_of_users
                    )
                );
                return $success_data;
            }

        }
    }
}