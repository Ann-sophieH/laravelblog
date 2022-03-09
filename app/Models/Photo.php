<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable=['file']; //protected want file kan enkel binnen class en bij kinders (private = enkel class)
    //protected $guarded=['id']; optie 2
    protected $uploads= '/img/';
    //get{property or field}Attribute
    public function getFileAttribute($photo){ //accessor kan bestaan als veld bestaat
        return $this->uploads . $photo; //als hij in paginas een file vind haalt ie photo binnen en dan
        //pakt ie
    }

   // public function users(){

 //   }
}
