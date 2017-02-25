<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\User;
use App\Topic;
use App\Track;
use App\Comment;
use Illuminate\Support\Facades\File;
use Auth;

class PostController extends Controller {
    /*
      This function is used for showing the post list
     */

    public function index() {
        $dataList = Post::leftJoin('topics', 'posts.topics_track_id', 'topics.topics_track_id')
                ->leftJoin('users', 'posts.posts_users_id', 'users.users_track_id')
                ->select('posts.*', 'topics.topics_name', 'users.name')
                ->get();
        return view('post.index', compact('dataList'));
    }

    /*
      This function is used for creating the post list
     */

    public function create() {
        if (Auth::User()) {
            $topicList = Topic::all();
            return view('post.create', compact('topicList'));
        } else {
            return redirect('posts')->with('error', 'You must Login to Create Posts.');
        }
    }

    /*
      This function is used for storing the post list
     */

    public function store(Request $request) {
        if (empty(Input::get('topics_track_id'))) {
            return redirect()->back()->withInput()->with('error', 'Sorry!!! Topic Name Cannot Be Empty');
        } else if (empty(Input::get('posts_title'))) {
            return redirect()->back()->withInput()->with('error', 'Sorry!!! Post Title Cannot Be Empty');
        } else if (empty(Input::get('posts_body'))) {
            return redirect()->back()->withInput()->with('error', 'Sorry!!! Post Body Cannot Be Empty');
        } else {
            $randomNumber = new Track;
            $trackId = $randomNumber->randomNumber(5, 10) . "MahMUD" . date('YmdHis');
            $post = New Post();
            $post->topics_track_id = $request['topics_track_id'];
            $post->posts_title = $request['posts_title'];
            $post->posts_body = $request['posts_body'];
            $post->posts_users_id = Auth::User()->users_track_id;
            $post->created_at = Carbon::now();
            $post->posts_track_id = $trackId;

            $whitelist = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG');
            $img_name = $_FILES['posts_picture']['name'];
            $file = Input::file("posts_picture");
            //process each file
            if (!empty($img_name)) {
                $rename_img = '';
                $ext = pathinfo($img_name);
                $ext = $ext['extension'];
                if (in_array($ext, $whitelist)) {
                    $rename_img = "CRT" . date('YmdHis') . '.' . $ext;
                } else {
                    return redirect()->back()->with('error', 'The image file must be jpg, jpeg, png format.');
                }
                $post->posts_picture = $rename_img;
                $file->move(('upload/posts_picture/'), $rename_img);
            }
            if ($post->save()) {
                return redirect('posts')->with('success', 'Information saved successfully');
            } else {
                return redirect()->back()->with('error', 'Sorry!!! something went wrong. please try again.');
            }
        }
    }

    /*
      This function is used for editing the post list
     */

    public function edit($id) {
        $dataList = Post::where('posts_track_id', $id)->first();
        if (Auth::User()) {
            if (Auth::User()->users_track_id == $dataList->posts_users_id) {
                $topicList = Topic::all();
                return view('post.edit', compact('topicList', 'dataList'))->with('posts_track_id', $id);
            } else {
                return redirect('posts')->with('error', 'You must Login to update Posts.');
            }
        } else {
            return redirect()->back()->with('error', 'You must login to edit this post.');
        }
    }

    /*
      This function is used for updating the post list
     */

    public function update(Request $request) {
        $id = Input::get('posts_track_id');
        if (empty(Input::get('topics_track_id'))) {
            return redirect()->back()->withInput()->with('error', 'Sorry!!! Topic Name Cannot Be Empty');
        } else if (empty(Input::get('posts_title'))) {
            return redirect()->back()->withInput()->with('error', 'Sorry!!! Post Title Cannot Be Empty');
        } else if (empty(Input::get('posts_body'))) {
            return redirect()->back()->withInput()->with('error', 'Sorry!!! Post Body Cannot Be Empty');
        } else {
            $post = Post::where('posts_track_id', $id)->first();
            $post->topics_track_id = $request['topics_track_id'];
            $post->posts_title = $request['posts_title'];
            $post->posts_body = $request['posts_body'];
            $post->updated_at = Carbon::now();

            $whitelist = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG');
            $img_name = $_FILES['posts_picture']['name'];
            $file = Input::file("posts_picture");
            //process each file
            if (!empty($img_name)) {
                $rename_img = '';
                $ext = pathinfo($img_name);
                $ext = $ext['extension'];
                if (in_array($ext, $whitelist)) {
                    $rename_img = "CRT" . date('YmdHis') . "OL" . '.' . $ext;
                    if ($post->posts_picture) {
                        $certificateImage = public_path("upload/posts_picture/{$post->posts_picture}"); // get previous image from folder
                        if (File::exists($certificateImage)) { // unlink or remove previous image from folder
                            unlink($certificateImage);
                        }
                    }
                } else {
                    return redirect()->back()->with('error', 'The image file must be jpg, jpeg, png format.');
                }
                $post->posts_picture = $rename_img;
                $file->move(('upload/posts_picture/'), $rename_img);
                $post->posts_picture = $rename_img;
            } else {
                $rename_img = $post->posts_picture;
                $post->posts_picture = $rename_img;
            }

            if ($post->save()) {
                return redirect('posts')->with('success', 'Information updated successfully');
            } else {
                return redirect()->back()->with('error', 'Sorry!!! something went wrong. please try again.');
            }
        }
    }

    /*
      This function is used for showing the specific post list
     */

    public function show($id) {
        $post = Post::where('posts_track_id', $id)->first();
        $dataList = Post::leftJoin('topics', 'posts.topics_track_id', 'topics.topics_track_id')
                ->leftJoin('users', 'posts.posts_users_id', 'users.users_track_id')
                ->first();
        $commentList = Comment::leftJoin('users', 'comments.comments_users_id', 'users.users_track_id')
                ->where('comments_posts_id', $dataList->posts_track_id)
                ->select('comments.*', 'users.name')
                ->get();
        return view('post.show', compact('dataList', 'commentList'));
    }

    /*
      This function is used for showing the search of comment list
     */

    public function searchComment($id, Request $request) {
        $searchText = $request->input('searchText');
        $post = Post::where('posts_track_id', $id)->first();
        $dataList = Post::leftJoin('topics', 'posts.topics_track_id', 'topics.topics_track_id')
                ->leftJoin('users', 'posts.posts_users_id', 'users.users_track_id')
                ->first();
        $commentList = Comment::leftJoin('users', 'comments.comments_users_id', 'users.users_track_id')
                ->orWhere('users.name', 'LIKE', '%' . $searchText . '%')
                ->orWhere('comments_title', 'LIKE', '%' . $searchText . '%')
                ->orWhere('comments_body', 'LIKE', '%' . $searchText . '%')
                ->orWhere('comments.created_at', 'LIKE', '%' . $searchText . '%')
                ->orWhere('comments.updated_at', 'LIKE', '%' . $searchText . '%')
                ->select('comments.*', 'users.name')
                ->get();
        return view('post.show', compact('dataList', 'commentList'));
    }

    /*
      This function is used for deleteing the post list
     */

    public function delete(Request $request) {
        $id = $request->input('posts_track_id');
        $post = Post::where('posts_track_id', $id)->first();
        $comment = Comment::where('comments_posts_id', $post->posts_track_id)->first();
        if (Auth::User()) {
            if (Auth::User()->users_track_id == $post->posts_users_id) {
                $comment->delete();
                $post->delete();
                return redirect()->back()->with('success', 'Success :) information deleted.');
            } else {
                return redirect()->back()->with('error', 'You are not authorize to delete this post.');
            }
        } else {
            return redirect()->back()->with('error', 'You must login to delete this post.');
        }
    }

    /*
      This function is used for searching the post list
     */

    public function search(Request $request) {
        $searchText = $request->input('searchText');
        $dataList = Post::leftJoin('topics', 'posts.topics_track_id', 'topics.topics_track_id')
                ->leftJoin('users', 'posts.posts_users_id', 'users.users_track_id')
                ->Where('users.name', 'LIKE', '%' . $searchText . '%')
                ->orWhere('topics.topics_name', 'LIKE', '%' . $searchText . '%')
                ->orWhere('posts_title', 'LIKE', '%' . $searchText . '%')
                ->orWhere('posts_body', 'LIKE', '%' . $searchText . '%')
                ->orWhere('posts.created_at', 'LIKE', '%' . $searchText . '%')
                ->orWhere('posts.updated_at', 'LIKE', '%' . $searchText . '%')
                ->select('posts.*', 'topics.topics_name', 'users.name')
                ->get();
        return view('post.index', compact('dataList'));
    }

}
