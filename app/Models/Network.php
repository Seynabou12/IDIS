<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    /**
     * captive portal qui se trouvent dans cette portail Captif
     *
     * @return Collection
     */
    public function captiveportal()
    {
        return $this->hasMany(CaptivePortals::class);
    }
}
