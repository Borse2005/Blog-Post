<div class="form-group row">
    <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

    <div class="col-md-6">
        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', optional($post ?? null)->title) }}" required autocomplete="title" autofocus>
        @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>

    <div class="col-md-6">
        <textarea name="content" id="content" cols="30" rows="3" class="form-control @error('content') is-invalid @enderror" required autocomplete="content">{{ old('content',optional($post ?? null)->content) }}</textarea>

        @error('content')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Thumbnail') }}</label>

    <div class="col-md-6">
        <input id="thumbnail"  type="file" class="form-control-file @error('thumbnail') is-invalid @enderror" name="thumbnail"   autocomplete="title" autofocus>
        @error('thumbnail')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>