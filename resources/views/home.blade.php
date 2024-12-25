@extends('layouts.app')

@section('content')
    <h1>Daftar Artikel</h1>

    <!-- Menampilkan daftar artikel -->
    <ul>
        @foreach ($blogs as $blog)
            <li>
                <a href="{{ route('blogs.show', $blog->id) }}">
                    {{ $blog->title }}
                </a>
                <!-- Menampilkan cuplikan artikel (misalnya 100 karakter pertama) -->
                <p>{{ Str::limit($blog->content, 100) }}</p>
            </li>
        @endforeach
    </ul>
@endsection
