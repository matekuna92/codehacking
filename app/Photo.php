<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $uploads = '/images/';
    protected $fillable = ['file'];

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    //accessor

    public function getFileAttribute($photo) // mostmár nem kell az img src-hez mindig a /images.. elég a {{}} rész
    {
        return $this->uploads . $photo;
    }
}
