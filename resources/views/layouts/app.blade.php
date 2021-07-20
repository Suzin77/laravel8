<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
    <title>Laravale app @yield('title')</title>
</head>
<body>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-3 bg-white border-bottom shadow-sm mb-3">
        <h5 class="my-0 mr-md-auto font-weight-normal">Laravel App</h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="{{ route('home.index') }}">Home</a>
            <a class="p-2 text-dark" href="{{ route('home.contact') }}">Contact</a>
            <a class="p-2 text-dark" href="{{ route('posts.index') }}">Blog Posts</a>
            <a class="p-2 text-dark" href="{{ route('posts.create') }}">Add blog post</a>
        </nav>
    </div>
    <div class="container">
            @if(session('status'))
                <div class="alert alert-success">
                    {{session('status')}}
                </div>
            @endif
            @yield('content')
    </div>
</body>
</html>
