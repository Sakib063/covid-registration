<?php

namespace App\Console\Commands;

use App\Models\Center;
use App\Models\User;
use App\Services\CenterAppointmentService;
use Illuminate\Console\Command;

class AppointmentScheduler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:appointment-scheduler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(){
        (new Center())->remove_patient();
        (new CenterAppointmentService())->appoint();
    }
}
