<?php

namespace App\Http\Controllers;

use App\Http\Requests\PosteStoreRequest;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $auth=Auth::user();
        if($auth->isAdmin()){
            $posts=Post::where('is_approved',0)->get();
            return view('posts.index_all',['posts'=>$posts]);
        }else{
            $posts=$auth->posts->where('is_approved',1);
            return view('posts.index_my',['posts'=>$posts]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $auth=Auth::user();

        $current_date=Carbon::now("Asia/Yerevan")->format('d-m-Y');
        $last_post=$auth->posts->last();

        if($last_post){
            $posts_date=$last_post->created_at->format('d-m-Y');
            if($current_date==$posts_date){
                return view('posts.post_limite');
            }else{
                return view('posts.create');
            }
        }else{
            return view('posts.create');
        }
    }

    private function makeDirectory(){
        $directoryPath=public_path('photo');
        if (!file_exists($directoryPath)){
            mkdir($directoryPath,0777, true);
        }
        return $directoryPath;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PosteStoreRequest $request)
    {
        $auth_id=Auth::user()->id;
        $post_request=$request->all();
        $dir=$this->makeDirectory();
        $image=array_get($post_request, 'photo');
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $image->move($dir,$imagename);
        $post=new Post([
            'title'=>array_get($post_request, 'title'),
            'description'=>array_get($post_request, 'description'),
            'user_id'=>$auth_id,
            'image_path'=>'/photo/'.$imagename,
            'image_type'=>$image->getClientOriginalExtension(),
            'image_original_name'=>$image->getClientOriginalName(),
            'is_approved'=>0,
        ]);
        $post->save();
        return redirect('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd(Post::where('id',$id)->get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Post::where('id',$id)->first()->update([
            'is_approved'=>1,
        ]);
//        dd($id);
//        return redirect('users');

//        Post::where('id',$id)->first()->update([
//            'is_approved'=>1,
//        ]);
//
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
