<?php

namespace App\Http\Controllers;

use App\Models\QuestionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class QuestionTypeController extends Controller
{

    public function index()
    {
        $questiontypes = QuestionType::orderBy('id','ASC')->get();
        return view('userpanel.questiontype',compact('questiontypes'))->with('no', 1);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'typeofquestion_name' => 'required',
        ]);

            $post = New QuestionType;
            $post->typeofquestion_name = $request->get('typeofquestion_name');
            $post->save();

            if (!$validator->fails()) {
            $boardId = $request->id;
            //Board::updateOrCreate(['id' => $boardId],['typeofquestion_name' => $request->typeofquestion_name, 'board_type' => $request->board_type,'board_nick'=>$request->board_nick]);

            return response()->json(['success'=>'Added new records.']);
            return redirect()->route('userpanel.questiontype.index');
            }

            return response()->json(['error'=>$validator->errors()->all()]);
    }


    public function updatequestiontype(Request $request)
    {
        QuestionType::updateOrCreate(['id' => $request->id],['typeofquestion_name' => $request->typeofquestion_name]);

        return response()->json(['success'=>'Record Update Successfully.']);
        return redirect()->route('userpanel.language.index');

    }

    public function store(Request $request)
    {
        //
    }

    public function show(QuestionType $questionType)
    {
        return view('questiontype.show',compact('board'));
    }

    public function edit($id)
    {
        $where = array('id' => $id);
		$questype = QuestionType::where($where)->first();

        if($questype) {
	        return response()->json([
		        'status'=>200,
		        'questype'=> $questype,
	        ]);
        } else {
	        return response()->json([
		        'status'=>404,
		        'response'=> 'Question Type Not Found',
	        ]);
        }
    }

    public function destroy($id)
    {
        $cust = QuestionType::where('id',$id)->delete();
    }

    public function deleteAllrecord(Request $request, QuestionType $questionType) {

        $ids = $request->ids;
        QuestionType::whereIn('id',$ids)->delete();
        return response()->json(['success'=>"Question Type have been deleted"]);
    }
}
