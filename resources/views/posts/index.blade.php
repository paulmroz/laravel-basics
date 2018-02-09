
@extends ('layouts.master')


@section('content')
<div class="col-sm-8 blog-main">

        @foreach($posts as $post)
          @include('posts.post')
        @endforeach  

        
        <div class="row">
		    <div class="col-md-6 col-md-offset-8">
		    	{{$posts->appends(Request::except('page'))->links()}}
		    </div>
		</div>

        </div>
  @endsection






       