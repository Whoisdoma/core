<?php

Route::filter('whoisdoma_is_installed', function(){
    
    if (!Whoisdoma\Core::isInstalled())
    {
        return View::make('whoisdoma::not_installed')
                ->with('has_installer', false);
    }
    
});


