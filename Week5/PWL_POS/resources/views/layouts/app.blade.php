<div>
    @extends('adminlte::page')

    @section('title', config('adminlte.title'))

    @section('content_header')
    <h1 class="text-muted">@yield('content_header_title')</h1>
    @stop

    @section('content')
    @yield('content_body')
    @stop

    @section('footer')
    <div class="float-right">
        Version: {{ config('app.version', '1.0.0') }}
    </div>
    <strong>
        <a href="{{ config('app.company_url', '#') }}">{{ config('app.company_name', 'My Company') }}</a>
    </strong>
    @stop

    @push('js')
        <script>
            $(document).ready(function () {
                console.log("AdminLTE Loaded!");
            });
        </script>
    @endpush
</div>