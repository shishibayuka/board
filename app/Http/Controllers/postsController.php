<?php

namespace App\Http\Controllers;

// 拡張機能にて追加

use App\Models\posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// controllerを継承してpostsControllerを作成している

class postsController extends Controller
{
    //投稿をデータベースから呼び出す、indexを定義する
    public function index()
    {
        // 2つのテーブルを関連づけて、userを取得
        $posts = posts::with('user')->get();

        //postsテーブルから(post)id,message,createdを$postsに格納
        // $posts = DB::table('posts')
        //   ->select('user_id', 'id', 'message', 'created')
        //   ->get();
        //   get→全投稿取り出し(blade上でforeachする)、first→最初の1投稿取り出し
        //   ->first();

        //viewを返す、遷移する(compactでviewに$postsを渡す)
        return view('/layouts/post', compact('posts'));
    }

    //   フォームで入力された値をpostsテーブルに格納する
    public function store(Request $request)
    {
        $post = new posts;

        $post->user_id =  Auth::id();;
        // $post->user_id = $request->input('user_id');
        // 入力値の要求
        $post->message = $request->input('message');
        // TIMES
        // $post->created = date('Y-m-d H:i:s');
        $post->created = NOW();
        // エラー回避のため、timestampを無効にした
        $post->timestamps = false;

        $post->save();

        //一覧表示画面にリダイレクト
        return redirect('/');
    }
}
