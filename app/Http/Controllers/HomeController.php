<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Comment;

class HomeController extends Controller
{
    public function index()
    {   
    	return view('welcome');
    }

    public function pullData(){
        $commentList = DB::table('tbl_comment')->orderBy('parent_comment_id', 'desc')->orderBy('comment_id', 'desc')->get();

        $status['data'] = $commentList;
        return $status;
    }

    public function replyMsg( Request $req ){

    	$allDetails = $req->all();


    	$commentDetails = new Comment;

        $commentDetails->parent_comment_id   = $allDetails['comment_id'];
        $commentDetails->comment             = $allDetails['comment'];
        $commentDetails->comment_sender_name = $allDetails['name'];

        $is_saved = $commentDetails->save();

        if ($is_saved) {
		    $status['message'] = true;
		} else {
		    $status['message'] = false;
		}

		return $status;

    }
}
