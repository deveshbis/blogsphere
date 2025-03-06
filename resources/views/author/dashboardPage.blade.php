@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Author Dashboard Page</h1>
    <p>Welcome, {{ Auth::user()->name }}!</p>

    <div class="mb-3">
        <a href="{{ route('author.createBlogPost') }}" class="btn btn-primary">Create New Blog Post</a>
    </div>

    <h2>Your Blog Posts</h2>
    @if($posts->count() > 0)
        <ul>
            @foreach($posts as $post)
                <li>
                    <a href="{{ route('author.posts.edit', $post->id) }}">{{ $post->title }}</a>
                    <form action="{{ route('author.posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <p>No blog posts found.</p>
    @endif
</div>
@endsection
