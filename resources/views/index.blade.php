@extends('layouts.app')

	@section('css')
	    <link href="{{ asset('css/top.css') }}" rel="stylesheet">
	@endsection

	@section('content')
		<div class="row justify-content-center container">

		<!--コントローラーから受け取ったオブジェクトの中身を1つずつ展開していくループ関数-->
		 @foreach($reviews as $review)
			
		    <div class="col-md-4">
		        <div class="card mb50">
		            <div class="card-body">
		            	
		            	<!-- !empty(変数)でチェック 空じゃなかったら下記の処理-->
		            	
				          @if(!empty($review->image))
				              <div class='image-wrapper'><img class='book-image' src="{{ asset('storage/images/'.$review->image) }}"></div>
				          @else		            	
		            
		            	<!-- !empty(変数)でチェック 空だったら下記の処理-->
		                	<div class='image-wrapper'><img class='book-image' src="{{ asset('images/dummy.png') }}"></div>
		                  
		                  @endif
		                
		                <!--タイトルを代入-->
		                 <h3 class='h3 book-title'>{{ $review->title }}</h3>
		                
		                 <!--bodyを代入-->
		                <p class='description'>
		                     {{ $review->body }}
		                </p>
		                <!--パラメーター名=id、実際の値はreiewsテーブルのid値-->
		                <a href="{{ route('show', ['id' => $review->id ]) }}"class='btn btn-secondary detail-btn'>詳細を読む</a>
		            </div>
		        </div>
		    </div>
		  @endforeach
		</div>
		<!--自動的に生成されたページネーションの中にlinks()という項目があり、link()の正体はビューで使えるHTMLコード-->
		{{ $reviews->links() }}
		
	@endsection