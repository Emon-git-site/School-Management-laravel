<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamModel extends Model
{
    use HasFactory;

    protected $table = 'exam';

    static public function getExamRecord()
    {
        $return = self::select('exam.*', 'users.name as created_name')
                  ->join('users', 'users.id', 'exam.created_by')
                  ->where('exam.is_delete', 0);
                  if (!empty(request('name'))) {
                    $name = request('name');
                    $return = $return->where('exam.name', 'like', '%' . $name . '%');
                }
                if (!empty(request('date'))) {
                    $date = request('date');
                    $return = $return->whereDate('exam.created_at', $date);
                }
                $return = $return->orderBy('exam.id', 'desc')
                ->paginate(20);
            return $return;
    }


    static public function getExam()
    {
        $return = self::select('exam.*', 'users.name as created_name')
                  ->join('users', 'users.id', 'exam.created_by')
                  ->where('exam.is_delete', 0)
                   ->orderBy('exam.name', 'asc')
                ->get(20);
            return $return;
    }
}
