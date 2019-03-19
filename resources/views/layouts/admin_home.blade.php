<!DOCTYPE html>
<html>
<head>
    @include('includes.head')
    @yield('extra_css')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    @include('includes.header')


    @include('includes.sidebar')



    <div class="content-wrapper">
        @yield('content')
    </div>

    @include('includes.footer')

</div>



    @include('includes.foot')
    @yield('extra_scripts')
</body>
</html>
