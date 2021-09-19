<?php

namespace App\Http\Controllers;

use App\Models\SubTopics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BoardImport;

class SubTopicsController extends Controller
{
    public function index()
    {
        $subtopics = SubTopics::orderBy('id','ASC')->get();
        return view('userpanel.subtopics',compact('subtopics'))->with('no', 1);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subtopics_name' => 'required',
            'subject_id' => 'required',
            'topics_id' => 'required',
        ]);

            $post = New SubTopics;
            $post->subtopics_name = $request->get('subtopics_name');
            $post->subject_id = $request->get('subject_id');
            $post->topics_id = $request->get('topics_id');
            $post->save();

            if (!$validator->fails()) {
            $boardId = $request->id;
            //Board::updateOrCreate(['id' => $boardId],['class_name' => $request->class_name, 'board_type' => $request->board_type,'board_nick'=>$request->board_nick]);

            return response()->json(['success'=>'Added new records.']);
            return redirect()->route('userpanel.subtopics.index');
            }

            return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(SubTopics $subTopics)
    {
        return view('subtopics.show',compact('board'));
    }

    public function edit($id)
    {
        $where = array('id' => $id);
		$subtopics = SubTopics::where($where)->first();

        if($subtopics) {
	        return response()->json([
		        'status'=>200,
		        'board'=> $subtopics,
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
        $cust = SubTopics::where('id',$id)->delete();
    }

    public function deleteAllrecord(Request $request, SubTopics $subTopics) {

        $ids = $request->ids;
        SubTopics::whereIn('id',$ids)->delete();
        return response()->json(['success'=>"Classses have been deleted"]);
    }
}
