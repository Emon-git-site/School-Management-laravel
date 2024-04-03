<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'admission_number',
        'roll_number',
        'classe_id',
        'gender',
        'date_of_birth',
        'caste',
        'religion',
        'mobile_number',
        'admission_date',
        'blood_group',
        'height',
        'weight',
        'status',
        'occupation',
        'address',
        'email',
        'password',
        'marital_status',
        'permanent_address',
        'qualification',
        'work_exprience',
        'note',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    static public function getAdmin()
    {
        $return = self::select('users.*')
            ->where('user_type', 1)
            ->where('is_delete', 0);
        if (!empty(request('email'))) {
            $email = request('email');
            $return = $return->where('email', 'like', '%' . $email . '%');
        }
        if (!empty(request('name'))) {
            $name = request('name');
            $return = $return->where('name', 'like', '%' . $name . '%');
        }
        if (!empty(request('date'))) {
            $date = request('date');
            $return = $return->whereDate('created_at', $date);
        }
        $return  = $return->orderBy('id', 'desc')
            ->paginate(20);
        return $return;
    }

    static public function getParent()
    {
        $return = self::select('users.*')
            ->where('user_type', 4)
            ->where('is_delete', 0);
        if (!empty(request('email'))) {
            $email = request('email');
            $return = $return->where('email', 'like', '%' . $email . '%');
        }
        if (!empty(request('name'))) {
            $name = request('name');
            $return = $return->where('name', 'like', '%' . $name . '%');
        }
        if (!empty(request('last_name'))) {
            $last_name = request('last_name');
            $return = $return->where('last_name', 'like', '%' . $last_name . '%');
        }
        if (!empty(request('gender'))) {
            $gender = request('gender');
            $return = $return->where('users.gender', 'like', '%' . $gender . '%');
        }
        if (!empty(request('occupation'))) {
            $occupation = request('occupation');
            $return = $return->where('users.occupation', 'like', '%' . $occupation . '%');
        }
        if (!empty(request('address'))) {
            $address = request('address');
            $return = $return->where('users.address', 'like', '%' . $address . '%');
        }
        if (!empty(request('mobile_number'))) {
            $mobile_number = request('mobile_number');
            $return = $return->where('users.mobile_number', 'like', '%' . $mobile_number . '%');
        }
        if (!empty(request('status'))) {
            $status = request('status');
            $return = $return->where('users.status', 'like', '%' . $status . '%');
        }
        if (!empty(request('date'))) {
            $date = request('date');
            $return = $return->whereDate('created_at', $date);
        }
        $return  = $return->orderBy('id', 'desc')
            ->paginate(20);
        return $return;
    }

    static public function getStudent()
    {
        $return = self::select('users.*', 'classes.name as class_name', 'parent.name as parent_name', 'parent.last_name as parent_last_name')
           ->leftjoin('users as parent', 'parent.id', '=', 'users.parent_id')
            ->join('classes', 'classes.id', 'users.classe_id')
            ->where('users.user_type', 3)
            ->where('users.is_delete', 0);
            if (!empty(request('name'))) {
                $name = request('name');
                $return = $return->where('users.name', 'like', '%' . $name . '%');
            }
            if (!empty(request('last_name'))) {
                $last_name = request('last_name');
                $return = $return->where('users.last_name', 'like', '%' . $last_name . '%');
            }
            if (!empty(request('email'))) {
                $email = request('email');
                $return = $return->where('users.email', 'like', '%' . $email . '%');
            }
            if (!empty(request('admission_number'))) {
                $admission_number = request('admission_number');
                $return = $return->where('users.admission_number', 'like', '%' . $admission_number . '%');
            }
            if (!empty(request('roll_nubmer'))) {
                $roll_nubmer = request('roll_nubmer');
                $return = $return->where('users.roll_nubmer', 'like', '%' . $roll_nubmer . '%');
            }
            if (!empty(request('classe'))) {
                $classe = request('classe');
                $return = $return->where('classes.name', 'like', '%' . $classe . '%');
            }
            if (!empty(request('gender'))) {
                $gender = request('gender');
                $return = $return->where('users.gender', 'like', '%' . $gender . '%');
            }
            if (!empty(request('caste'))) {
                $caste = request('caste');
                $return = $return->where('users.caste', 'like', '%' . $caste . '%');
            }
            if (!empty(request('religion'))) {
                $religion = request('religion');
                $return = $return->where('users.religion', 'like', '%' . $religion . '%');
            }
            if (!empty(request('mobile_nubmer'))) {
                $mobile_nubmer = request('mobile_nubmer');
                $return = $return->where('users.mobile_nubmer', 'like', '%' . $mobile_nubmer . '%');
            }
            if (!empty(request('blood_group'))) {
                $blood_group = request('blood_group');
                $return = $return->where('users.blood_group', 'like', '%' . $blood_group . '%');
            }
    
            if (!empty(request('admission_date'))) {
                $admission_date = request('admission_date');
                $return = $return->whereDate('users.admission_date', $admission_date);
            }
    
            if (!empty(request('date'))) {
                $date = request('date');
                $return = $return->whereDate('users.created_at', $date);
            }
            if (!empty(request('status'))) {
                $status = request('status');
                $status = ($status == 0)? 0:1;
                $return = $return->where('users.status', $status);
            }
           $return = $return->orderBy('users.id', 'desc')
            ->paginate(20);
        return $return;
    }

    static public function getTeacher()
    {
        $return = self::select('users.*', 'classes.name as class_name')
            ->leftjoin('classes', 'classes.id', 'users.classe_id')
            ->where('users.user_type', 2)
            ->where('users.is_delete', 0);
            if (!empty(request('name'))) {
                $name = request('name');
                $return = $return->where('users.name', 'like', '%' . $name . '%');
            }
            if (!empty(request('last_name'))) {
                $last_name = request('last_name');
                $return = $return->where('users.last_name', 'like', '%' . $last_name . '%');
            }
            if (!empty(request('email'))) {
                $email = request('email');
                $return = $return->where('users.email', 'like', '%' . $email . '%');
            }
            if (!empty(request('address'))) {
                $address = request('address');
                $return = $return->where('users.address', 'like', '%' . $address . '%');
            }
            if (!empty(request('marital_status'))) {
                $marital_status = request('marital_status');
                $return = $return->where('users.marital_status', 'like', '%' . $marital_status . '%');
            }
            if (!empty(request('mobile_nubmer'))) {
                $mobile_nubmer = request('mobile_nubmer');
                $return = $return->where('users.mobile_nubmer', 'like', '%' . $mobile_nubmer . '%');
            }
            if (!empty(request('gender'))) {
                $gender = request('gender');
                $return = $return->where('users.gender', 'like', '%' . $gender . '%');
            }
            if (!empty(request('admission_date'))) {
                $admission_date = request('admission_date');
                $return = $return->whereDate('users.admission_date', $admission_date);
            } 
            if (!empty(request('date'))) {
                $date = request('date');
                $return = $return->whereDate('users.created_at', $date);
            }
            if (!empty(request('status'))) {
                $status = request('status');
                $status = ($status == 0)? 0:1;
                $return = $return->where('users.status', $status);
            }
           $return = $return->orderBy('users.id', 'desc')
            ->paginate(20);
        return $return;
    }

    static public function getTeacherStudent($teacher_id)
    {
        $return = self::select('users.*', 'classes.name as class_name')
            ->join('classes', 'classes.id', 'users.classe_id')
            ->join('assign_class_teachers', 'assign_class_teachers.classe_id', 'classes.id')
            ->where('assign_class_teachers.teacher_id', $teacher_id)
            ->where('users.user_type', 3)
            ->where('users.is_delete', 0)
            ->where('users.status', 0)
            ->where('classes.is_delete', 0)
            ->where('classes.status', 0)
            ->orderBy('users.id', 'desc')
            ->groupBy('users.id')
            ->paginate(20);
        return $return;
    }

    static public function getSearchStudent()
    {
        if(!empty(Request('id')) || !empty(Request('name')) || !empty(Request('last_name')) || !empty(Request('email')))
        {
            $return = self::select('users.*', 'classes.name as class_name', 'parent.name as parent_name')
            ->leftjoin('users as parent', 'parent.id', '=', 'users.parent_id')
            ->join('classes', 'classes.id', 'users.classe_id')
            ->where('users.user_type', 3)
            ->where('users.is_delete', 0);

            if (!empty(request('id'))) {
                $id = request('id');
                $return = $return->where('users.id', $id);
            }  
            if (!empty(request('name'))) {
                $name = request('name');
                $return = $return->where('users.name', 'like', '%' . $name . '%');
            }
            if (!empty(request('last_name'))) {
                $last_name = request('last_name');
                $return = $return->where('users.last_name', 'like', '%' . $last_name . '%');
            }
            if (!empty(request('email'))) {
                $email = request('email');
                $return = $return->where('users.email', 'like', '%' . $email . '%');
            }

           $return = $return->orderBy('users.id', 'desc')
            ->limit(50)->get();
        return $return;
        }
    }

    static public function getParentStudent($parent_id)
    {
        $return = self::select('users.*', 'classes.name as class_name', 'parent.name as parent_name')
        ->leftjoin('users as parent', 'parent.id', '=', 'users.parent_id')
        ->join('classes', 'classes.id', 'users.classe_id')
        ->where('users.user_type', 3)
        ->where('users.parent_id', $parent_id)
        ->where('users.is_delete', 0)
        ->orderBy('users.id', 'desc')
        ->limit(50)->get();
    return $return;
    }

    static public  function getEmailSingle($email)
    {
        return self::where('email', $email)->first();
    }

    static public  function getSingle($id)
    {
        return self::where('id', $id)->where('is_delete', 0)->first();
    }

    static public  function getTokenSingle($remember_token)
    {
        return self::where('remember_token', $remember_token)->first();
    }

    public function getProfile()
    {
        if(!empty($this->profile_pic) && file_exists(public_path('upload/profile/').$this->profile_pic))
        {
            return url('upload/profile/'.$this->profile_pic);
        }
        else
        {
            return '';
        }
    }
}
