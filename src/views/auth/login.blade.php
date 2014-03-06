@extends('whoisdoma::layouts.master')

@section('page_title','Whoisdoma Core Admin - Login')

@section('content')
<form method="post" class="loginBox" role="form">
    <h2>Login</h2>
    
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
    
    ?>
    
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" placeholder="Username"/>
    </div>
    <div class="form-group">
        <label for="pass">Password</label>
        <input type="password" class="form-control" name="pass" placeholder="Password"/>
    </div>
    
    <input type="submit" class="btn btn-primary" value="Login"/>
</form>
@stop

