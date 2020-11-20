<?php

namespace App\Http\Controllers;

use App\Video;
use App\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = Video::orderBy('id', 'desc')->paginate(12);
        return view('welcome', ['data' => $data]);
    }

    public function watch($id)
    {
        $data = Video::findOrFail($id);
        $comments = Comment::where('video_id', $id)->get();
        $top_rate = Comment::where('video_id', $id)->orderBy('rate', 'desc')->limit(3)->get();
        // possitive review percents
        $positive_responsive = Comment::where('video_id', $id)->where('rate', '>=', 2.5)->count();
        $positive_responsive = $positive_responsive ? number_format (($positive_responsive/$data->total_reviews)*100, 2) : 0;
        // negative review percents
        $negative_responsive = Comment::where('video_id', $id)->where('rate', '<=', 2.5)->count();
        $negative_responsive = $negative_responsive ? number_format (($negative_responsive/$data->total_reviews)*100, 2) : 0;
        return view('watch', ['data' => $data, 'comments' => $comments, 'top_rate' => $top_rate, 'positive_responsive' => $positive_responsive, 'negative_responsive' => $negative_responsive]);
    }

    public function rateVideo(Request $request, $id)
    {
        $request->validate([
            'name' => "required",
            'age' => "required|numeric",
            'email' => "required|email",
            'rating' => "required|numeric|max:5|min:1",
            'comment' => "required",
        ]);
        Comment::insert([
            'video_id' => $id,
            'name' => $request->name,
            'age' => $request->age,
            'email' => $request->email,
            'rate' => $request->rating,
            'comment' => $request->comment,
            'created_at' => Carbon::now(),
        ]);
        $video = Video::findOrFail($id);
        $total_reviews = $video->total_reviews + 1;
        $total_points = $video->total_points + $request->rating;
        $rate_in_percent =(($total_points/($total_reviews*5))*100);
        $rate =(($total_points/($total_reviews*5))*5);
        $video->update([
            'total_reviews' => $total_reviews,
            'total_points' => $total_points,
            'rate_in_percent' => $rate_in_percent,
            'rate' => $rate,
        ]);
        return back();
    }
}
