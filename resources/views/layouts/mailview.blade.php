@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-3">
            @yield('side')
        </div>
        <div class="col-md-9">
            @yield('body')
        </div>
    </div>

</div>



@endsection

@section('scripts')
    @yield('page-scripts')
@endsection
