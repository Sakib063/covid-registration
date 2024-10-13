<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function remove_patient(int $id): void{
        self::query()->where('id',$id)->decrement('patients');
    }
}
