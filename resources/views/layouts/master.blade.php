@include('includes.head')
 @include('includes.style')
<body class="dark-sidenav">
@include('includes.sidebar')
<div class="page-wrapper">
@include('includes.navbar')



@yield('content')
<div class="page-content">







    @include('includes.footer')
    </div>
</div>
        @include('includes.script')
    </body>
</html>