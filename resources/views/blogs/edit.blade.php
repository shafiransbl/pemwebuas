@extends('layouts.app')

@section('content')
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog')</title>
    @vite(['resources/css/edit-create.css'])
</head>
<body>
    <div class="container">
        <div class="judul">
            <h1>Edit Blog</h1>
        </div>
        
        <form action="{{ route('blogs.update', $blog) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $blog->title }}" required>
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea name="content" id="content" class="form-control" required>{{ $blog->content }}</textarea>
            </div>
            <div class="form-group">
                <label for="image">Image (optional):</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Update Blog</button>
        </form>
    </div>
</body>
@endsection
