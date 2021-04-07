<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Review;

class ReviewController
{
    public function addReview(Request $request)
    {
        $validateData = $request->validate(["comment" => "required"]); 
        $review = new Review();
        $review->content = $validateData["comment"];
        $review->save();
        return redirect('/');
        
    }
}