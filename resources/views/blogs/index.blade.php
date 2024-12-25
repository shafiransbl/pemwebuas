@extends('layouts.app')

@section('content')
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    
    @vite(['resources/css/index.css'])
</head>
<body>
<div class="container">
    <div class="judul">
        <h1>KABAR UNTIRTA</h1>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif


        <!-- Form Pencarian -->
        <form action="{{ route('blogs.index') }}" method="GET" class="mb-3">
            <input type="text" name="search" placeholder="Search blogs..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
        @auth
            @if (auth()->user()->role === 'admin')
                <a href="{{ route('blogs.create') }}" class="btn btn-primary mb-3">Create New Blog</a>
            @endif
        @endauth
    </div>

    <div class="isi">
        @if($blogs->isEmpty())
            <p>No blogs found.</p>
        @else
            <ul>
                @foreach($blogs as $blog)
                    <li>
                        <h2><a href="{{ route('blogs.show', $blog) }}">{{ $blog->title }}</a></h2>
                        <p>{{ Str::limit($blog->content, 100) }}</p>

                        @auth
                            @if (auth()->user()->role === 'admin')
                                <a href="{{ route('blogs.edit', $blog) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('blogs.destroy', $blog) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @endif
                        @endauth
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
</body>
@endsection
