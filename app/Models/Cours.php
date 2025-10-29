<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'description',
        'prof_id',
    ];


    public function etudiant(){
        return $this->belongsToMany(User::class,'cour_user','cour_id','user_id');
    }
}
