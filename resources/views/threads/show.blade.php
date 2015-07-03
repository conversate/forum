@extends('app')

@section('content')

<div class="container">
  <div class="row">
    <div class="panel panel-default"> <div class="panel-body" style="min-height:180px;"> <div class="media"> <div class="media-left"> <a href="#"> <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG21sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PGRlZnMvPjxyZWN0IHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjE0LjUiIHk9IjMyIiBzdHlsZT0iZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQ7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NjR4NjQ8L3RleHQ+PC9nPjwvc3ZnPg==" data-holder-rendered="true" style="width: 64px; height: 64px;"> <small>&#64;username</small> </a> </div><div class="media-body"> <div class=""><a href="" class="h4 media-heading">{{$t->title}}</a> <div style="display:inline-block;float:right;font-size:12px;"> <span> <time class="timeago" datetime="{{$t->created_at}}"></time> | 100 views | id: <a href="/t/{{{$t->id}}}">{{$t->id}}</a> |  </span> <span style="color:#ccc;"> chash:<a href="/threads/hash/{{$t->content_hash}}">{{$t->content_hash}}</a> </span> </div></div>{{$t->body}}<hr>
    <p>
    @foreach ($t->tags as $tag)
    <a href="/hashtag/{{{$tag['name']}}}" class="btn btn-default btn-sm">
    #{{{$tag['name']}}}
    </a>
    @endforeach
    </p>
  </div></div></div></div>

    <hr>
                @if($errors->has())
                @foreach ($errors->all() as $error)
                <div class="alert alert-info">
                <p class="alert-text lead">{{ $error }}</p>
                </div>
                @endforeach
                @endif
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 well well-sm text-center">
    <form class="form-inline" id="add_comment" method="POST" action="/threads/{{$t->content_hash}}/comment/add">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="pid" value="0">
      <div class="form-group">
        <textarea class="form-control" name="body" id="commentbody" placeholder="Add a comment!"></textarea>
      </div>
      <button type="submit" class="btn btn-default">Post</button>
    </form>
    </div>

    <div class="col-xs-12 col-sm-10 col-sm-offset-1">

      @foreach ($t->comments as $comment)

           <div class="panel panel-default"> <div class="panel-body"> <div class="media"> <div class="media-left"> <a href="/user/{{$comment->user->name}}"> <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG21sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PGRlZnMvPjxyZWN0IHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjE0LjUiIHk9IjMyIiBzdHlsZT0iZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQ7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NjR4NjQ8L3RleHQ+PC9nPjwvc3ZnPg==" data-holder-rendered="true" style="width: 64px; height: 64px;"> <small>&#64;{{$comment->user->name}}</small> </a> 
           </div>
           <div class="media-body"> 
            <div class=""><a href="/threads/comment/hash/{{$comment->hash}}" class="h4 media-heading">{{$comment->user->name}}</a> 
           <div style="display:inline-block;float:right;font-size:12px;"> <span> <time class="timeago" datetime="{{$t->created_at}}"></time> | 100 views | </span> 
            <span style="color:#ccc;"> hash:<a href="/threads/hash/{{$t->content_hash}}/comment/{{$comment->hash}}">
              {{$comment->hash}}</a> 
            </span> 
          </div>
        </div>
        {{substr($comment->body, 0, 140)}}</div></div></div></div>

      @endforeach

    </div>

  </div>
</div>

@endsection