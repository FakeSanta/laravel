<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $table = 'property';

    protected $fillable = [
        'type',
        'city',
        'surface',
        'price',
        'room',
        'picture',
        "agency_id",
    ];

    public function assets(){
        return $this->belongsToMany(Assets::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
}
