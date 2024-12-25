@extends('layouts.app')

@section('content')
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog')</title>
    
    @vite(['resources/css/show.css'])
</head>
<body>
<div class="container">
    <div class="judul">
        <h1>{{ $blog->title }}</h1>
        
    </div>
    <div class="isi">
        <hr>
        <br>
        @if($blog->image)
            <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" style="max-width: 100%;">
        @endif
        <p>{{ $blog->content }}</p>
    </div>   
    <div class="makecoment">
        <hr>
        <h3>Leave a Comment</h3>
        <form action="{{ route('comments.store', $blog) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="author_name">Your Name:</label>
                <input type="text" name="author_name" id="author_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="comment">Your Comment:</label>
                <textarea name="comment" id="comment" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Post Comment</button>
        </form>
        <hr>
    </div>
    <div class="coment">
    <h3>Comments</h3>
        @foreach($blog->comments as $comment)
        <div class="mb-2">
            <strong>{{ $comment->author_name }}</strong>
            <p>{{ $comment->comment }}</p>
            <small>{{ $comment->created_at->diffForHumans() }}</small>
        </div>
        @endforeach
    </div>
</div>
</body>
@endsection
