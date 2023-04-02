<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\TouristAttraction;
use App\Models\Homestay;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        $news = News::orderBy('news_date', 'desc')->take(3)->get();
        $touristAttractions = TouristAttraction::orderBy('created_at', 'desc')->take(3)->get();
        $homestays = Homestay::orderBy('created_at', 'desc')->take(3)->get();
        return view('home', compact('news', 'touristAttractions', 'homestays'));
    }
}
