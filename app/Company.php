<?php

namespace App;
use Database\Factories\CompanyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    
    protected $table = 'companies';

    protected $fillable = [
        'name', 'email', 'logo', 'website'
     ];
    
    public function add()
    {
        return $this->belongsToMany('App\Company');
    } 
    
    public function edit()
    {
        return $this->belongsToMany('App\Company');
    } 

    public function view()
    {
        return $this->belongsToMany('App\Company');
    } 
}
