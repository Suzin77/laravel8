@if($posts->image)
    <div style="background-image: url('{{$posts->image->url()}}'); min-height: 500px; color: white; text-align: center; background-attachment: fixed ">
        <h3 style="padding-top: 100px; text-shadow: 1px 2px black">
            {{ $posts->title }}
            @badge(['show' => now()->diffInMinutes($posts->created_at) < 20])
            This is a new post!
            @endbadge
        </h3>
    </div>
@else
    <h3>
        {{ $posts->title }}
        @badge(['show' => now()->diffInMinutes($posts->created_at) < 20])
        This is a new post!
        @endbadge
    </h3>

@endif
