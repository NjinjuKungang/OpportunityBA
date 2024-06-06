<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Opportunity extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'opportunities';

    protected $fillable = [
        'title',
        'image',
        'description',
        'category',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
