@extends('welcome')
@section('content')
<div class="post-preview">
        <h2 class="post-title">
            {{$singleNews->title}}
        </h2>
        <p class="post-subtitle">
            {{$singleNews->details}}
        </p>
        <p class="post-meta">Posted by
            <a href="#">{{$singleNews->author}}</a>
              on September 24, 2019</p>
</div>
@endsection