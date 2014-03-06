@extends('whoisdoma::layouts.master')

@section('page_title','Whoisdoma Core Admin - Add Server')

@section('menu')

@if (Auth::check())
<ul class="nav navbar-nav">
    <li><a href="{{ URL::route('admin_overview') }}">Overview</a></li>
    <li class="active"><a href="{{ URL::route('admin_view_servers') }}">Servers</a></li>
    <li><a href="{{ URL::route('admin_add_server') }}">Add Server</a></li>
    <li><a href="{{ URL::route('admin_view_apikeys') }}">Api Keys</a></li>
    <li><a href="{{ URL::route('admin_add_apikey') }}">Generate Api Key</a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> {{ Auth::user()->username }} <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="{{ URL::route('logout') }}">Logout</a></li>
        </ul>
    </li>
</ul>
@endif

@stop

@section('content')

<form method="post" class="addContentBox" role="form">
    <h2>Edit Server</h2>
    
    <?php
    
        if (Session::has('errors'))
        {
            $errors = Session::get('errors');
            
            foreach ($errors->all() as $error)
            {
                echo "<div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".
                $error ."</div>";
 
            }
        }
        
        if (Session::has('success'))
        {
            $successMsg = Session::get('success');
            
            echo "<div class='alert alert-success alert-dismissable'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".
            $successMsg ."</div>";
        }
    
    ?>
    
    <div class="form-group">
        <label for="tld">TLD</label>
        <input type="text" class="form-control" name="tld" value="{{ $server->tld }}"/>
    </div>
    <div class="form-group">
        <label for="server">Server</label>
        <input type="text" class="form-control" name="server" value="{{ $server->server }}"/>
    </div>
    <div class="form-group">
        <label for="createdat">Created At</label>
        <p class="form-control-static">{{ $server->created_at }}</p>
    </div>
    <div class="form-group">
        <label for="updatedat">Updated At</label>
        <p class="form-control-static">{{ $server->updated_at }}</p>
    </div>
    <input type="submit" class="btn btn-primary" value="Update Server"/>
</form>

@stop

