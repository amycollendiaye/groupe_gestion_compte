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
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) \Illuminate\Support\Str::uuid();
            }
        });
    }
      public function user()
    {
        return $this->belongsTo(User::class);
    }
}
