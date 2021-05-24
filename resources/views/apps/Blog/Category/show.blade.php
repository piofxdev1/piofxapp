<x-dynamic-component :component="$app->componentName">

    <!-- Hero Section -->
    <div class="bg-dark py-5 d-flex justify-content-center align-items-center"
        style="min-height: 10rem;">
        <div class="text-center">
            <h1><span class="bg-dark px-3 py-2 rounded-lg text-warning">{{ $category->name }}</span></h1>
            @if($category->meta_description)
            <div class="bg-dark p-3 rounded-lg">
                <h5 class="text-white mb-0">{{ $category->meta_description }}</h5>
            </div>
            @endif
        </div>
      @endif
    </div>
  </div>
  <!-- End Hero Section -->

    <!-- Blogs Section -->
    <div class="container space-1 space-lg-2">
        <div class="row justify-content-lg-between">
            <div class="col-lg-8">
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
                @if($posts->count() > 0)
                @foreach($posts as $post)
                    @if($post->status != 0)
                    <!-- Blog -->
                    @if(!empty($post->image) && strlen($post->image) > 5 && Storage::disk('s3')->exists($post->image))
                        <div class="mb-5 p-3 bg-light rounded-lg">
                            <div class="row">
                                <div class="col-md-5 d-flex align-items-center">
                                    <img class="img-fluid rounded-lg" src="{{ Storage::disk('s3')->url($post->image) }}" alt="Image Description">
                                </div>
                                <div class="col-md-7">
                                    <div class="card-body d-flex flex-column h-100 p-0">
                                        @if($post->category)
                                            <span class="d-block mb-2 mt-3 mt-lg-0">
                                            <a class="font-weight-bold text-decoration-none text-primary" href="{{ route('Category.show', $post->category->slug) }}">{{ $post->category->name }}</a>
                                            </span>
                                        @endif
                                        <h3><a class="text-decoration-none text-dark" href="{{ route('Post.show', $post->slug) }}">{{$post->title}}</a></h3>
                                        @if($post->excerpt)
                                            <p>{{ substr($post->excerpt, 0, 200) }}...</p>
                                        @else
                                            @php
                                                $content = strip_tags($post->content);
                                                $content = substr($content, 0 , 200);
                                            @endphp
                                            <p>{{ $content }}...</p>
                                        @endif
                                        <div class="mb-3">
                                            @if($post->tags)
                                            @foreach($post->tags as $tag)
                                                <a href="{{ route('Tag.show', $tag->slug) }}" class="badge rounded-badge bg-soft-primary px-2 py-1">{{ $tag->name }}</a>
                                            @endforeach
                                            @endif
                                        </div>
                                        <div>
                                            <a href="{{ route('Post.show', $post->slug) }}" class="btn btn-sm btn-primary">@if($settings->language == 'telugu') మరింత సమాచారం @else Continue Reading @endif</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="mb-5 p-3 bg-light rounded-lg">
                            <div class="card-body d-flex flex-column h-100 p-0">
                                @if($post->category)
                                    <span class="d-block mb-2">
                                    <a class="font-weight-bold text-decoration-none text-primary" href="{{ route('Category.show', $post->category->slug) }}">{{ $post->category->name }}</a>
                                    </span>
                                @endif
                                <h3><a class="text-decoration-none text-dark" href="{{ route($app->module.'.show', $post->slug) }}">{{$post->title}}</a></h3>
                                @if($post->excerpt)
                                    <p>{{ substr($post->excerpt, 0, 200) }}...</p>
                                @else
                                    @php
                                        $content = strip_tags($post->content);
                                        $content = substr($content, 0 , 200);
                                    @endphp
                                    <p>{{ $content }}...</p>
                                @endif
                                <div class="mb-3">
                                    @if($post->tags)
                                    @foreach($post->tags as $tag)
                                        <a href="{{ route('Tag.show', $tag->slug) }}" class="badge rounded-badge bg-soft-primary px-2 py-1">{{ $tag->name }}</a>
                                    @endforeach
                                    @endif
                                </div>
                                <div>
                                    <a href="{{ route($app->module.'.show', $post->slug) }}" class="btn btn-sm btn-primary">@if($settings->language == 'telugu') మరింత సమాచారం @else Continue Reading @endif</a>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!-- End Blog -->
                    @endif
                @endforeach
                @else
                <div class="text-center mb-5 p-3 bg-soft-danger rounded-lg">
                    <h2 class="text-danger">No Posts to show</h2>
                </div>
                @endif

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
                <div class="my-3">
                    {{ $posts->links() ?? "" }}
                </div>
            </div>
            <!-- End Blog -->

            <!-- Right Section -->
            <div class="col-lg-4">
                <div class="mb-5">
                <!-- Search Form -->
                    <form action="{{ route('Post.search') }}" method="GET">
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

                <!-- Ad -->
                <div class="my-5">
                    @if($settings->ads)
                        @foreach($settings->ads as $ad)
                            @if($ad->position == 'sidebar-top')
                                {!! $ad->content !!}
                            @endif
                        @endforeach
                    @endif
                </div>
                <!-- End Ad Section -->

                <!---------Categories section-----> 
                <div class="my-5 @if($settings->home_layout == 'news1' || $settings->home_layout == 'news2') d-none @endif">
                <h3 class="font-weight-bold mb-3">@if($settings->language == 'telugu') కేటగిరీలు @else Categories @endif</h3>
                <div class="list-group">
                    @foreach($objs as $obj)
                    <a type="button" href="{{ route('Category.show', $obj->slug) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" aria-current="true">
                    {{ $obj->name }}<span class="badge bg-primary text-white rounded-pill">{{ $obj->posts->count() }}</span>
                    </a>
                    @endforeach
                </div>
                </div>
                <!--------- End categories section----->

                <!----- Tags section------>
                <div class="my-5">
                <h3 class="font-weight-bold mb-3">@if($settings->language == 'telugu') టాగ్లు @else Tags @endif</h3>
                @foreach($tags as $tag)
                    <a class="btn btn-sm btn-outline-dark mb-1" href="{{ route('Tag.show', $tag->slug) }}">{{ $tag->name }}</a>
                @endforeach
                </div>
                <!----- End Tags Section------>

                <div class="my-5">
                <h3 class="mb-3">@if($settings->language == 'telugu') ముఖ్య విశేషాలు @else Popular Posts @endif</h3>
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
                                            <h6 class="mb-0"><a class="text-decoration-none text-dark" href="{{ route('Post.show', $post->slug) }}">{{ $post->title }}</a></h6>
                                            <p class="text-muted m-0">{{ $post->created_at ? $post->created_at->diffForHumans() : "" }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Related Post -->
                            @endif
                        @else
                            <div class="bg-soft-danger p-3 rounded-lg mb-3">
                                <h5 class="mb-0"><a class="text-decoration-none text-dark" href="{{ route('Post.show', $post->slug) }}">{{ $post->title }}</a></h5>
                                @if($post->excerpt)
                                    <p>{{ substr($post->excerpt, 0, 50) }}...</p>
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

</x-dynamic-component>