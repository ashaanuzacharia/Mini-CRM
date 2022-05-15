<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    
    protected $table = 'contact';

    protected $fillable = [
        'name','phone' 
     ];
    
    public function add()
    {
        return $this->belongsToMany('App\Contacts');
    } 
    
    public function edit()
    {
        return $this->belongsToMany('App\Contacts');
    } 

    public function view()
    {
        return $this->belongsToMany('App\Contacts');
    } 
}
