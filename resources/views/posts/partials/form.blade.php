<div class="form-group">
    <label for="title">Title</label>
    <input class="form-control" id="title" type="text" name="title" value="{{ old('title', optional($post ?? '')->title) }}">
</div>
<div class="form-group">
    <label for="content">Content</label>
    <textarea class="form-control" id="content" name="content" id="" cols="30" rows="5">{{ old('content', optional($post ?? '')->content) }}</textarea>
</div>

<div class="form-group">
    <label>Thumbnail</label>
    <input type="file" name="thumbnail" class="form-control-file">
</div>

@myerrors
@endmyerrors
