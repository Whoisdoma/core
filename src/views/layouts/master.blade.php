<!DOCTYPE html>

<html>
    
    <head>
        <title>@yield('page_title')</title>
        
        <!-- begin meta tags -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- end meta tags -->
        
        <!-- begin css -->
        <link rel="stylesheet" href="{{ URL::asset('packages/whoisdoma/core/css/bootstrap.min.css') }}"/>
        <link rel="stylesheet" href="{{ URL::asset('packages/whoisdoma/core/css/main.css') }}"/>
        @yield('custom_css')
        <!-- end css -->
        
        <!-- begin js -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="{{ URL::asset('packages/whoisdoma/core/js/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('packages/whoisdoma/core/js/main.js') }}"></script>
        @yield('custom_js')
        <!-- end js -->
        
    </head>
    
    <body>
        
        <!-- begin navbar -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container-fluid">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Whoisdoma Core</a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-collapse-1">
                @yield('menu')
                </div>
            </div>
        </nav>
        <!-- end navbar -->
        
        <!-- begin content container -->
        <div class="container">
            @yield('content')
        </div>
        <!-- end content container -->
        
        <!-- begin footer -->
        <div class="navbar navbar-default navbar-fixed-bottom">
            <p class="navbar-text">&copy; <?php echo date('Y'); ?> Whoisdoma </p>
        </div>
        <!-- end footer -->
    </body>
    
</html>

