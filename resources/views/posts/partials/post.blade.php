@if($post->trashed())
    <p class="alert-danger"> Post was soft deleted</p>
@endif
<h3>
    <a class="{{$post->trashed() ? "text-muted" : ""}}" href="{{ route('posts.show', ['post' => $post->id]) }}">{{$post->title}}</a>
</h3>

@updated([
    'date' => $post->created_at,
    'name' => $post->user->name
])
    Dodano
@endupdated

@tag(['tags' => $post->tags])@endtag

@if ($post->comments_count)
    <p> Comments: {{$post->comments_count}}</p>
@else
    <p>No comments yet</p>
@endif

{{--<p>{{$post->content}}</p>--}}
@auth
<div class="mb-3">
    @can('update', $post)
        <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary" >Edit</a>
    @endcan
    @if(!$post->trashed())
        @can('delete', $post)
            <form class="d-inline" action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <input class="btn btn-danger" type="submit" value="Delete">
            </form>
        @endcan
    @endif
</div>
@endauth
