<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 use \Illuminate\Support\Str;

class Admin extends Model
{
    protected $fillable=[
        'user_id'
    ];
    use HasFactory;
    protected static function booted()
    {
        
         
    }
      public function user()
    {
        return $this->belongsTo(User::class);
    }
}
