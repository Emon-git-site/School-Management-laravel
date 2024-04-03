<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    public function list()
    {
        $data['classe'] = Classe::getClass();
        $data['header_title'] = 'Class List';
        return view('admin.class.list', $data);
    }

    public function add()
    {
        $data['header_title'] = 'Add new class';
        return view('admin.class.add', $data);
    }

    public function insert(Request $request)
    {
        request()->validate([
            'name' => 'required|string|max:255'
        ]);

        $classe = Classe::make($request->except('created_by'));
        $classe->created_by = Auth::user()->id;
        $classe->save();
        toastr()->addsuccess('Class Successfully Created');
        return redirect()->route('admin.class.list');
    }

    public function edit($id)
    {
        $data['classe'] = Classe::where('id', $id)->first();
        if(!empty($data['classe']))
        {
            $data['header_title'] = "Edit Class";
            return view('admin.class.edit', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function update(Request $request ,Classe $classe)
    {
        request()->validate([
            'name' => 'required|string|max:255'
        ]);

        $classe->update($request->all());
        toastr()->addsuccess('Class  Information Updated Successfully ');
        return redirect()->route('admin.class.list');
    }

    public function destroy(Classe $classe)
    {
        $classe->is_delete = 1;
        $classe->save();
        toastr()->addsuccess('Class Successfully Deleted');
        return redirect()->route('admin.class.list');
    }
}
