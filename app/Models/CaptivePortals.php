<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaptivePortals extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    /**
     *  d'appartenance
     *
     * @return Direction
     */
    public function network()
    {
        return $this->belongsTo(Network::class);
    }

}
