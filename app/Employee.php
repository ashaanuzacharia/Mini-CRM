<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';

    protected $fillable = [
        'first_name', 'last_name', 'company_id', 'email', 'phone'
     ];
    
    public function add()
    {
        return $this->belongsToMany('App\Employee');
    } 
    
    public function edit()
    {
        return $this->belongsToMany('App\Employee');
    } 

    public function view()
    {
        return $this->belongsToMany('App\Employee');
    } 
}
