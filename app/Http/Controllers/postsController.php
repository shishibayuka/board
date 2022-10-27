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
        // 2つのテーブルを関連づけて、postテーブルの情報を取得
        $posts = posts::with('user')->get();
        // 変数の定義、空欄か絶対入らない数値のマイナスを入れておく
        $editPostId = -1;

        //viewを返す、遷移する(compactでviewに$postsを渡す)
        return view('/layouts/post', compact('posts', 'editPostId'));
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

    public function destroy($id)
    {
        // idに関する情報を取得
        $post = posts::find($id);

        // if文追加：もし$postが空だったら、処理を終了する
        if (!$post) {
            return;
        }
        $post->delete();

        //一覧表示画面にリダイレクト
        return redirect('/');
    }

    // 編集
    public function edit($id)
    {
        $posts = posts::with('user')->get();
        $editPostId =  $id;
        //一覧表示画面にリダイレクト
        // return redirect('/');
        return view('/layouts/post', compact('editPostId', 'posts'));
    }

    // メソッドインジェクション（Request $request）:ブラウザーから送られたリクエストのデータを取得して処理
    public function update(Request $request, $id)
    {
        // ボタンを押した際のIDの情報をpostsテーブルから検索して$postに値を格納
        $post = posts::find($id);

        // inputを使用し、リクエストパラメータを1つずつ取得
        $post->message = $request->input('updateMessage');

        // <公式>デフォルトでEloquentはデータベース上に存在する
        // created_at(作成時間)とupdated_at(更新時間)カラムを自動的に更新します。
        // これらのカラムの自動更新をEloquentにしてほしくない場合は、
        // モデルの$timestampsプロパティーをfalseに設定
        // ↑のエラー回避(あらかじめ用意してあるupdated_atカラムがないよ)のため、timestampを無効にする
        // ddd($request->input);
        $post->timestamps = false;

        //DBに保存
        $post->save();

        //一覧表示画面にリダイレクト
        return redirect('/');
    }
}
