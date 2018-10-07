
@foreach( setting()->all() as $setting => $value )
    {{ $setting  .' => '. ( $value ? $value : 'false' ) }}
@endforeach