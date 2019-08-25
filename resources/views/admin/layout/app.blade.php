@include('admin.layout.head')

@include('admin.layout.header')

@include('admin.layout.sidebar')

    {{-- SECTION CONTENT --}}
    @yield('content')
    {{-- END SECTION CONTENT --}}

@include('admin.layout.footer')
