@extends('app')

@section('content')
<div class="container">
    
    <div class="row">
    <div class="page-header">
        <div class="h2" style="display:inline-block">
            Threads
        </div>
        <div style="display:inline-block;float:right;">
            <code>Merkle Tree: {{ $merkle }}</code>
            <a href="/threads/new" class="btn btn-primary">Create Thread</a>
        </div>
    </div>

    <div class="col-xs-12">

      <ul class="media-list">

        @foreach ($all as $t)
           <div class="panel panel-default"> <div class="panel-body"> <div class="media"> <div class="media-left"> <a href=""> <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG21sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PGRlZnMvPjxyZWN0IHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjE0LjUiIHk9IjMyIiBzdHlsZT0iZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQ7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NjR4NjQ8L3RleHQ+PC9nPjwvc3ZnPg==" data-holder-rendered="true" style="width: 64px; height: 64px;"> <small>&#64;username</small> </a> </div><div class="media-body"> <div class=""><a href="/threads/hash/{{$t->content_hash}}" class="h4 media-heading">{{$t->title}}</a> <div style="display:inline-block;float:right;font-size:12px;"> <span> <time class="timeago" datetime="{{$t->created_at}}"></time> | {{ count($t->comments)}} replies | </span> <span style="color:#ccc;"> chash:<a href="/threads/hash/{{$t->content_hash}}">{{$t->content_hash}}</a> </span> </div></div>{{substr($t->body, 0, 140)}}</div></div></div></div>

        @endforeach

      </ul>

    </div>

</div>
</div>

@endsection