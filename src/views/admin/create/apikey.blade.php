@extends('whoisdoma::layouts.master')

@section('page_title','Whoisdoma Core Admin - Generate Api Key')

@section('menu')

@if (Auth::check())
<ul class="nav navbar-nav">
    <li><a href="{{ URL::route('admin_overview') }}">Overview</a></li>
    <li><a href="{{ URL::route('admin_view_servers') }}">Servers</a></li>
    <li><a href="{{ URL::route('admin_add_server') }}">Add Server</a></li>
    <li><a href="{{ URL::route('admin_view_apikeys') }}">Api Keys</a></li>
    <li class="active"><a href="{{ URL::route('admin_add_apikey') }}">Generate Api Key</a></li>
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
    <h2>Generate Api Key</h2>
    
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
        
        if (Session::has('key'))
        {
            $key = Session::get('key');
            
            echo "<div class='alert alert-success alert-dismissable'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".
            $key ."</div>";
        }
    
    ?>
    <p>Use this page to generate a new api key that can be used to preform a whois lookup.</p>
    <input type="submit" value="Generate"/>
</form>

@stop

