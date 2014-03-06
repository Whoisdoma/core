@extends('whoisdoma::layouts.master')

@section('page_title','Whoisdoma Core Admin - View Servers')

@section('menu')

@if (Auth::check())
<ul class="nav navbar-nav">
    <li><a href="{{ URL::route('admin_overview') }}">Overview</a></li>
    <li><a href="{{ URL::route('admin_view_servers') }}">Servers</a></li>
    <li><a href="{{ URL::route('admin_add_server') }}">Add Server</a></li>
    <li class="active"><a href="{{ URL::route('admin_view_apikeys') }}">Api Keys</a></li>
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
<div class="page-header">
    <h1>View Api Keys</h1>
</div>
<table class="table">
    <thead>
        <tr>
        <th>Api Key</th>
        <th>Created At</th>
        <th>Updated At</th>
        </tr>
    </thead>
    <tbody>
        <?php             
            foreach($apikeys as $apikey)
            {
                echo "<tr>
               <td>". $apikey->api_key ."</td>
               <td>". $apikey->created_at ."</td>
               <td>". $apikey->updated_at ."</td>
               <td>
                <a class='btn btn-default btn-xs' href='". url('admin/apikeys/delete/'. $apikey->id) ."'>Delete Api Key</a>
               </td>
               </tr>";
            }
        ?>
    </tbody>
</table>
@stop
