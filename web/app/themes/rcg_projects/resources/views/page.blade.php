@extends('layouts.app')

@section('content')
  @posts
    @include('partials.page-header')
    @includeFirst(['partials.content-page', 'partials.content'])
  @endposts
@endsection
