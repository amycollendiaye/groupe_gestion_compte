<?php

namespace App\Models;

use App\Models\Scopes\WithActif;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Compte extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable=[
        'numero_compte',
        'type',
        "statut",
        'client_id',
        'date_debut_blocage',
        'date_fin_blocage',

    ];
     protected static function booted()
    {
         
        static::addGlobalScope(new WithActif);
    }
    public function client(){
        return $this->belongsTo(Client::class);
    }

}
