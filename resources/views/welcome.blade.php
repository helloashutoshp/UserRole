<!DOCTYPE html>
<html>
<head>
    <title>All Posts</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">All Posts</h2>

        @if($posts->isNotEmpty())
            @foreach($posts as $post)
                <div class="card mb-3">
                    <div class="card-header">
                        <h5>{{ $post->heading }}</h5>
                    </div>
                    <div class="card-body">
                        {!! $post->description !!}
                    </div>
                </div>
            @endforeach
        @else
            <p>No posts found.</p>
        @endif
    </div>
</body>
</html>
