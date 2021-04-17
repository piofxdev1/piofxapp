<x-dynamic-component :component="$app->componentName">
  <div class="container my-5 p-5 bg-white rounded-lg shadow-sm">
    @if($stub == "create")
    <form method="POST" action="{{ route($app->module.'.store') }}">
    @else
    <form method="POST" action="{{ route($app->module.'.update', $obj->id) }}">
    @endif
      @csrf
      <h2 class="text-center font-weight-bold py-2">Create a Category</h2>
      <div class="my-3">
        <h5>Name:</h5>
        <input class="form-control" name="name" id="title" onkeyup="createSlug()" type="text" value="@if($stub == 'update'){{ $obj ? $obj->name : '' }}@endif">
        <h5 class="mt-3">Slug:</h5>
        <input class="form-control" name="slug" id="slug" type="text" value="@if($stub == 'update'){{ $obj ? $obj->slug : '' }}@endif">
        <h5 class="mt-3">Description:</h5> 
        <input class="form-control" type="text" name="description" value="@if($stub == 'update'){{ $obj ? $obj->description : '' }}@endif">
        <!-- Dropzone -->
        <div class="border rounded-lg p-5 my-5 bg-white">
            <h3 class="d-flex align-items-center mb-5">Featured Image</h3>
            <div id="featured_image">
                <img src="{{ url('/').'/storage/'.$obj->image }}" class="img-fluid w-50 d-block mb-3">
                <button type="button" class="btn btn-danger" id="delete_image" onclick="delete_image()">Delete</button>
            </div>
            <div id="dropzone">
                <div class="card card-custom m-0 gutter-b">
                    <form method="POST" action="{{ url()->current() }}">
                        <div class="dropzone dropzone-default bg-light" id="kt_dropzone_1">
                            <div class="dropzone-msg dz-message needsclick">
                                <img src="{{ asset('img/upload.png') }}" class="img-fluid w-50">
                                <h3 class="dropzone-msg-title">Drop files here or click to upload.</h3>
                            </div>
                        </div>
                        <input type="hidden" id="dropzone_url" value="{{ url('/') }}/admin/dropzone">
                        <input type="hidden" class="_token" name="_token" value="{{ csrf_token() }}">
                    </form>
                </div>
            </div>
            <input type="hidden" id="image_url" name="image" value="@if($stub == 'update'){{$obj ? $obj->image : ''}}@endif">
        </div>
        <!-- End Dropzone -->
        @if($stub=='update')
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="id" value="{{ $obj->id }}">
            <button type="submit" class="btn btn-primary mt-3">Update</button>
        @else
            <button type="submit" class="btn btn-primary mt-3">Create</button>
        @endif
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
      </div>
    </form>
  </div>
</x-dynamic-component>