<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SettingsController extends BaseController
{
    public function __construct(){

    }
    public function index(){
        $reservation_rules = DB::table('restriction_setting')->get();
        return view('reservation-settings', ["rules"=>$reservation_rules]);
    }
    public function addRule(){
        return view('add-reservation-settings');
    }
    public function addNewRule(Request $request){
        DB::table('restriction_setting')->insert(
            [
                'n' => $request->no_of_people, 
                'd' => $request->time_period,
                'g' => $request->reservation_type,
                'tz' => $request->timezone
            ]
        );
        \Session::flash('success_message', 'New rule has been created successfully!'); 
        \Session::flash('alert-class', 'alert-success');

        return redirect()->route('reservation-settings');
    }

    public function deleteRule($id){
        DB::table('restriction_setting')->delete($id);
        \Session::flash('success_message', 'Rule has been delete successfully!'); 
        \Session::flash('alert-class', 'alert-success');
        return redirect()->route('reservation-settings');
    }

    public function editRule($id){
        $rule_data = DB::table('restriction_setting')->where('id', $id)->get();
        return view('edit-reservation-settings', ["rule_data"=>$rule_data[0]]);
    }

    public function editSingleRule(Request $request){

        // dd($request->all());

        DB::table('restriction_setting')
            ->where('id',$request->rule_id)
            ->update(['n' => $request->no_of_people,'d' => $request->time_period, 'g' => $request->reservation_type , 'tz' => $request->timezone]);

        \Session::flash('success_message', 'Rule has been updated successfully!'); 
        \Session::flash('alert-class', 'alert-success');

        return redirect()->route('reservation-settings');
    }
}