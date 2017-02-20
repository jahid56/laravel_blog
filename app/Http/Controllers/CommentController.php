<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\User;
use App\Track;
use App\Comment;
use Illuminate\Support\Facades\File;
use Auth;

class CommentController extends Controller
{

    /*
     This function is used for showing the comment list
    */
    public function create($id) {
    	if(Auth::User()) {
    		return view('post.commentAdd')->with('comments_posts_id', $id);
    	} else {
    		return redirect()->back()->with('error', 'You must Login to Create Comment.');
    	}
    }

    /*
     This function is used for storing the comment list
    */

    public function store(Request $request) {
    	$id = Input::get('comments_posts_id');
    	if(empty(Input::get('comments_title'))) {
    		return redirect()->back()->withInput()->with('error', 'Sorry!!! Comment Title Cannot Be Empty');
    	} else if(empty(Input::get('comments_body'))) {
    		return redirect()->back()->withInput()->with('error', 'Sorry!!! Comment Body Cannot Be Empty');
    	} else {
            $randomNumber = new Track;
            $trackId = $randomNumber->randomNumber(5, 10) . "MahMUD" . date('YmdHis');
            $comment = New Comment();
            $comment->comments_posts_id = $id;
            $comment->comments_title = $request['comments_title'];
            $comment->comments_body = $request['comments_body'];
            $comment->comments_users_id = Auth::User()->users_track_id;
            $comment->created_at = Carbon::now();
            $comment->comments_track_id = $trackId;

            $whitelist = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG');
            $img_name = $_FILES['comments_picture']['name'];
            $file = Input::file("comments_picture");
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
                $comment->comments_picture = $rename_img;
                $file->move(('upload/comments_picture/'), $rename_img);
            }
            if ($comment->save()) {
                return redirect('posts/show/'.$id)->with('success', 'Information saved successfully');
            } else {
                return redirect()->back()->with('error', 'Sorry!!! something went wrong. please try again.');
            }
	    }
	}

    /*
     This function is used for editing the comment list
    */

	public function edit($postId, $id) {
		$dataList = Comment::where('comments_track_id', $id)->first();
		if(Auth::User()->users_track_id == $dataList->comments_users_id) {
    		return view('post.commentEdit', compact('topicList', 'dataList'))->with('comments_posts_id', $postId)->with('comments_track_id', $id);
    	} else {
    		return redirect()->back()->with('error', 'You are not authorize to edit this comment.');
    	}
	}

    /*
     This function is used for updating the comment list
    */

	public function update(Request $request) {
		$comments_track_id = Input::get('comments_track_id');
		$comments_posts_id = Input::get('comments_posts_id');
    	if(empty(Input::get('comments_title'))) {
    		return redirect()->back()->withInput()->with('error', 'Sorry!!! Coomment Title Cannot Be Empty');
    	} else if(empty(Input::get('comments_body'))) {
    		return redirect()->back()->withInput()->with('error', 'Sorry!!! Comment Body Cannot Be Empty');
    	} else {
            $comment = Comment::where('comments_track_id', $comments_track_id)->first();
            $comment->comments_title = $request['comments_title'];
            $comment->comments_body = $request['comments_body'];
            $comment->updated_At = Carbon::now();

            $whitelist = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG');
            $img_name = $_FILES['comments_picture']['name'];
            $file = Input::file("comments_picture");
            //process each file
            if (!empty($img_name)) {
                $rename_img = '';
                $ext = pathinfo($img_name);
                $ext = $ext['extension'];
                if (in_array($ext, $whitelist)) {
                    $rename_img = "CRT" . date('YmdHis') . "OL" . '.' . $ext;
                    if ($comment->comments_picture) {
                        $certificateImage = public_path("upload/comments_picture/{$comment->comments_picture}"); // get previous image from folder
                        if (File::exists($certificateImage)) { // unlink or remove previous image from folder
                            unlink($certificateImage);
                        }
                    }
                } else {
                    return redirect()->back()->with('error', 'The image file must be jpg, jpeg, png format.');
                }
                $comment->comments_picture = $rename_img;
                $file->move(('upload/comments_picture/'), $rename_img);
                $comment->comments_picture = $rename_img;
            } else {
                $rename_img = $post->comments_picture;
                $comment->comments_picture = $rename_img;
            }
            
            if ($comment->save()) {
                return redirect('posts/show/'.$comments_posts_id)->with('success', 'Information updated successfully');
            } else {
                return redirect()->back()->with('error', 'Sorry!!! something went wrong. please try again.');
            }
	    }
	}

	 /*
     This function is used for deleting the comment list
    */

    public function delete(Request $request) {
        $id = $request->input('comments_track_id');
        $comment = Comment::where('comments_track_id', $id)->first();
        if(Auth::User()->users_track_id == $comment->comments_users_id) {
	        $comment->delete();
	        return redirect()->back()->with('success', 'Success :) information deleted.');
	    } else {
	    	return redirect()->back()->with('error', 'You are not authorize to delete this comment.');
	    }
	}
}
