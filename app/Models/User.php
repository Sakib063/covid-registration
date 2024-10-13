<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    public const NOT_SCHEDULED=1;
    public const SCHEDULED=2;
    public const VACCINATED=3;

    public const STATUS_LIST=[
        self::NOT_SCHEDULED=>'Not Scheduled',
        self::SCHEDULED=>'Scheduled',
        self::VACCINATED=>'Vaccinated',
    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function center(): BelongsTo
    {
        return $this->belongsTo(Center::class);
    }

    public function find_user($request){
        if($request->input('nid')){
            $user=self::query()->where('nid',$request->input('nid'))->first();
            if($user){
                $user->status = self::STATUS_LIST[$user->status];
                return response()->json($user);
            }
        }
        return null;
    }

    public function next_user(){
        return self::query()->where('status',self::NOT_SCHEDULED)->latest()->first();
    }

    public function appointment($date,User $user): void{
        self::query()->where('id',$user->id)->update(['status'=>self::SCHEDULED,'appointment_date'=>$date]);
    }
}
