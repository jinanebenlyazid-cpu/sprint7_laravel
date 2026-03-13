<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billet extends Model
{
     protected $fillable = [
        'id_voyage',
        'id_commande',
        'qte',
    ];

    public function voyage()
    {
        return $this->belongsTo(Voyage::class, 'id_voyage');
    }
    
}
