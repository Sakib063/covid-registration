<?php

use App\Console\Commands\AppointmentScheduler;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command(AppointmentScheduler::class)->dailyAt('21:00')->when(function(){
                                                            $day=now()->dayOfWeek;
                                                            return !in_array($day,[5, 6]);
                                                        });
