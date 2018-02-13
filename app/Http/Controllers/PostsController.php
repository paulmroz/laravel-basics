<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

use Carbon\Carbon;

class PostsController extends Controller
{
	public function __construct()
	{

		$this->middleware('auth')->except(['index', 'show']);

	}

	public function index()
	{

		$posts = Post::latest();

		if (request(['month', 'year'])) {

		    $posts->filter(request(['month', 'year']));

		} 
		
		$posts = $posts->paginate(5);

		return view('posts.index', compact('posts'));
	}

	public function show(Post $post)
	{
		return view('posts.show', compact('post'));
	}




	public function create()
	{
		return view('posts.create');
	}



	public function store()
	{
		

			$this->validate(request(),[

				'title'=>'required',
				'body'=>'required'

			]);

			auth()->user()->publish(
				new Post(request(['title','body']))
			);

			session()->flash('message', 'Your post has been published');

		/*Post::create([

			'title' =>request('title'),
			'body' =>request('body'),
			'user_id' =>auth()->id()	

		]);*/
		//redirect to homepage
		return redirect('/');
	}
	

	public function destroy(Post $post)
	{	
		if ($post->user->id == auth()->id()) {
			$post->find($post->id);
			$post->delete();

			session()->flash('message', 'Your post has been successfully deleted');
		}
		
		return redirect()->back();
	}

	public function userposts(){
		try {
			
		$posts = Post::where('user_id',auth()->id())->get();	

		return view('posts.userposts', compact('posts'));
		} catch(Exception $e) {
			return redirect()->back();
		}
	}

}
