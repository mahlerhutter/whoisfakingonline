<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Category;
use App\Media;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;



class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $categories;

    public function __construct() 
    {
        // definieren von globalen Variablen
        $this->categories = Category::orderBy('name')->get();
      

       
        View::share('categories', $this->categories);

    }


}
