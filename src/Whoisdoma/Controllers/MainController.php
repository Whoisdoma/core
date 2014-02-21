<?php

namespace Whoisdoma\Controllers;

use Illuminate\Support\Facades\View;

class MainController extends BaseController {
    
    public function getIndex()
    {
        return View::make('whoisdoma-api::index');
    }
    
}

