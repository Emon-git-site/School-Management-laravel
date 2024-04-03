<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'status',
        'is_delete',
        'created_by',
    ];

    static public function getSubject()
    {
        $return  = Subject::select('subjects.*', 'users.name as created_by_name')
            ->join('users', 'users.id', 'subjects.created_by');
        if (!empty(request('name'))) {
            $name = request('name');
            $return = $return->where('subjects.name', 'like', '%' . $name . '%');
        }
        if (!empty(request('date'))) {
            $date = request('date');
            $return = $return->whereDate('subjects.created_at', $date);
        }
        if (!empty(request('type'))) {
            $type = request('type');
            $return = $return->where('subjects.type', $type);
        }
        $return = $return->where('subjects.is_delete', 0)
            ->orderBy('subjects.id', 'desc')
            ->paginate(20);
        return $return;
    }

    static public function getSubjectAssign()
    {
        $return  = Subject::select('subjects.*')
            ->join('users', 'users.id', 'subjects.created_by')
            ->where('subjects.is_delete', 0)
            ->where('subjects.status', 0)
            ->orderBy('subjects.name', 'asc')
            ->get();
        return $return;
    }
}
