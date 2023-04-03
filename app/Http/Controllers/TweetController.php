<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTweetRequest;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
class TweetController extends Controller
{
    public function showAllTweet(Request $request): View
    {
        $tweets = Tweet::with('user')->latest()->paginate(10);
        return view('timeline', [
            'tweets' => $tweets
        ]);
    }

    public function add(StoreTweetRequest $request){
        $tweet = new tweet($request->validated());

        $tweet->user_id = Auth::user()->id;
        $tweet->save();
        return redirect()->route('timeline');
    }

    public function destroy($id){
        $tweet = Tweet::find($id);
        $this->authorize('delete',$tweet);
        $tweet->delete();
        return redirect()->route('timeline');
    }

    public function dashboard(){
        $tweets = Tweet::with('user')->where('user_id',Auth::user()->id)->latest()->paginate(10);
        return view('dashboard',['tweets'=>$tweets]);
    }


}
