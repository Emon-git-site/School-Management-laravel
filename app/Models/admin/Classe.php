<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;
    protected $table = 'classes';
    protected $fillable = [
        'name',
        'status',
        'created_by',
    ];

    static public  function getClass()
    {
        $return  = Classe::select('classes.*', 'users.name as created_by_name')
            ->join('users', 'users.id', 'classes.created_by');
        if (!empty(request('name'))) {
            $name = request('name');
            $return = $return->where('classes.name', 'like', '%' . $name . '%');
        }
        if (!empty(request('date'))) {
            $date = request('date');
            $return = $return->whereDate('classes.created_at', $date);
        }
        $return = $return->where('classes.is_delete', 0)
            ->orderBy('classes.id', 'desc')
            ->paginate(20);
        return $return;
    }

    static public function getClassAssign()
    {
        $return  = Classe::select('classes.*')
            ->join('users', 'users.id', 'classes.created_by')
            ->where('classes.is_delete', 0)
            ->where('classes.status', 0)
            ->orderBy('classes.name', 'asc')
            ->get();
        return $return;
    }
}
