<x-dynamic-component :component="$app->componentName">

    <!-- Hero Section -->
    @if($settings->home_layout == 'default')
        <div class="position-relative">
            <!-- Main Slider -->
            <div id="heroSlider" class="js-slick-carousel slick" data-hs-slick-carousel-options='{
                "vertical": true,
                "verticalSwiping": true,
                "infinite": true,
                "autoplay": true,
                "autoplaySpeed": 10000,
                "dots": true,
                "dotsClass": "slick-pagination slick-pagination-white slick-pagination-vertical d-lg-none position-absolute bottom-0 right-0 mb-3 mr-3",
                "asNavFor": "#heroSliderNav",
                "responsive": [
                    {
                    "breakpoint": 576,
                    "settings": {
                        "vertical": false,
                        "verticalSwiping": false
                    }
                    }
                ]
                }'>

                @foreach($featured as $f)
                @if($f->status != 0)
                    @if(!empty($f->image) && strlen($f->image) > 5 && Storage::disk('s3')->exists($f->image))
                        <div style="background-image: url({{ Storage::disk('s3')->url($f->image) }}); background-size: cover; backround-position: center; background-repeat: no-repeat;">
                            <div class="js-slide d-flex bg-img-hero min-h-620rem">
                            <!-- News Block -->
                                <div class="container d-flex align-items-center min-h-620rem">
                                    <div class="w-lg-40 mr-5 rounded-lg p-4" style="background: rgba(0, 0, 0, 0.8);">
                                        <!-- Author -->
                                        <div class="media align-items-center mb-3" data-hs-slick-carousel-animation="fadeInUp">
                                            @if($author->image)
                                                <div class="avatar avatar-circle">
                                                    <img class="avatar-img" src="{{ url('/').'/storage/'.$author->image }}" alt="Image Description">
                                                </div>
                                            @else
                                                <div class="avatar avatar-circle bg-white text-dark d-flex align-items-center justify-content-center">
                                                    <h3 class="m-0 p-0">{{ strtoupper($author->name[0]) }}</h3>
                                                </div>
                                            @endif
                                            <div class="media-body ml-2">
                                                <a class="text-white" href="{{ route('Post.author', $author->id) }}">{{ $author->name }}</a>
                                            </div>
                                        </div>
                                        <!-- End Author -->

                                        <div class="mb-5">
                                            <h3 class="font-weight-bold text-danger" data-hs-slick-carousel-animation="fadeInUp"
                                            data-hs-slick-carousel-animation-delay="150">{{ $f->title }}</h3>

                                            @if($f->excerpt)
                                                <p data-hs-slick-carousel-animation="fadeInUp"
                                            data-hs-slick-carousel-animation-delay="150" class="text-light">{!! substr($f->excerpt, 0, 100) !!}...</p>
                                            @else
                                                @php
                                                    $content = strip_tags($f->content);
                                                    $content = substr($content, 0 , 100);
                                                @endphp
                                                <p data-hs-slick-carousel-animation="fadeInUp"
                                            data-hs-slick-carousel-animation-delay="150" class="text-light">{{ $content }}...</p>
                                            @endif                  
                                        </div>
                                        <a class="btn btn-primary btn-sm transition-3d-hover" href="{{ route($app->module.'.show', $f->slug) }}"
                                        data-hs-slick-carousel-animation="fadeInUp" data-hs-slick-carousel-animation-delay="300">Read Article<i
                                        class="fas fa-angle-right fa-sm ml-1"></i></a>
                                    </div>
                                </div>
                                <!-- End News Block -->
                            </div>
                        </div>
                    @else
                        <div class="js-slide bg-dark d-flex bg-img-hero min-h-620rem">
                            <!-- News Block -->
                            <div class="container d-flex align-items-center min-h-620rem">
                                <div class="w-lg-40 mr-5">
                                <!-- Author -->
                                <div class="media align-items-center mb-3" data-hs-slick-carousel-animation="fadeInUp">
                                    @if($author->image)
                                        <div class="avatar avatar-circle">
                                            <img class="avatar-img" src="{{ url('/').'/storage/'.$author->image }}" alt="Image Description">
                                        </div>
                                    @else
                                        <div class="avatar avatar-circle bg-white text-dark d-flex align-items-center justify-content-center">
                                            <h3 class="m-0 p-0">{{ strtoupper($author->name[0]) }}</h3>
                                        </div>
                                    @endif
                                    <div class="media-body ml-2">
                                    <a class="text-white" href="{{ route('Post.author', $author->id) }}">{{ $author->name }}</a>
                                    </div>
                                </div>
                                <!-- End Author -->

                                <div class="mb-5">
                                    <h3 class="font-weight-bold text-danger" data-hs-slick-carousel-animation="fadeInUp"
                                    data-hs-slick-carousel-animation-delay="150">{{ $f->title }}</h3>

                                    @if($f->excerpt)
                                        <p data-hs-slick-carousel-animation="fadeInUp"
                                    data-hs-slick-carousel-animation-delay="150" class="text-light">{!! substr($f->excerpt, 0, 100) !!}...</p>
                                    @else
                                        @php
                                            $content = strip_tags($f->content);
                                            $content = substr($content, 0 , 100);
                                        @endphp
                                        <p data-hs-slick-carousel-animation="fadeInUp"
                                    data-hs-slick-carousel-animation-delay="150" class="text-light">{{ $content }}...</p>
                                    @endif                  </div>
                                <a class="btn btn-primary btn-sm transition-3d-hover" href="{{ route($app->module.'.show', $f->slug) }}"
                                    data-hs-slick-carousel-animation="fadeInUp" data-hs-slick-carousel-animation-delay="300">Read Article<i
                                    class="fas fa-angle-right fa-sm ml-1"></i></a>
                                </div>
                            </div>
                            <!-- End News Block -->
                        </div>
                    @endif
                @endif
                @endforeach
            </div>
            <!-- End Main Slider -->

            <!-- Slider Nav -->
            <div class="container slick-pagination-line-wrapper content-centered-y right-0 left-0">
                <div class="content-centered-y right-0 mr-3">
                    <div id="heroSliderNav" class="js-slick-carousel slick slick-pagination-line max-w-27rem ml-auto"
                        data-hs-slick-carousel-options='{
                        "vertical": true,
                        "verticalSwiping": true,
                        "infinite": true,
                        "autoplay": true,
                        "autoplaySpeed": 10000,
                        "slidesToShow": 3,
                        "isThumbs": true,
                        "asNavFor": "#heroSlider"
                        }'>
                        @foreach($featured as $f)
                            @if($f->status != 0)
                                <div class="js-slide my-1 bg-white rounded-lg p-2">
                                    <span class="text-dark">{{ substr($f->title, 0, 20) }}</span>
                                    <span class="slick-pagination-line-progress bg-dark">
                                        <span class="slick-pagination-line-progress-helper"></span>
                                    </span>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>
            <!-- End Slider Nav -->
        </div>
    @elseif($settings->home_layout == "news")
        <div class="container space-top-3">
            <div class="row">
                <div class="col-12 col-lg-8">
                    @foreach($featured as $k => $f)
                        @if($k == 0)
                            @if(!empty($f->image) && strlen($f->image) > 5 && Storage::disk('s3')->exists($f->image))
                                <article class="card mb-3 mb-sm-5">
                                    <img class="card-img-top" src="{{ Storage::disk('s3')->url($f->image) }}" alt="Image Description">
                                    <div class="card-body">
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
                                            <a href="{{ route($app->module.'.show', $f->slug) }}" class="btn btn-sm btn-primary">Continue Reading</a>
                                        </div>
                                    </div>
                                </article>
                            @else
                                <article class="card mb-3 mb-sm-5">
                                    <div class="card-body">
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
                                        <a href="{{ route($app->module.'.show', $f->slug) }}" class="btn btn-sm btn-primary">Continue Reading</a>
                                    </div>
                                </article>
                            @endif
                        @endif
                    @endforeach
                </div>
                <div class="col-12 col-lg-4">
                    @foreach($featured as $k => $f)
                        @if($k != 0)
                            <article class="card mb-3 mb-sm-5">
                                 @if(!empty($f->image) && strlen($f->image) > 5 && Storage::disk('s3')->exists($f->image))
                                    <div style="max-height: 14rem;overflow: hidden;">
                                        <img class="card-img-top" src="{{ Storage::disk('s3')->url($f->image) }}" alt="Image Description">
                                    </div>
                                @endif

                                <div class="card-body">
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
            </div>  
        </div>    
    @endif
    <!-- End Hero Section -->
    
        <!-- Blogs Section -->
        <div class="container space-1 @if(!($featured->count() > 0)) {{ 'space-top-3' }} @endif">
            <div class="row justify-content-lg-between @if($featured->count() > 0) {{ '' }} @else {{ 'mt-5' }} @endif">
                <div class="col-12 col-lg-9">
                    @if($settings->home_layout == 'default')
                        @foreach($objs as $obj)
                            @if($obj->status != 0)
                                <!-- Blog -->
                                @if(!empty($obj->image) && strlen($obj->image) > 5 && Storage::disk('s3')->exists($obj->image))
                                    <div class="mb-5 p-3 bg-light rounded-lg">
                                        <div class="row">
                                            <div class="col-md-5 d-flex align-items-center">
                                                <img class="img-fluid rounded-lg" src="{{ Storage::disk('s3')->url($obj->image) }}" alt="Image Description">
                                            </div>
                                            <div class="col-md-7">
                                                <div class="card-body d-flex flex-column h-100 p-0">
                                                    @if($obj->category)
                                                        <span class="d-block mb-2 mt-3 mt-lg-0">
                                                            <a class="font-weight-bold text-decoration-none text-primary " href="{{ route('Category.show', $obj->category->slug) }}">{{ $obj->category->name }}</a>
                                                        </span>
                                                    @endif
                                                    <h3><a class="text-decoration-none text-dark" href="{{ route($app->module.'.show', $obj->slug) }}">{{$obj->title}}</a></h3>

                                                    @if($obj->excerpt)
                                                        <p>{!! substr($obj->excerpt, 0, 200) !!}...</p>
                                                    @else
                                                        @php
                                                            $content = strip_tags($obj->content);
                                                            $content = substr($content, 0 , 200);
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
                                                    <div>
                                                        <a href="{{ route($app->module.'.show', $obj->slug) }}" class="btn btn-sm btn-primary">Continue Reading</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="mb-5 p-3 bg-light rounded-lg">
                                        <div class="card-body d-flex flex-column h-100 p-0">
                                            @if($obj->category)
                                                <span class="d-block mb-2">
                                                <a class="font-weight-bold text-decoration-none text-primary" href="{{ route('Category.show', $obj->category->slug) }}">{{ $obj->category->name }}</a>
                                                </span>
                                            @endif
                                            <h3><a class="text-decoration-none text-dark" href="{{ route($app->module.'.show', $obj->slug) }}">{{$obj->title}}</a></h3>
                                            @if($obj->excerpt)
                                                <p>{!! $obj->excerpt !!}...</p>
                                            @else
                                                @php
                                                    $content = strip_tags($obj->content);
                                                    $content = substr($content, 0 , 200);
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
                                            <div>
                                                <a href="{{ route($app->module.'.show', $obj->slug) }}" class="btn btn-sm btn-primary">Continue Reading</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <!-- End Blog -->
                            @endif
                        @endforeach
                    @elseif($settings->home_layout == 'news')
                        <div class="row">
                            @foreach($categories as $category)
                                @if($category->posts->count() > 1)
                                    <div class="col-12 col-lg-6 mb-3">
                                        <div class="mb-3 bg-soft-primary p-3 d-flex justify-content-between align-items-center rounded-lg">
                                            <h5 class="p-0 m-0">{{ $category->name }}</h5>
                                            <a href="{{ route('Category.show', $category->slug) }}">View all &rarr;</a>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                @foreach($category->posts as $k => $obj)
                                                    @if($obj->status != 0)
                                                        @if($k == 0)
                                                            @if(!empty($obj->image) && strlen($obj->image) > 5 && Storage::disk('s3')->exists($obj->image))
                                                                <!-- Card -->
                                                                <div class="card transition-3d-hover">
                                                                    <div>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <h4><a class="text-decoration-none text-dark" href="{{ route($app->module.'.show', $obj->slug) }}">{{$obj->title}}</a></h4>
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
                                                                <div class="col-sm-6 col-lg-4  mb-3 mb-lg-0">
                                                                    <!-- Card -->
                                                                    <div class="card transition-3d-hover bg-soft-info" href="#">
                                                                        <div class="card-body">
                                                                            <h4 class="mb-0">{{ $obj->title }}</h4>
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
                                                                </div>
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="col-6 p-0">
                                                <ul class="pl-4">
                                                    @foreach($category->posts->take(7) as $k => $obj)
                                                        @if($obj->status != 0)
                                                            @if($k != 0)
                                                                <li class="my-3"><a href="{{ route($app->module.'.show', $obj->slug) }}" class="text-muted" >{{ $obj->title }}</a></li>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Right Section -->
                <div class="col-12 col-lg-3">
                    <div class="mb-7">
                    <!-- Search Form -->
                    <form action="{{ route($app->module.'.search') }}" method="GET">
                        <div class="input-group mb-3"> 
                        <input type="text" class="form-control input-text" placeholder="Search..." name="query">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary btn-md" type="submit">
                            <i class="fa fa-search"></i>
                            </button>
                        </div>
                        </div>
                    </form>
                    <!-- End Search Form -->
                    </div>
                    <!---------Categories section-----> 
                    <div class="mb-5">
                    <h5 class="font-weight-bold mb-3">Categories</h5>
                    <div class="list-group">
                        @foreach($categories as $category)
                            <a type="button" href="{{ route('Category.show', $category->slug) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" aria-current="true">
                            {{ $category->name }}<span class="badge bg-primary text-white rounded-pill">{{ $category->posts->count() }}</span>
                            </a>
                        @endforeach
                    </div>
                    </div>
                    <!--------- End categories section----->

                    <!----- Tags section------>
                    <div class="mb-5">
                    <h5 class="font-weight-bold mb-3">Tags</h5>
                    @foreach($tags as $tag)
                        <a class="btn btn-sm btn-outline-dark mb-1" href="{{ route('Tag.show', $tag->slug) }}">{{ $tag->name }}</a>
                    @endforeach
                    </div>
                    <!----- End Tags Section------>

                    <div class="mb-7">
                    <div class="mb-3">
                        <h3>Popular</h3>
                    </div>

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

                    </div>

                </div>
            </div>
        <!-- End of Row -->

        </div>
        <!-- End Blogs Section -->


</x-dynamic-component>