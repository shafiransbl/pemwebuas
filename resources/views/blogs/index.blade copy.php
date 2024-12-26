@extends('layouts.app')

@section('content')
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog')</title>
    @auth
        @if (auth()->user()->role === 'admin')
            @vite(['resources/css/indexadmin.css'])
        @else
            @vite(['resources/css/index.css'])
        @endif
    @endauth    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"> 
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
    @auth
        @if (auth()->user()->role === 'admin')
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
        @else
            @vite(['resources/css/index.css'])
            <div class="isi">
                @if($blogs->isEmpty())
                    <p>No blogs found.</p>
                @else
                    <div class="blog-list">
                        @foreach($blogs as $blog)
                        <div class="kabar">
                            @if($loop->first)
                                    <div class="kabar-baru">
                                        <div class="highlight-blog">
                                            <h2><a href="{{ route('blogs.show', $blog) }}">{{ $blog->title }}</a></h2>
                                            <p>{{ Str::limit($blog->content, 150) }}</p>
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
                                        </div>
                                    </div>
                                
                            @elseif($loop->iteration <= 3)
                                <div class="kabar-selanjutnya">
                                    <div class="secondary-blog">
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
                                    <div/>
                                </div>
                            @endif
                        </div>
                        @endforeach
                        <br>
                        @foreach($blogs as $blog)
                            @if($loop->iteration >= 4)
                                <div kabar2>
                                    <div class="default-blog">
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
                                    <div/>
                                </div>
                            @endif
                        @endforeach  
                    <div/>
                @endif
            </div>
        @endif
    @endauth 
</div>
</body>
@endsection
