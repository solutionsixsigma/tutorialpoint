<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;


class LanguageController extends Controller
{

    public function index()
    {
        $languages = Language::orderBy('id','ASC')->get();
        return view('userpanel.language',compact('languages'))->with('no', 1);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'language_name' => 'required',
        ]);

            $post = New Language;
            $post->language_name = $request->get('language_name');
            $post->save();

            if (!$validator->fails()) {
            $boardId = $request->id;
            //Board::updateOrCreate(['id' => $boardId],['language_name' => $request->language_name, 'board_type' => $request->board_type,'board_nick'=>$request->board_nick]);

            return response()->json(['success'=>'Added new records.']);
            return redirect()->route('userpanel.language.index');
            }

            return response()->json(['error'=>$validator->errors()->all()]);

    }

    public function updatelanguage(Request $request)
    {
        Language::updateOrCreate(['id' => $request->id],['language_name' => $request->language_name, 'board_type' => $request->board_type,'board_nick'=>$request->board_nick]);

        return response()->json(['success'=>'Record Update Successfully.']);
        return redirect()->route('userpanel.language.index');

    }

    public function store(Request $request)
    {
        //
    }

    public function show(Language $language)
    {
        return view('language.show',compact('language'));
    }

    public function edit($id)
    {
        $where = array('id' => $id);
		$language = Language::where($where)->first();

        if($language) {
	        return response()->json([
		        'status'=>200,
		        'language'=> $language,
	        ]);
        } else {
	        return response()->json([
		        'status'=>404,
		        'response'=> 'Language Not Found',
	        ]);
        }
    }

    public function destroy($id)
    {
        $cust = Language::where('id',$id)->delete();
    }

    public function deleteAllrecord(Request $request, Language $language) {

        $ids = $request->ids;
        Language::whereIn('id',$ids)->delete();
        return response()->json(['success'=>"Language have been deleted"]);
    }
}
