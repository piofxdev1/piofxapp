<x-dynamic-component :component="$app->componentName">  

@php
    function create_slug($str, $delimiter){
        $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
        return $slug;
    }
@endphp

<!-- Article Description Section -->
<div class="container space-top-3">
    @if($settings->container_layout != 'full')
    <div class="row mt-3">
    @else
    <div class="mt-3">
    @endif
        @if($settings->container_layout == 'left')
        <div class="col-12 col-lg-4 d-none d-lg-block">
            <!-- Search Form -->
            <form action="{{ route($app->module.'.search') }}" method="GET">
                <div class="input-group mb-3 shadow"> 
                    <input type="text" class="form-control input-text" placeholder="Search..." name="query">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary btn-md" type="submit">
                        <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            <!-- End Search Form -->
            <!---------Categories section-----> 
            <div class="my-5">
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
            <!-- Related Posts Section -->
            <div class="my-5">
                @if(count($obj->category->posts) > 1)
                    <div class="my-3">
                        <h3 class="font-weight-bold">Related stories</h3>
                    </div>
                    @foreach($obj->category->posts as $post)
                        @if($post->id != $obj->id)
                            <!-- Related Post -->
                            <div class="row justify-content-between align-items-center my-3">
                                <div class="col-4">
                                    <img class="img-fluid rounded-lg" src="{{ url('/').'/storage/'.$post->image }}" alt="Image Description">
                                </div>
                                <div class="col-8 pl-0">
                                    <h4 class="mb-0"><a class="text-decoration-none text-dark" href="">{{ $post->title }}</a></h4>
                                    <p class="text-muted m-0">{{ $post->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <!-- End Related Post -->
                        @endif
                    @endforeach
                @endif
            </div>
            <!-- End Related Posts Section -->
        </div>
        @endif
        @if($settings->container_layout != 'full')
        <div class="col-12 col-lg-8">
        @endif
            <!-- Featured Image -->
            <div class="text-center featured_image">
                <img src="{{ url('/').'/storage/'.$obj->image }}" class="img-fluid rounded-lg shadow">
            </div>
            <!-- ENd Featured Image -->

            <div class="mt-5 mb-3">
                <h1>{{$obj->title}}</h1>
                @if($obj->category)
                <a href="{{ route('Category.show', $obj->category->slug) }}" class="h5 text-decoration-none"><span class="badge badge-dark">{{ $obj->category->name }}</span></a>
                    @endif
            </div>

            <!-- Author and share -->
            <div class="border-top border-bottom py-4 mb-5">
                <div class="row align-items-md-center">
                    <div class="col-md-7 mb-5 mb-md-0">
                        <div class="media align-items-center">
                            @if($author->image)
                                <div class="avatar avatar-circle">
                                    <img class="avatar-img" src="https://source.unsplash.com/random/1280x720" alt="Image Description">
                                </div>
                            @else
                                <div class="avatar avatar-circle bg-soft-primary text-primary d-flex align-items-center justify-content-center">
                                    <h3 class="m-0 p-0">{{ strtoupper($author->name[0]) }}</h3>
                                </div>
                            @endif
                            <div class="media-body font-size-1 ml-3">
                                <span class="h6"><a href="{{ route($app->module.'.author', $author->id) }}">{{ $author->name}}</a></span>
                                <span class="d-block text-muted">{{ $obj->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="d-flex justify-content-md-end align-items-center">
                        <span class="d-block small font-weight-bold text-cap mr-2">Share:</span>

                        <!-- Facebook (url) -->
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="btn btn-xs btn-icon btn-soft-secondary rounded-circle ml-2">
                            <i class="fab fa-facebook-f"></i>
                        </a>

                        <!-- Twitter (url, text, @mention) -->
                        <a href="https://twitter.com/share?url={{ url()->current() }}&text={{ rawurlencode($obj->title) }}" target="_blank" class="btn btn-xs btn-icon btn-soft-secondary rounded-circle ml-2">
                            <i class="fab fa-twitter"></i>
                        </a>

                        <!-- Reddit (url, title) -->
                        <a href="https://reddit.com/submit?url={{ url()->current() }}&title={{ rawurlencode($obj->title) }}" target="_blank" class="btn btn-xs btn-icon btn-soft-secondary rounded-circle ml-2">
                            <i class="fab fa-reddit"></i>
                        </a>

                        <!-- LinkedIn (url, title, summary, source url) -->
                        <a href="https://www.linkedin.com/shareArticle?url={{ url()->current() }}&title={{ rawurlencode($obj->title) }}&summary={{ $obj->excerpt }}&source={{ url('/') }}" target="_blank" class="btn btn-xs btn-icon btn-soft-secondary rounded-circle ml-2">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Author and share -->

            {!! $obj->content !!}

            <!-- Tags -->
            <div class="mt-4">
                <h4>Tags</h4>
                @if($obj->tags)
                @foreach($obj->tags as $tag)
                <a class="btn btn-xs btn-outline-dark mb-1" href="{{ route('Tag.show', $tag->slug) }}">{{ $tag->name }}</a>
                @endforeach
                @endif
            </div>
            <!-- End Tags -->

            <!-- Share -->
            <div class="d-flex justify-content-sm-between align-items-sm-center mt-5">
                <div class="d-flex align-items-center">
                    <span class="d-block small font-weight-bold text-cap mr-2">Share:</span>

                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="btn btn-xs btn-icon btn-ghost-secondary rounded-circle mr-2">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com/share?url={{ url()->current() }}&text={{ rawurlencode($obj->title) }}" target="_blank" class="btn btn-xs btn-icon btn-ghost-secondary rounded-circle mr-2">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://reddit.com/submit?url={{ url()->current() }}&title={{ rawurlencode($obj->title) }}" target="_blank" class="btn btn-xs btn-icon btn-ghost-secondary rounded-circle mr-2">
                        <i class="fab fa-reddit"></i>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?url={{ url()->current() }}&title={{ rawurlencode($obj->title) }}&summary={{ $obj->excerpt }}&source={{ url('/') }}" target="_blank" class="btn btn-xs btn-icon btn-ghost-secondary rounded-circle mr-2">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>

            </div>
            <!-- End Share -->

            <!-- Author -->
            <div class="media align-items-center border-top border-bottom py-5 my-8">
                @if($author->image)
                    <div class="avatar avatar-circle avatar-xl">
                        <img class="avatar-img" src="https://source.unsplash.com/random/1280x720" alt="Image Description">
                    </div>
                @else
                    <div class="avatar avatar-circle avatar-xl bg-soft-primary text-primary d-flex align-items-center justify-content-center">
                        <h1 class="m-0 p-0">{{ strtoupper($author->name[0]) }}</h1>
                    </div>
                @endif
                <div class="media-body ml-3">
                    <small class="d-block small font-weight-bold text-cap">Written by</small>
                    <h3 class="mb-0"><a href="{{ route($app->module.'.author', $author->id) }}">{{ $author->name }}</a></h3>
                    <p class="mb-0">I create advanced website builders made exclusively for web developers.</p>
                </div>
            </div>
            <!-- End Author -->
            <!-- Related Posts Section -->
            @if($settings->container_layout == 'full')
            <div class="my-5">
                @if(count($obj->category->posts) > 1)
                    <div class="my-3">
                        <h3 class="font-weight-bold">Related stories</h3>
                    </div>
                    <div class="row">
                        @foreach($obj->category->posts as $post)
                            @if($post->id != $obj->id)
                                <div class="col-4">
                                    <!-- Related Post -->
                                    <div class="row justify-content-between align-items-center my-3">
                                        <div class="col-4">
                                            <img class="img-fluid rounded-lg" src="{{ url('/').'/storage/'.$post->image }}" alt="Image Description">
                                        </div>
                                        <div class="col-8 pl-0">
                                            <h4 class="mb-0"><a class="text-decoration-none text-dark" href="">{{ $post->title }}</a></h4>
                                            <p class="text-muted m-0">{{ $post->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <!-- End Related Post -->
                                </div>
                            @endif
                        @endforeach
                    </div>
                   
                @endif
            </div>
            @endif
            <!-- End Related Posts Section -->
        @if($settings->container_layout != 'full')
        </div>
        @endif
        @if($settings->container_layout == 'right')
        <div class="col-12 col-lg-4 d-none d-lg-block">
            <!-- Search Form -->
            <form action="{{ route($app->module.'.search') }}" method="GET">
                <div class="input-group mb-3 shadow"> 
                    <input type="text" class="form-control input-text" placeholder="Search..." name="query">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary btn-md" type="submit">
                        <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            <!-- End Search Form -->
            <!---------Categories section-----> 
            <div class="my-5">
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
            <!-- Related Posts Section -->
            <div class="my-5">
                @if(count($obj->category->posts) > 1)
                    <div class="my-3">
                        <h3 class="font-weight-bold">Related stories</h3>
                    </div>
                    @foreach($obj->category->posts as $post)
                        @if($post->id != $obj->id)
                            <!-- Related Post -->
                            <div class="row justify-content-between align-items-center my-3">
                                <div class="col-4">
                                    <img class="img-fluid rounded-lg" src="{{ url('/').'/storage/'.$post->image }}" alt="Image Description">
                                </div>
                                <div class="col-8 pl-0">
                                    <h4 class="mb-0"><a class="text-decoration-none text-dark" href="">{{ $post->title }}</a></h4>
                                    <p class="text-muted m-0">{{ $post->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <!-- End Related Post -->
                        @endif
                    @endforeach
                @endif
            </div>
            <!-- End Related Posts Section -->
        </div>
        @endif
    </div>
</div>
<!-- End Article Description Section -->

</x-dynamic-component>