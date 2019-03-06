@extends('welcome')
@section('content')
        @php
            $post=DB::table('news')->get();
        @endphp
        @foreach ($post as $row)
        <div class="post-preview">
                <a href="{{URL::to('single_news/'.$row->id)}}">
                  <h2 class="post-title">
                    {{$row->title}}
                  </h2>
                  <h6 class="post-subtitle">
                   {{$row->details}}
                  </h6>
                </a>
                <p class="post-meta">Posted by
                  <a href="#">{{$row->author}}</a>
                  on September 24, 2019</p>
              </div>
              <hr>
        <!-- Pager -->
        <div class="clearfix">
            <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
          </div>
        @endforeach
@endsection