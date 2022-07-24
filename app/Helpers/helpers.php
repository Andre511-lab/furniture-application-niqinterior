<?php
/**
 * Created by PhpStorm.
 * User: muhammad.sandy
 * Date: 7/23/2022
 * Time: 9:44 AM
 */

function insertActivity($request){
    #validasi user_id
    $user_id = isset($request->user()->id) ? $request->user()->id : null;
    $user_type = isset($request->user()->id) ? 'App\Models\Users' : null;

    #get session
    $session_1 = DB::table('sessions')->where('user_id', $user_id)->orderBy('last_activity','desc')->first();
    $session_2 = DB::table('sessions')->orderBy('last_activity','desc')->first();
    $get_session = isset($session_1) ? $session_1->id : $session_2;

    DB::table('activity_log')->insert(['log_name'=> $request->subject,'description'=> $request->description,
        'causer_id'=> $user_id,'causer_type'=> $user_type,'session_id'=> $get_session,'created_at'=> \Carbon\Carbon::now()]);
}

function insertEventActivity($event){
    #validasi user_id
    $user_id = isset($event->user->id) ? $event->user->id : null;
    $user_type = isset($event->user->id) ? 'App\Models\Users' : null;


    #get session
    $session_1 = DB::table('sessions')->where('user_id', $user_id)->orderBy('last_activity','desc')->first();
    $session_2 = DB::table('sessions')->orderBy('last_activity','desc')->first();
    $get_session = isset($session_1) ? $session_1->id : $session_2;

    DB::table('activity_log')->insert(['log_name'=> $event->subject,'description'=> $event->description,
        'causer_id'=> $user_id,'causer_type'=> $user_type,'session_id'=> $get_session,'created_at'=> \Carbon\Carbon::now()]);
}
function insertTransActivity($transasction){
    #validasi user_id
    $user_id = isset($transasction->users_id) ? $transasction->users_id : null;
    $user_type = isset($transasction->users_id) ? 'App\Models\Transaction' : null;


    #get session
    $session_1 = DB::table('sessions')->where('user_id', $user_id)->orderBy('last_activity','desc')->first();
    $session_2 = DB::table('sessions')->orderBy('last_activity','desc')->first();
    $get_session = isset($session_1) ? $session_1->id : $session_2;

    DB::table('activity_log')->insert(['log_name'=> $transasction->subject,'description'=> $transasction->description,
        'causer_id'=> $user_id,'causer_type'=> $user_type,'session_id'=> $get_session,'created_at'=> \Carbon\Carbon::now()]);
}