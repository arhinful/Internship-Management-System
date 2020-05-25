<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //

    protected $fillable = ['company_id', 'student_id', 'act_assigned'];

    public function student(){
        return $this->belongsTo('App\Student');
    }

    public function company(){
        return $this->belongsTo('App\Company');
    }
}
