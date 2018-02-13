 <div class="blog-masthead">
      <div class="container">
        <nav class="nav blog-nav">
          <a class="nav-link active" href="/">All Posts</a>
          @guest
            <a class="nav-link ml-auto" href="/register">Register</a>
            <a class="nav-link ml" href="/login">Login <span class="glyphicon glyphicon-user"></span></a>
          @endguest

          @auth
            <a class="nav-link" href="/posts/create">Create Post</a>
            <a class="nav-link" href="/myposts">My Posts</a>
            <a class="nav-link ml-auto" href="#">{{Auth::user()->name}}</a>
            <a class="nav-link ml" href="/logout">Logout <span class="glyphicon glyphicon-log-out"></span></a>
          @endauth
        </nav>
      </div>
    </div>
