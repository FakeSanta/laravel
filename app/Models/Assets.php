<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assets extends Model
{
    use HasFactory;

    protected $table = 'assets';

    protected $fillable = [
        'nom',
    ];

    public function property(){
        return $this->belongsToMany(Property::class);
    }
}
