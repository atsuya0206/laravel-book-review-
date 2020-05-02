<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Review;

class ReviewController extends Controller
{
        public function index()
    {
        
        // where()はデータを取得する際の絞り込み条件指定するメソッド created_atカラム を 降順（DESC）->get()と付けることにより、データを取得
        //->get()の代わりに->paginate(9);を付けるとページネーション
        $reviews = Review::where('status', 1)->orderBy('created_at', 'DESC')->paginate(6);
        
        
        // dd($reviews);
        
        // return view('index'); compactの引数に変数名を指定することでビューで変数が使える。
        return view('index', compact('reviews'));
    }
    
    // showメソッドを追加する際に引数に$idを指定 ルーティングに書いた変数とコントローラーメソッドの変数名を一致させる必要がある
    public function show($id)
    {
    // Reviewモデル を通じて、URLパラメーターに一致かつ、status=1（アクティブなレビュー）を1件取得します。
    // URLから渡ってきたidに一致するレビューを取りに行くため、 reviewsテーブルのidとURLパラメーターが一致する行を取得 複数条件で指定したい場合はwhere()を続けて書く
    $review = Review::where('id', $id)->where('status', 1)->first();
    
    return view('show', compact('review'));
    }
    
    

        public function create()
    {
        return view('review');
    }
    
        public function store(Request $request)
    {
        $post = $request->all();
        
        // バリデーション実行
        $validatedData = $request->validate([
        'title' => 'required|max:255',
        'body' => 'required',
        'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
     if ($request->hasFile('image')) {
         
        $request->file('image')->store('/public/images');
        $data = ['user_id' => \Auth::id(), 'title' => $post['title'], 'body' => $post['body'], 'image' => $request->file('image')->hashName()];
        
     } else {
        $data = ['user_id' => \Auth::id(), 'title' => $post['title'], 'body' => $post['body']];
      }
        
        Review::insert($data);
        
        // フラッシュメッセージを表示する
        return redirect('/')->with('flash_message', '投稿が完了しました');
    }
}
