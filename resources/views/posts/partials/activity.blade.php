<div class="container">
    <div class="row">
        {{--        Komponent karty --}}
        @card([
        'title' => 'Users card titile',
        'subtitle' => 'Subtitle'
        ])
        @slot('items', collect($mostActiveUsers)->pluck('name'))
        @endcard

        @card([
        'title' => 'Most commented posts',
        'subtitle' => 'Subtitle'
        ])
        @slot('items', collect($mostActiveUsers)->pluck('name'))
        @endcard

        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Most Popular Posts</h5>
                <h6 class="card-subtitle mb-2 text-muted">What's the fuzz ?</h6>
            </div>
            <ul class="list-group list-group-flush">
                @foreach($mostCommented as $post)
                    <li class="list-group-item">
                        <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                            {{ substr($post->title, 0, 30) }} ...
                        </a>
                        ({{$post->comments_count}})
                    </li>
                @endforeach
            </ul>
        </div>

        @card([
        'title' => 'Users card titile',
        'subtitle' => 'Subtitle'
        ])
        @slot('items', collect($mostActiveLastMonth)->pluck('name'))
        @endcard

        {{--                    <div class="card mt-4" style="width: 18rem;">--}}
        {{--                        <div class="card-body">--}}
        {{--                            <h5 class="card-title">Last month</h5>--}}
        {{--                            <h6 class="card-subtitle mb-2 text-muted">What's the fuzz ?</h6>--}}
        {{--                        </div>--}}
        {{--                        <ul class="list-group list-group-flush">--}}
        {{--                            @foreach($mostActiveLastMonth as $user)--}}
        {{--                                <li class="list-group-item">--}}
        {{--                                    {{$user->name}}--}}
        {{--                                    ({{$user->blog_posts_count}})--}}
        {{--                                </li>--}}
        {{--                            @endforeach--}}
        {{--                        </ul>--}}
        {{--                    </div>--}}
    </div>
</div>
