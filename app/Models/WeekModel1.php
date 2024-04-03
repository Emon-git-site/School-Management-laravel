<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeekModel1 extends Model
{
    use HasFactory;

    protected $table = 'week';

     static public function getWeekRecord()
     {
        return WeekModel1::get();
     }
     static public function getWeekUsingName($weekname)
     {
        return self::where('name', $weekname)->first();
     }
}
