<?php

namespace App\Services;

use App\Models\Center;
use App\Models\User;
use Carbon\Carbon;

class CenterAppointmentService{
    public function appoint(){
        $day=Carbon::now()->dayOfWeek;
        $date=null;
        if($day==Carbon::FRIDAY||$day==Carbon::SATURDAY||$day==Carbon::THURSDAY){
            $date=Carbon::parse('next sunday');
        }
        else{
            $date=Carbon::tomorrow();
        }
        $users=(new User())->next_user();
        foreach($users as $user){
            $limit=(new Center())->capacity($user->vaccine_center);
            if($limit){
                (new User())->appointment($date,$user);
                (new Center())->appoint_patients($user->vaccine_center);
            }
        }
    }
}
