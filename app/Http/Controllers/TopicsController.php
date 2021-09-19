<?php

namespace App\Http\Controllers;

use App\Models\Topics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TopicsImport;

class TopicsController extends Controller
{
    public function index()
    {
        $topics = Topics::orderBy('id','ASC')->get();
        return view('userpanel.topics',compact('topics'))->with('no', 1);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'topics_name' => 'required',
            'subject_id' => 'required',
        ]);

            $post = New Topics;
            $post->topics_name = $request->get('topics_name');
            $post->subject_id = $request->get('subject_id');
            $post->save();

            if (!$validator->fails()) {
            $boardId = $request->id;
            //Board::updateOrCreate(['id' => $boardId],['topics_name' => $request->topics_name, 'board_type' => $request->board_type,'board_nick'=>$request->board_nick]);

            return response()->json(['success'=>'Added new records.']);
            return redirect()->route('userpanel.topics.index');
            }

            return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function show(Topics $topics)
    {
        return view('topics.show',compact('topics'));
    }

    public function edit($id)
    {
        $where = array('id' => $id);
		$topics = Topics::where($where)->first();

        if($topics) {
	        return response()->json([
		        'status'=>200,
		        'topics'=> $topics,
	        ]);
        } else {
	        return response()->json([
		        'status'=>404,
		        'response'=> 'Topics Not Found',
	        ]);
        }
    }

    public function destroy($id)
    {
        $cust = Topics::where('id',$id)->delete();
    }

    public function deleteAllrecord(Request $request, Topics $topics) {

        $ids = $request->ids;
        Topics::whereIn('id',$ids)->delete();
        return response()->json(['success'=>"Topics have been deleted"]);
    }
}
