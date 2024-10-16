<?php

namespace App\Models;

use App\Mail\NotificationMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Mail;

class Center extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function capacity(int $id): bool{
        $query=self::query()->where('id',$id)->first(['limit','patients']);
        return $query->limit>$query->patients;
    }

    public function appoint_patients(int $id): void{
        self::query()->where('id',$id)->increment('patients');
    }

    public function remove_patient(){
        $users=(new User())->vaccinated_users();
        $vaccine_centers=$users->pluck('vaccine_center')->toArray();
        foreach($users as $user){
            Mail::to($user->email)->send(new NotificationMail(['name'=>$user->name]));
        }
        self::query()->whereIn('id',$vaccine_centers)->where('patients','>',0)->decrement('patients');
    }
}
