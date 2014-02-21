<?php

namespace Whoisdoma\Controllers;

use Illuminate\Support\Facades\View;

class MainController extends BaseController {
    
    public function showIndex()
    {
        return View::make('whoisdoma::index');
    }
    
}

