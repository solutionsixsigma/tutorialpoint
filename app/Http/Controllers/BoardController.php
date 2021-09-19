<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BoardImport;

class BoardController extends Controller
{

    public function index()
    {
        $boards = Board::orderBy('id','ASC')->get();
        return view('userpanel.board',compact('boards'))->with('no', 1);
    }


    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'board_name' => 'required',
            'board_type' => 'required',
            'board_nick' => 'required',
        ]);

            $post = New Board;
            $post->board_name = $request->get('board_name');
            $post->board_type = $request->get('board_type');
            $post->board_nick = $request->get('board_nick');
            $post->save();

        if (!$validator->fails()) {
            $boardId = $request->id;
            //Board::updateOrCreate(['id' => $boardId],['board_name' => $request->board_name, 'board_type' => $request->board_type,'board_nick'=>$request->board_nick]);

            return response()->json(['success'=>'Added new records.']);
            return redirect()->route('userpanel.board.index');
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }


    public function updateboard(Request $request)
    {


        Board::updateOrCreate(['id' => $request->id],['board_name' => $request->board_name, 'board_type' => $request->board_type,'board_nick'=>$request->board_nick]);

        return response()->json(['success'=>'Record Update Successfully.']);
        return redirect()->route('userpanel.board.index');
        /* $postdata = Board::find($request->id);
        $postdata->board_name = $request->board_name;
        $postdata->board_type = $request->board_type;
        $postdata->board_nick = $request->board_nick;
        $postdata->save();
        return response()->json(['success'=>'Record Update Successfully.']);
        return redirect()->route('userpanel.board.index');
        /*$validator = Validator::make($request->all(), [
            'board_name' => 'required',
            'board_type' => 'required',
            'board_nick' => 'required',
        ]);*/


            //$post->save();

        /*if (!$validator->fails()) {
            $boardId = array('id' => $id);
            Board::updateOrCreate(['id' => $boardId],['board_name' => $request->board_name, 'board_type' => $request->board_type,'board_nick'=>$request->board_nick]);

            return response()->json(['success'=>'Record Update Successfully.']);
            return redirect()->route('userpanel.board.index');
        }

        return response()->json(['error'=>$validator->errors()->all()]);*/
    }


    public function importCsv() {
        return view('import-form');
    }

    public function storeCsv(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new BoardImport, $file);
        return "Record are Imported Successsfully";
    }

    public function store(Request $request)
    {

    }


    public function show(Board $board)
    {
        return view('board.show',compact('board'));
    }


    public function edit($id)
    {
        $where = array('id' => $id);
		$board = Board::where($where)->first();

        if($board) {
	        return response()->json([
		        'status'=>200,
		        'board'=> $board,
	        ]);
        } else {
	        return response()->json([
		        'status'=>404,
		        'response'=> 'Student Not Found',
	        ]);
        }
    }

    public function destroy($id)
    {
        $cust = Board::where('id',$id)->delete();
    }

    public function deleteAllrecord(Request $request, Board $board) {

        $ids = $request->ids;
        Board::whereIn('id',$ids)->delete();
        return response()->json(['success'=>"Board have been deleted"]);
    }
}
