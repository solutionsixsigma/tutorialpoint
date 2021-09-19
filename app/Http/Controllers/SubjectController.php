<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SubjectImport;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::orderBy('id','ASC')->get();
        return view('userpanel.subject',compact('subjects'))->with('no', 1);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject_name' => 'required',
        ]);

            $post = New Subject;
            $post->subject_name = $request->get('subject_name');
            $post->save();

            if (!$validator->fails()) {
            $subjectId = $request->id;
            //Board::updateOrCreate(['id' => $boardId],['subject_name' => $request->subject_name, 'board_type' => $request->board_type,'board_nick'=>$request->board_nick]);

            return response()->json(['success'=>'Added new records.']);
            return redirect()->route('userpanel.subject.index');
            }

            return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function updatekeyword(Request $request)
    {
        Subject::updateOrCreate(['id' => $request->id],['keyword_name' => $request->keyword_name, 'board_type' => $request->board_type,'board_nick'=>$request->board_nick]);

        return response()->json(['success'=>'Record Update Successfully.']);
        return redirect()->route('userpanel.keyword.index');

    }

    public function importCsv() {
        return view('import-form');
    }

    public function storeCsv(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new SubjectImport, $file);
        return "Record are Imported Successsfully";
    }


    public function store(Request $request)
    {
        //
    }

    public function show(Subject $subject)
    {
        return view('subject.show',compact('subjects'));
    }

    public function edit($id)
    {
        $where = array('id' => $id);
		$subject = Subject::where($where)->first();

        if($subject) {
	        return response()->json([
		        'status'=>200,
		        'subject'=> $subject,
	        ]);
        } else {
	        return response()->json([
		        'status'=>404,
		        'response'=> 'Subject Not Found',
	        ]);
        }
    }

    public function destroy($id)
    {
        $cust = Subject::where('id',$id)->delete();
    }

    public function deleteAllrecord(Request $request, Subject $subject) {

        $ids = $request->ids;
        Subject::whereIn('id',$ids)->delete();
        return response()->json(['success'=>"Subject have been deleted"]);
    }
}
