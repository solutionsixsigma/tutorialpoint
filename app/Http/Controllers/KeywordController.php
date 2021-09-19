<?php

namespace App\Http\Controllers;

use App\Models\Keyword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\KeywordImport;

class KeywordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keywords = Keyword::orderBy('id','ASC')->get();
        return view('userpanel.keyword',compact('keywords'))->with('no', 1);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'keyword_name' => 'required',
        ]);

            $post = New Keyword;
            $post->keyword_name = $request->get('keyword_name');
            $post->save();

            if (!$validator->fails()) {
            $boardId = $request->id;
            //Board::updateOrCreate(['id' => $boardId],['keyword_name' => $request->keyword_name, 'board_type' => $request->board_type,'board_nick'=>$request->board_nick]);

            return response()->json(['success'=>'Added new records.']);
            return redirect()->route('userpanel.keyword.index');
            }

            return response()->json(['error'=>$validator->errors()->all()]);

    }

    public function updatekeyword(Request $request)
    {
        Keyword::updateOrCreate(['id' => $request->id],['keyword_name' => $request->keyword_name]);

        return response()->json(['success'=>'Record Update Successfully.']);
        return redirect()->route('userpanel.keyword.index');

    }

    public function importCsv() {
        return view('import-form');
    }

    public function storeCsv(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new KeywordImport, $file);
        return "Record are Imported Successsfully";
    }


    public function store(Request $request)
    {

    }

    public function show(Keyword $keyword)
    {
        return view('keyword.show',compact('keywords'));
    }

    public function edit($id)
    {
        $where = array('id' => $id);
		$keyword = Keyword::where($where)->first();

        if($keyword) {
	        return response()->json([
		        'status'=>200,
		        'keyword'=> $keyword,
	        ]);
        } else {
	        return response()->json([
		        'status'=>404,
		        'response'=> 'Keyword Not Found',
	        ]);
        }
    }

    public function destroy($id)
    {
        $cust = Keyword::where('id',$id)->delete();
    }

    public function deleteAllrecord(Request $request, Keyword $keyword) {

        $ids = $request->ids;
        Keyword::whereIn('id',$ids)->delete();
        return response()->json(['success'=>"Keyword have been deleted"]);
    }
}
