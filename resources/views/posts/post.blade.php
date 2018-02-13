  <div class="blog-post">
            <h2 class="blog-post-title">

              <a href="/posts/{{$post->id}} ">
                {{$post->title}}
              </a>

            </h2>
            <p class="blog-post-meta">
              {{$post->user->name }} on
              {{$post->created_at->toFormattedDateString()}}
              
            </p>
            {{$post->body}}


            @if((Auth::check()) && ($post->user->id == Auth::id()))
            <form  method="POST" action="/delete/{{$post->id}}">
                  {{ csrf_field() }}
                  {{ method_field('DELETE')}}
                  <button type="delete" class="btn btn-primary">Delete</button>
            </form>
            @endif
</div>

