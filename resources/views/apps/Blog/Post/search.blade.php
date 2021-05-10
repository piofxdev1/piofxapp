<x-dynamic-component :component="$app->componentName">

    <div class="space-top-2">
        <div class="container d-md-flex  mt-5 text-center">
            <div class="w-lg-85 mx-lg-auto">
                <!-- Info -->
                <div class="mt-7">
                    <h1 class="text-dark mb-3">Search for Posts</h1>
                </div>
                <!-- End Info -->
                <!-- Form -->
                <form action="" class="mx-lg-auto" method="GET">
                    <div class="card p-3 border rounded-lg">
                        <div class="form-row input-group-borderless">
                            <div class="col-sm mb-2 mb-md-0">
                                <input type="text" class="form-control shadow-none" name="query"
                                    placeholder="Search Something...">
                            </div>
                            <div class="col-sm d-sm-none">
                                <hr class="my-0">
                            </div>
                            <div class="col-md-auto d-flex align-items-center">
                                <button type="submit" class="btn btn-block btn-outline-primary btn-wide">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- End Form -->
            </div>
        </div>
    </div>
    
    <!-- Results Section -->
    <div class="container space-1">
        <h3 class="text-secondary m-0 p-0">Found <span class="text-primary">{{ $objs->total() }}</span> Matching Posts</h3>
        <div class="row mx-n2 mx-lg-n3">
            @if($objs->isNotEmpty())
                @foreach($objs as $obj)
                <div class="col-sm-6 col-lg-4 px-2 px-lg-3 py-3 rounded-lg">
                    <!-- Card -->
                    <div class="card flex-wrap flex-row text-dark">
                        <div>
                            @if(!empty($obj->image) && strlen($obj->image) > 5)
                                @if(Storage::disk('s3')->exists($obj->image))
                                    <figure class="max-w-37rem w-100">
                                        <img class="img-fluid rounded" src="{{ Storage::disk('s3')->url($obj->image) }}"
                                            alt="Image Description">
                                    </figure>
                                @endif
                            @endif
                            <div class="p-3">
                                <span class="d-block mb-2">
                                    <a class="font-weight-bold text-decoration-none text-primary" href="{{ route('Category.show', $obj->category->slug) }}">{{ $obj->category->name }}</a>
                                </span>
                                <h3>{{$obj->title}}</h3>
                                <p>{{$obj->excerpt}}</p>
                                <div class="mb-3">
                                    @foreach($obj->tags as $tag)
                                        <a href="{{ route('Tag.show', $tag->slug) }}" class="badge rounded-badge bg-soft-primary px-2 py-1">{{ $tag->name }}</a>
                                    @endforeach
                                </div>
                                <a href="{{ route($app->module.'.show', $obj->slug) }}" class="btn btn-sm btn-primary">Continue Reading</a>
                            </div>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
                @endforeach
            @else
                <div class="container text-center p-3 my-5 bg-soft-danger">
                    <h3 class="text-danger">No posts Available</h3>
                </div>
            @endif
        </div>

        <div class="mt-3">
            {{ $objs->links() }}
        </div>
    
    </div>

    <!-- End Results Section -->



</x-dynamic-component>