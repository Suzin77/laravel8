 <div class="mb-2 mt-2">
            @auth
                <form action="{{ route('posts.comments.store', ['post' => $posts->id]) }}" method="POST">
                    @csrf
                    @include('comments.partials.form')
                    <div>
                        <input class="btn btn-primary btn-block" type="submit" value="Create">
                    </div>
                    @csrf
                </form>
            @else
                <a href="{{route('login')}}">Please login first</a>
            @endauth
 </div>
 <hr/>
