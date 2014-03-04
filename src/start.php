<?php

if (Whoisdoma\Core::isInstalled())
{
    Config::set('database.connections.whoisdoma', Config::get('whoisdoma.database'));
    DB::setDefaultConnection('whoisdoma');
}

// Load our helpers (composers, macros, validators etc.)
include __DIR__.'/helpers.php';

