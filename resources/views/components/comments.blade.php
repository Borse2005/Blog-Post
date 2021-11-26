<div class="form-group mb-0">
    <form action="{{ route($post, $id) }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-5">
                <input type="text" name="content" class="form-control @error('content') is-invalid @enderror mt-2 ml-3">
            </div>
            
            <div class="col-md-7">
                <input type="submit"  value="Add Comment" class="btn btn-success mt-2">
            </div>
        </div>
    </form>
</div>
<div class="text-danger mt-0 ml-3 font-weight-bold" >
    @error('content')
        {{ $message }}
    @enderror
</div>