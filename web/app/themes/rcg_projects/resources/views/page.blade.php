@extends('layouts.app')

@section('content')
  @posts
    @includeFirst(['partials.content-page', 'partials.content'])
  @endposts
@endsection
