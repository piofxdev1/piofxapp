<x-dynamic-component :component="$app->componentName">

    <div class="container">

        <!-- Ad -->
        <div class="my-3">
            @if($settings->ads)
                @foreach($settings->ads as $ad)
                    @if($ad->position == 'before-body')
                        {!! $ad->content !!}
                    @endif
                @endforeach
            @endif
        </div>
        <!-- End Ad Section -->

        <!-- Hero Section -->
        <div class=" mt-3">
            <div class="row">
                @if($featured->count() > 3)
                    <div class="col-12 col-lg-8">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($featured as $k => $f)
                                    @if($k != 1 && $k != 2)
                                        <div class="carousel-item @if($k ==0) active @endif">             
                                            @if(!empty($f->image) && strlen($f->image) > 5 && Storage::disk('s3')->exists($f->image))
                                                <article class="card mb-3 mb-sm-5">
                                                    <div style="max-height: 30rem; overflow: hidden;">
                                                        <img class="card-img-top" src="{{ Storage::disk('s3')->url($f->image) }}" alt="Image Description">
                                                    </div>
                                                    <div class="card-body p-3 p-md-4">
                                                        @if($f->category)
                                                            <span class="d-block mb-2  mt-lg-0">
                                                                <a class="font-weight-bold text-decoration-none text-primary " href="{{ route('Category.show', $f->category->slug) }}">{{ $f->category->name }}</a>
                                                            </span>
                                                        @endif
                                                        <h3><a class="text-decoration-none text-dark" href="{{ route($app->module.'.show', $f->slug) }}">{{$f->title}}</a></h3>

                                                        @if($f->excerpt)
                                                            <p>{!! substr($f->excerpt, 0, 200) !!}...</p>
                                                        @else
                                                            @php
                                                                $content = strip_tags($f->content);
                                                                $content = substr($content, 0 , 200);
                                                            @endphp
                                                            <p>{{ $content }}...</p>
                                                        @endif
                                                        <div>
                                                            <a href="{{ route($app->module.'.show', $f->slug) }}" class="btn btn-sm btn-primary">@if($settings->language == 'telugu') మరింత సమాచారం @else Continue Reading @endif</a>
                                                        </div>
                                                    </div>
                                                </article>
                                            @else
                                                <article class="card mb-3 mb-sm-5">
                                                    <div class="card-body p-3 p-md-4">
                                                        <a class="d-block small font-weight-bold text-cap mb-2" href="#">Business</a>

                                                        <h2 class="h3"><a class="text-inherit" href="#">Should Product Owners think like entrepreneurs?</a></h2>

                                                        @if($f->excerpt && strlen($f->excerpt) < 1500 )
                                                            <p>{!! substr($f->excerpt, 0, 1500) !!}...</p>
                                                        @else
                                                            @php
                                                                $content = strip_tags($f->content);
                                                                $content = substr($content, 0 , 1500);
                                                            @endphp
                                                            <p>{{ $content }}...</p>
                                                        @endif
                                                        <div class="mb-3">
                                                            @if($f->tags)
                                                            @foreach($f->tags as $tag)
                                                                <a href="{{ route('Tag.show', $tag->slug) }}" class="badge rounded-badge bg-soft-primary px-2 py-1">{{ $tag->name }}</a>
                                                            @endforeach
                                                            @endif
                                                        </div>
                                                        <a href="{{ route($app->module.'.show', $f->slug) }}" class="btn btn-sm btn-primary">@if($settings->language == 'telugu') మరింత సమాచారం @else Continue Reading @endif</a>
                                                    </div>
                                                </article>
                                            @endif
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" style="height: 1rem;top:20rem" role="button" data-slide="prev">
                                <i class="fa fa-angle-left fa-2x text-dark"></i>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" style="height: 1rem;top: 20rem" role="button" data-slide="next">
                                <i class="fa fa-angle-right fa-2x text-dark"></i>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                    </div>
                    <div class="col-12 col-lg-4 pl-lg-0">
                        @foreach($featured as $k => $f)
                            @if($k == 1 || $k == 2)
                                <article class="card mb-3 mb-sm-5">
                                        @if(!empty($f->image) && strlen($f->image) > 5 && Storage::disk('s3')->exists($f->image))
                                        <div style="max-height: 13.5rem;overflow: hidden;">
                                            <img class="card-img-top" src="{{ Storage::disk('s3')->url($f->image) }}" alt="Image Description">
                                        </div>
                                    @endif

                                    <div class="card-body p-3 p-md-4">
                                        @if($f->category)
                                            <span class="d-block mb-2 mt-3 mt-lg-0">
                                                <a class="font-weight-bold text-decoration-none text-primary " href="{{ route('Category.show', $f->category->slug) }}">{{ $f->category->name }}</a>
                                            </span>
                                        @endif
                                        <h5><a class="text-decoration-none text-dark" href="{{ route($app->module.'.show', $f->slug) }}">{{$f->title}}</a></h5>
                                    </div>
                                </article>
                            @endif 
                        @endforeach 
                    </div>
                @else
                    <div class="col-12 col-lg-8">
                        @foreach($featured as $k => $f)
                            @if($k == 0)
                                @if(!empty($f->image) && strlen($f->image) > 5 && Storage::disk('s3')->exists($f->image))
                                    <article class="card mb-3 mb-sm-5">
                                        <div style="max-height: 30rem; overflow: hidden;">
                                            <img class="card-img-top" src="{{ Storage::disk('s3')->url($f->image) }}" alt="Image Description">
                                        </div>
                                        <div class="card-body p-3 p-md-4">
                                            @if($f->category)
                                                <span class="d-block mb-2 mt-3 mt-lg-0">
                                                    <a class="font-weight-bold text-decoration-none text-primary " href="{{ route('Category.show', $f->category->slug) }}">{{ $f->category->name }}</a>
                                                </span>
                                            @endif
                                            <h3><a class="text-decoration-none text-dark" href="{{ route($app->module.'.show', $f->slug) }}">{{$f->title}}</a></h3>

                                            @if($f->excerpt)
                                                <p>{!! substr($f->excerpt, 0, 200) !!}...</p>
                                            @else
                                                @php
                                                    $content = strip_tags($f->content);
                                                    $content = substr($content, 0 , 200);
                                                @endphp
                                                <p>{{ $content }}...</p>
                                            @endif
                                            <div>
                                                <a href="{{ route($app->module.'.show', $f->slug) }}" class="btn btn-sm btn-primary">@if($settings->language == 'telugu') మరింత సమాచారం @else Continue Reading @endif</a>
                                            </div>
                                        </div>
                                    </article>
                                @else
                                    <article class="card mb-3 mb-sm-5">
                                        <div class="card-body p-3 p-md-4">
                                            <a class="d-block small font-weight-bold text-cap mb-2" href="#">Business</a>

                                            <h2 class="h3"><a class="text-inherit" href="#">Should Product Owners think like entrepreneurs?</a></h2>

                                            @if($f->excerpt && strlen($f->excerpt) < 1500 )
                                                <p>{!! substr($f->excerpt, 0, 1500) !!}...</p>
                                            @else
                                                @php
                                                    $content = strip_tags($f->content);
                                                    $content = substr($content, 0 , 1500);
                                                @endphp
                                                <p>{{ $content }}...</p>
                                            @endif
                                            <div class="mb-3">
                                                @if($f->tags)
                                                @foreach($f->tags as $tag)
                                                    <a href="{{ route('Tag.show', $tag->slug) }}" class="badge rounded-badge bg-soft-primary px-2 py-1">{{ $tag->name }}</a>
                                                @endforeach
                                                @endif
                                            </div>
                                            <a href="{{ route($app->module.'.show', $f->slug) }}" class="btn btn-sm btn-primary">@if($settings->language == 'telugu') మరింత సమాచారం @else Continue Reading @endif</a>
                                        </div>
                                    </article>
                                @endif
                            @endif
                        @endforeach
                    </div>
                    <div class="col-12 col-lg-4 pl-lg-0">
                        @foreach($featured as $k => $f)
                            @if($k == 1 || $k == 2)
                                <article class="card mb-3 mb-sm-5">
                                        @if(!empty($f->image) && strlen($f->image) > 5 && Storage::disk('s3')->exists($f->image))
                                        <div style="max-height: 13.5rem;overflow: hidden;">
                                            <img class="card-img-top" src="{{ Storage::disk('s3')->url($f->image) }}" alt="Image Description">
                                        </div>
                                    @endif

                                    <div class="card-body p-3 p-md-4">
                                        @if($f->category)
                                            <span class="d-block mb-2 mt-3 mt-lg-0">
                                                <a class="font-weight-bold text-decoration-none text-primary " href="{{ route('Category.show', $f->category->slug) }}">{{ $f->category->name }}</a>
                                            </span>
                                        @endif
                                        <h5><a class="text-decoration-none text-dark" href="{{ route($app->module.'.show', $f->slug) }}">{{$f->title}}</a></h5>
                                    </div>
                                </article>
                            @endif 
                        @endforeach 
                    </div>
                @endif
            </div>  
        </div>    
        <!-- End Hero Section -->
    
        <!-- Blogs Section -->
        <div class="my-3">
            <div class="row justify-content-lg-between @if($featured->count() > 0) {{ '' }} @else {{ 'mt-5' }} @endif">
                <div class="col-12 col-lg-8"> 
                    <!-- Ad -->
                    <div class="mb-3">
                        @if($settings->ads)
                            @foreach($settings->ads as $ad)
                                @if($ad->position == 'before-content')
                                    {!! $ad->content !!}
                                @endif
                            @endforeach
                        @endif
                    </div>
                    <!-- End Ad Section -->  

                    @foreach($categories as $category)
                        @if($category->posts->count() > 1)
                            <div class="mb-3">
                                <div class="mb-3 bg-soft-primary p-3 d-flex justify-content-between align-items-center rounded-lg">
                                    <h5 class="p-0 m-0">{{ $category->name }}</h5>
                                    <a href="{{ route('Category.show', $category->slug) }}">@if($settings->language == "telugu" ) ఇంకా @else View all @endif &rarr;</a>
                                </div>
                                <div class="row">
                                    @foreach($category->posts->take(4) as $k => $obj)
                                        @if($obj->status != 0)
                                            <div class="col-6 col-lg-4 mb-3 @if($k == 1 || $k == 3) pl-0 @endif @if($k == 3) d-lg-none @endif">
                                                @if(!empty($obj->image) && strlen($obj->image) > 5 && Storage::disk('s3')->exists($obj->image))
                                                    <!-- Card -->
                                                    <div class="card transition-3d-hover">
                                                        <img class="card-img-top" src="{{ Storage::disk('s3')->url($obj->image) }}" alt="Image Description">
                                                        <div class="card-body p-3 p-md-4">
                                                            <h5 class=""><a class="text-decoration-none text-dark" href="{{ route($app->module.'.show', $obj->slug) }}">{{$obj->title}}</a></h5>
                                                            <div class="mb-3">
                                                                @if($obj->tags)
                                                                    @foreach($obj->tags as $tag)
                                                                        <a href="{{ route('Tag.show', $tag->slug) }}" class="badge rounded-badge bg-soft-primary px-2 py-1">{{ $tag->name }}</a>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Card -->
                                                @else
                                                    <!-- Card -->
                                                    <div class="card transition-3d-hover bg-soft-info" href="#">
                                                        <div class="card-body p-3 p-md-4">
                                                            <h4 class="mb-0"><a href="{{ route($app->module.'.show', $obj->slug) }}" class="text-dark">{{ $obj->title }}</a></h4>
                                                            @if($f->excerpt)
                                                                <p>{!! substr($f->excerpt, 0, 100) !!}...</p>
                                                            @else
                                                                @php
                                                                    $content = strip_tags($f->content);
                                                                    $content = substr($content, 0 , 100);
                                                                @endphp
                                                                <p>{{ $content }}...</p>
                                                            @endif
                                                            <div class="mb-3">
                                                                @if($obj->tags)
                                                                    @foreach($obj->tags as $tag)
                                                                        <a href="{{ route('Tag.show', $tag->slug) }}" class="badge rounded-badge bg-soft-primary px-2 py-1">{{ $tag->name }}</a>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Card -->
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                    
                    <!-- Ad -->
                    <div class="my-3">
                        @if($settings->ads)
                            @foreach($settings->ads as $ad)
                                @if($ad->position == 'after-content')
                                    {!! $ad->content !!}
                                @endif
                            @endforeach
                        @endif
                    </div>
                    <!-- End Ad Section -->
                </div>

                <!-- Right Section -->
                <div class="col-12 col-lg-4 ">
                    <div class="mb-3">
                        <!-- Search Form -->
                        <form action="{{ route($app->module.'.search') }}" method="GET">
                            <div class="input-group mb-3"> 
                            <input type="text" class="form-control input-text" placeholder="@if($settings->language == 'telugu') వెతకండి @else Search @endif..." name="query">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary btn-md" type="submit">
                                <i class="fa fa-search"></i>
                                </button>
                            </div>
                            </div>
                        </form>
                        <!-- End Search Form -->
                    </div>

                    <!-- Ad -->
                    <div class="my-3">
                        @if($settings->ads)
                            @foreach($settings->ads as $ad)
                                @if($ad->position == 'sidebar-top')
                                    {!! $ad->content !!}
                                @endif
                            @endforeach
                        @endif
                    </div>
                    <!-- End Ad Section -->

                    <!----- Tags section------>
                    <div class="my-3">
                        <h3 class="font-weight-bold mb-3">@if($settings->language == 'telugu') టాగ్లు @else Tags @endif</h3>
                        @foreach($tags as $tag)
                            <a class="btn btn-sm btn-outline-dark mb-1" href="{{ route('Tag.show', $tag->slug) }}">{{ $tag->name }}</a>
                        @endforeach
                    </div>
                    <!----- End Tags Section------>

                    <div class="my-3">
                        <h3 class="my-3">@if($settings->language == 'telugu') ముఖ్య విశేషాలు @else Popular Posts @endif</h3>
                        <!-- Popular Posts -->
                        @foreach($popular as $post)     
                            @if($post->status)
                                @if(!empty($post->image) && strlen($post->image) > 5)
                                    @if(Storage::disk('s3')->exists($post->image))
                                        <!-- Related Post -->
                                        <div class="bg-soft-danger p-3 rounded-lg mb-3">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="col-4">
                                                    <img class="img-fluid rounded-lg" src="{{ Storage::disk('s3')->url($post->image) }}" alt="Image Description">
                                                </div>
                                                <div class="col-8 pl-0">
                                                    <h6 class="mb-0"><a class="text-decoration-none text-dark" href="{{ route($app->module.'.show', $post->slug) }}">{{ $post->title }}</a></h6>
                                                    <p class="text-muted m-0">{{ $post->created_at ? $post->created_at->diffForHumans() : "" }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Related Post -->
                                    @endif
                                @else
                                    <div class="bg-soft-danger p-3 rounded-lg mb-3">
                                        <h5 class="mb-0"><a class="text-decoration-none text-dark" href="{{ route($app->module.'.show', $post->slug) }}">{{ $post->title }}</a></h5>
                                        @if($post->excerpt)
                                            <p>{!! substr($post->excerpt, 0, 50) !!}...</p>
                                        @else
                                            @php
                                                $content = strip_tags($post->content);
                                                $content = substr($content, 0 , 50);
                                            @endphp
                                            <p>{{ $content }}...</p>
                                        @endif
                                    </div>
                                @endif
                            @endif
                        @endforeach
                        <!-- End Popular Posts -->

                        <!-- Ad -->
                        <div class="my-3">
                            @if($settings->ads)
                                @foreach($settings->ads as $ad)
                                    @if($ad->position == 'sidebar-bottom')
                                        {!! $ad->content !!}
                                    @endif
                                @endforeach
                            @endif
                        </div>
                        <!-- End Ad Section -->
                    </div>

                </div>
            </div>
            <!-- End of Row -->
            
            <!-- Ad -->
            <div class="my-3">
                @if($settings->ads)
                    @foreach($settings->ads as $ad)
                        @if($ad->position == 'after-body')
                            {!! $ad->content !!}
                        @endif
                    @endforeach
                @endif
            </div>
            <!-- End Ad Section -->
        </div>
        <!-- End Blogs Section -->
    </div>

</x-dynamic-component>