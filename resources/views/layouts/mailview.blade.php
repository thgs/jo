@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row border-bottom bg-white">
        <div class="col-md-3">
            @yield('topbar-side')
        </div>
        <div class="col-md-9">
            @yield('topbar')
        </div>
    </div>
</div>

<div class="container">

    <div class="row">
        <div class="col-md-3">
            @yield('side')
        </div>
        <div class="col-md-9 bg-white">
            @yield('body')
        </div>
    </div>

</div>



@endsection

@section('scripts')
    @yield('page-scripts')
@endsection
