@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Blog List</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif


    <!-- Form Pencarian -->
    <form action="{{ route('blogs.index') }}" method="GET" class="mb-3">
        <input type="text" name="search" placeholder="Search blogs..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    @auth
        @if (auth()->user()->role === 'admin')
            <a href="{{ route('blogs.create') }}" class="btn btn-primary mb-3">Create New Blog</a>
        @endif
    @endauth
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
@endsection
