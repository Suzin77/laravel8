<h3><a href="{{ route('posts.show', ['post' => $post->id]) }}">{{$post->title}}</a></h3>

<p>Added {{ $post->created_at->diffForHumans() }}   by: {{$post->user->name}}</p>
@if ($post->comments_count)
    <p> Comments: {{$post->comments_count}}</p>
@else
    <p>No comments yet</p>
@endif

{{--<p>{{$post->content}}</p>--}}
<div class="mb-3">
@can('update', $post)
    <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary" >Edit</a>
    @endcan
    @can('delete', $post)
    <form class="d-inline" action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <input class="btn btn-danger" type="submit" value="Delete">
    </form>
    @endcan
</div>
