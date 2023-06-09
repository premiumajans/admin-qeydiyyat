<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AltCategory;
use App\Models\Category;
use App\Models\Certificate;
use App\Models\Contact;
use App\Models\Package;
use App\Models\Partner;
use App\Models\Paylasim;
use App\Models\Product;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    public function index()
    {
       $counts = [
            /* 'newsViews' => convert_number(Paylasim::where('category_id', Category::where('slug', 'news')->value('id'))->get()->sum('view_count')),
            'allViews' => convert_number(Paylasim::where('category_id', '!=', Category::where('slug', 'news')->value('id'))->get()->sum('view_count')),
            'generalViews' => convert_number(Paylasim::all()->sum('view_count')),
            'news' => convert_number(Paylasim::where('category_id', Category::where('slug', 'news')->value('id'))->count()),
            'contactUs' => convert_number(Contact::count()),
            'posts' => convert_number(Paylasim::where('category_id', '!=', Category::where('slug', 'news')->value('id'))->count()),
            'sharedPostCount' => convert_number(Paylasim::where('user_id', Auth::user()->id)->count()), */

            'sliders' => convert_number(Slider::count()),
            'packages' => convert_number(Package::count()),
            'teams' => convert_number(Team::count()),
            'partners' => convert_number(Partner::count()),
        ]; 

        
        return view('backend.dashboard', get_defined_vars());
    }
}
