<div class="form-group">
    <label for="content">Content</label>
    <textarea class="form-control" id="content" name="content" id="" cols="30" rows="5">{{ old('content', optional($comment ?? '')->content) }}</textarea>
</div>

@myerrors
@endmyerrors

