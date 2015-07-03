@extends('app')

@section('extra_css')
<link rel="stylesheet" type="text/css" href="/css/bootstrap-tagsinput.css">
@endsection
@section('extra_js')
<script src="/js/bootstrap-tagsinput.js"></script>
@endsection

@section('content')

    <div class="container">
        <div class="row">

            <div class="col-xs-12">
                <div class="page-header"> <h2>Create new thread</h2> </div>
                @if($errors->has())
                @foreach ($errors->all() as $error)
                <div class="alert alert-info">
                <p class="alert-text lead">{{ $error }}</p>
                </div>
                @endforeach
                @endif
            </div>
            <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                <form method="POST" action="/threads/new/post">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group">
                    <label for="Title">Title</label>
                    <input type="text" class="form-control" id="Title" placeholder="A thoughtful thread title..." name="title">
                  </div>
                  <div class="form-group">
                    <label for="Body">Body</label>
                    <textarea class="form-control" id="Body" name="body" rows="3"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="Tags">Tags</label>
                    <input class="form-control" placeholder="tags,here" type="text" id="tags" name="tags" data-role="tagsinput">
                  </div>  
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="sign_check"> Sign content with GPG Key
                    </label>
                  </div>
                  <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>

@endsection
