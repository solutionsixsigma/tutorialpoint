<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ClassesImport;

class ClassesController extends Controller
{

    public function index()
    {
        $classes = Classes::orderBy('id','ASC')->get();
        return view('userpanel.classes',compact('classes'))->with('no', 1);
    }

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'class_name' => 'required',
        ]);

            $post = New Classes;
            $post->class_name = $request->get('class_name');
            $post->save();

            if (!$validator->fails()) {
            $boardId = $request->id;
            //Board::updateOrCreate(['id' => $boardId],['class_name' => $request->class_name, 'board_type' => $request->board_type,'board_nick'=>$request->board_nick]);

            return response()->json(['success'=>'Added new records.']);
            return redirect()->route('userpanel.classes.index');
            }

            return response()->json(['error'=>$validator->errors()->all()]);

    }

    public function updateclasses(Request $request)
    {
        Classes::updateOrCreate(['id' => $request->id],['class_name' => $request->class_name]);

        return response()->json(['success'=>'Record Update Successfully.']);
        return redirect()->route('userpanel.board.index');

    }

    public function importCsv() {
        return view('import-form');
    }

    public function storeCsv(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new ClassesImport, $file);
        return "Record are Imported Successsfully";
    }

    public function store(Request $request)
    {

    }

    public function show(Classes $classes)
    {
        return view('classes.show',compact('classes'));
    }

    public function edit($id)
    {
        $where = array('id' => $id);
		$classes = Classes::where($where)->first();

        if($classes) {
	        return response()->json([
		        'status'=>200,
		        'classes'=> $classes,
	        ]);
        } else {
	        return response()->json([
		        'status'=>404,
		        'response'=> 'Classses Not Found',
	        ]);
        }
    }

    public function destroy($id)
    {
        $cust = Classes::where('id',$id)->delete();
    }

    public function deleteAllrecord(Request $request, Classes $classes) {

        $ids = $request->ids;
        Classes::whereIn('id',$ids)->delete();
        return response()->json(['success'=>"Classses have been deleted"]);
    }
}
