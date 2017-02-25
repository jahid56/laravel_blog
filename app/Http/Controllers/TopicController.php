<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use App\Track;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\User;
use Auth;

class TopicController extends Controller {

    public function index() {
        $dataList = Topic::all();
        return view('post.topicIndex', compact('dataList'));
    }

    public function create() {
        if (Auth::User()) {
            return view('post.topicCreate');
        } else {
            return redirect('topics')->with('error', 'You must Login to Create Topic.');
        }
    }

    public function store(Request $request) {
        if (empty(Input::get('topics_name'))) {
            return redirect()->back()->withInput()->with('error', 'Sorry!!! Topic Name Cannot Be Empty');
        } else if (Topic::where('topics_name', Input::get('topics_name'))->exists()) {
            return redirect()->back()->withInput()->with('error', 'Sorry!!! information already exists');
        } else {
            $randomNumber = new Track;
            $trackId = $randomNumber->randomNumber(5, 10) . "MahMUD" . date('YmdHis');
            $topic = New Topic();
            $topic->topics_name = $request['topics_name'];
            $topic->users_track_id = Auth::User()->users_track_id;
            $topic->created_at = Carbon::now();
            $topic->topics_track_id = $trackId;
            if ($topic->save()) {
                return redirect('topics')->with('success', 'Information saved successfully');
            } else {
                return redirect()->back()->with('error', 'Sorry!!! something went wrong. please try again.');
            }
        }
    }

    public function edit($id) {
        $dataList = Topic::where('topics_track_id', $id)->first();
        if (Auth::User()->users_track_id == $dataList->users_track_id) {

            return view('post.topicEdit', compact('dataList'));
        } else {
            return redirect('topics')->with('error', 'You must Login to Create Topic.');
        }
    }

    public function update(Request $request) {
        $id = $request->input('topics_track_id');
        $data = Topic::where('topics_track_id', '!=', $id)
                ->where('topics_name', Input::get('topics_name'))
                ->exists();
        if (empty(Input::get('topics_name'))) {
            return redirect()->back()->withInput()->with('error', 'Sorry!!! Topic Name Cannot Be Empty');
        } else if ($data) {
            return redirect()->back()->withInput()->with('error', 'Information already exists');
        } else {
            $topic = Topic::where('topics_track_id', $id)->first();
            $topic->topics_name = $request['topics_name'];
            if ($topic->save()) {
                return redirect('topics')->with('success', 'Information updated successfully');
            } else {
                return redirect()->back()->with('error', 'Sorry!!! something went wrong. please try again.');
            }
        }
    }

}
