<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use \Cache;
use App\Comment;
use App\Thread;
use App\Tag;
use App\Taggable;

use \Pleo\Merkle\FixedSizeTree;

class ThreadController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$merkle = $this->merkleMan();
		$all = Thread::orderBy('id', 'DESC')->take(5)->get();
		return view('threads.index', [ 
			'all' 		=> $all,
			'merkle'	=> $merkle 
			]);
	}

	public function merkleMan($flush = false) {
		if ($flush == false && Cache::has('merkle'))
		{
				$c = Cache::get('merkle');
		    return $c;
		}
		$hasher = function ($data) {
		    return hash('sha256', hash('sha256', $data, true), true);
		};

		$finished = function ($hash) {
		    $this->mt = implode('', unpack('H*', $hash)) . "\n";
		};
		$all = Thread::lists('content_hash');
		$all = array_merge(Comment::lists('hash'));
		$tree = new FixedSizeTree(count($all), $hasher, $finished);
		$i = 0;
		foreach ($all as $t) {
			$tree->set($i, $t[0]);
			$i++;
		}
		Cache::put('merkle', $this->mt, 5);
		return $this->mt;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('threads.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//return response()->json($request->all(), 200, [], JSON_PRETTY_PRINT);
			$messages = [
			    'unique' => 'This content was already posted!',
			];
	    $this->validate($request, [
	        'title' => 'required|max:255',
	        'body' 	=> 'required|unique:threads',
	    ], $messages);
	    $input = $request->all();
	    $title = e($input['title']);
	    $body = e($input['body']);
	    $chash = hash('sha1', $title.$body);
	    $thread = new Thread;
	    $thread->user_id = (\Auth::check()) ? \Auth::id() : 0;
	    $thread->title = e($input['title']);
	    $thread->body = e($input['body']);
	    $thread->content_hash = $chash;
	    $thread->save();

	    $tags = str_getcsv($input['tags'], ',');
	    foreach($tags as $tag) {
	    	$tg = Tag::firstOrCreate(['name' => $tag]);
	    	$tg->save();
	    	$tgb = Taggable::firstOrCreate([
	    		'tag_id' 				=> $tg->id,
	    		'taggable_id' 	=> $thread->id,
	    		'taggable_type' => 'App\Thread'
	    		]);
	    	$tgb->save();
	    }
	    // Create new merkle tree
	    $this->merkleMan(true);
	    return redirect('/threads/hash/'.$chash);

	}

	public function commentstore(Request $request, $id)
	{
		//return response()->json($request->all(), 200, [], JSON_PRETTY_PRINT);
			$thread = Thread::where('content_hash', '=', $id)->firstOrFail();
			$messages = [
			    'unique' => 'This content was already posted!',
			];
	    $this->validate($request, [
	        'body' 	=> 'required',
	        'pid'		=> 'required|integer'
	    ], $messages);
	    $input = $request->all();
	    $body = e($input['body']);
	    $chash = hash('sha1', $input['body']);
	    $comment = new Comment;
	    $comment->type = 'thread';
	    $comment->is_parent = ((int) $input['pid'] === 0) ? true : false;
	    $comment->pid = ($comment->is_parent) ? 0 : (int) $input['pid'];
	    $comment->user_id = (\Auth::check()) ? \Auth::id() : 0;
	    $comment->thread_id = (int) $thread->id;
	    $comment->body = e($input['body']);
	    $comment->hash = $chash;
	    $comment->save();

	    // Create new merkle tree
	    $this->merkleMan(true);
	    return redirect('/threads/hash/'.$id);

	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$t = Thread::where(['content_hash' => $id])->firstOrFail();
		return view('threads.show',[
			't' => $t
			]);
	}

	public function shortlink($id) {

		$id = (int) $id;

		$t = Thread::findOrFail($id);

		return redirect('/threads/hash/'.$t->content_hash);



	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
