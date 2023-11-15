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
        'surface',
        'price',
        'room',
    ];

    public function assets(){
        return $this->belongsToMany(Atout::class);
    }
}
