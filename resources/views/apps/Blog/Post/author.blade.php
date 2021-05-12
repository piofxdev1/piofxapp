<x-dynamic-component :component="$app->componentName"> 

    <div class="space-top-3 bg-light text-center">
        <div class="py-5">
            <div class="d-flex align-items-center justify-content-center">
                @if($author->image)
                    <div class="avatar avatar-circle avatar-xl">
                        <img class="avatar-img" src="{{ url('/').'/storage/'.$author->image }}" alt="Image Description">
                    </div>
                @else
                    <div class="avatar avatar-circle avatar-xl bg-soft-primary text-primary d-flex align-items-center justify-content-center">
                        <h1 class="m-0 p-0">{{ strtoupper($author->name[0]) }}</h1>
                    </div>
                @endif
            </div>
            <h3 class="m-0 mt-3">{{ $author->name }}</h3>
            <p class="text-muted m-0">{{ $objs->total() }} Posts</p>
        </div>
    </div>

   <div class="container mt-5">
        <!-- Title -->
            <h2 class="text-center mt-5 mb-3">Blog Posts</h2>
        <!-- End Title -->
        <div class="row mx-n2 mb-5 mb-md-9">
            @foreach($objs as $obj)
                <div class="col-sm-6 col-lg-3 px-2 mb-3 mb-lg-0 mt-3">
                    <!-- Card -->
                    <a class="card transition-3d-hover bg-soft-primary rounded-lg" href="{{ route($app->module.'.show', $obj->slug) }}">
                        @if(!empty($obj->image) && strlen($obj->image) > 5)
                            @if(Storage::disk('s3')->exists($obj->image))
                                <img class="card-img-top rounded"    src="{{ Storage::disk('s3')->url($obj->image) }}" alt="Image Description">
                            @endif
                        @endif
                        <div class="card-body">
                            <span class="d-block small font-weight-bold text-cap mb-2">{{ $obj->category->name }}</span>
                            <h5 class="mb-0">{{ $obj->title }}</h5>
                            @if(!$obj->image)
                                <p class="mt-3 text-muted">{{ $obj->excerpt }}</p>
                            @endif
                        </div>
                    </a>
                    <!-- End Card -->
                </div>
            @endforeach
        </div>
        {{ $objs->links() }}
   </div>

</x-dynamic-component>