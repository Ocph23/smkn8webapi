<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    function getByBlogId($id)
    {
        $query = DB::table('comments')
            ->join('users','comments.userid', '=', 'users.gauth_id')
            ->where('comments.blogid','=', $id)
            ->select('comments.id as id','name','avatar','gauth_id as userid','comment','parent','blogid','comments.created_at as created_at')
            ;

        $data = $query->get();
        
        $collection = collect($data)->map(function($p){
                $p->id = (int)$p->id;
                return $p;
        });        


        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);

    }

    function post(Request $request)
    {
        try {

            $data = $request->all();

            $comment =  Comment::create([
                'id' => $request->id,
                'blogid' => $request->blogid,
                'comment' => $request->comment,
                'parent' => $request->parent,
                'userid' => $request->userid,
            ]);

            if(!$comment){
                throw new Error(" Data Tidak Tersimpan");
            }

            return response()->json([
                'status' => 'success',
                'data' => $comment
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage(),
            ], 400);
        }
    }
}
