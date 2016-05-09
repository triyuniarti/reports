<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachments extends Model
{
    protected $table = 'Attachments';

    protected $fillable = array('reports_id', 'file_name');

    public function report()
    {
        return $this->belongsTo('App\Reports');
    }
}
