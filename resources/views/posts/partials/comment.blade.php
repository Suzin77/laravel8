<div class="comments">
    <ul>
        @foreach($posts->comments as $comment)
            <p>{{$comment->content}}</p>
        @endforeach
    </ul>
</div>
