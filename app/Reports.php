<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    //tabel yang digunakan
    protected $table = 'reports';

    //field apa saja yang diperbolehkan menerima inputan
    protected $fillable = array('user_id', 'category_name', 'report_date', 'subject', 'description');
}
