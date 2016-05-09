<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    //tabel yang digunakan
    protected $table = 'reports';

    //field apa saja yang diperbolehkan menerima inputan
    protected $fillable = array('user_id', 'report_date', 'category_id', 'subject', 'description');

    public function users()
    {
        return $this->hasOne('App\User');
    }
    
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    
    public function attachments()
    {
        return $this->hasMany('App\Attachments');
    }
}
