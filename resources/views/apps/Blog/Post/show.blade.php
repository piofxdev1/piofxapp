<x-dynamic-component :component="$app->componentName">  

<!-- Article Description Section -->
<div class="container ">

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

    @if($settings->post_layout != 'full')
    <div class="row mt-3">
    @else
    <div class="mt-3">
    @endif
        @if($settings->post_layout == 'left')
            <div class="col-12 col-lg-4 d-none d-lg-block">
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

                <!-- Related Posts Left Section -->
                <div class="my-5">
                    @if($obj->category && count($obj->category->posts) > 1)
                        <div class="my-3">
                            <h3 class="font-weight-bold">@if($settings->language == 'telugu') సంబంధిత వార్తలు @else Related Posts @endif</h3>
                        </div>
                        @foreach($obj->category->posts->take(4) as $post)
                            @if($post->id != $obj->id)
                                @if(!empty($post->image) && strlen($post->image) > 5)
                                    @if(Storage::disk('s3')->exists($post->image))
                                        <!-- Related Post -->
                                        <div class="bg-soft-primary p-3 rounded-lg mb-3">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="col-4">
                                                    <img class="img-fluid rounded-lg" src="{{ Storage::disk('s3')->url($post->image) }}" alt="Image Description">
                                                </div>
                                                <div class="col-8 pl-0">
                                                    <h4 class="mb-0"><a class="text-decoration-none text-dark" href="{{ route($app->module.'.show', $post->slug) }}">{{ $post->title }}</a></h4>
                                                    <p class="text-muted m-0">{{ $post->created_at ? $post->created_at->diffForHumans() : "" }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Related Post -->
                                    @endif
                                @else
                                    <div class="bg-soft-primary p-3 rounded-lg mb-3">
                                        <h4 class="mb-0"><a class="text-decoration-none text-dark" href="{{ route($app->module.'.show', $post->slug) }}">{{ $post->title }}</a></h4>
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
                    @endif
                </div>
                <!-- End Related Posts Section -->

                <!----- Tags section------>
                <div class="my-5">
                    <h3 class="font-weight-bold mb-3">@if($settings->language == 'telugu') టాగ్లు @else Tags @endif</h3>
                    @foreach($tags as $tag)
                    <a class="btn btn-sm btn-outline-dark mb-1" href="{{ route('Tag.show', $tag->slug) }}">{{ $tag->name }}</a>
                    @endforeach
                </div>
                <!----- End Tags Section------>

                <!-- Popular Posts -->
                <div class="my-5">
                    <h3 class="font-weight-bold my-3">@if($settings->language == 'telugu') ముఖ్య విశేషాలు @else Popular Posts @endif</h3>
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
                </div>
                <!-- End Popular Posts -->
                <!-- Ad -->
                <div class="my-5">
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
        @endif
        @if($settings->post_layout != 'full')
        <div class="col-12 col-lg-8">
        @endif
            <!-- Featured Image -->
            @if(!empty($obj->image) && strlen($obj->image) > 5)
                @if(Storage::disk('s3')->exists($obj->image))
                    <div class="text-center featured_image mb-5">
                        <img src="{{ Storage::disk('s3')->url($obj->image) }}" class="img-fluid rounded-lg shadow">
                    </div>
                @endif
            @endif
            <!-- End Featured Image -->

            <div class="mb-3">
                <h1>{{$obj->title}}</h1>
                @if($obj->category)
                    <a href="{{ route('Category.show', $obj->category->slug) }}" class="h5 text-decoration-none"><span class="badge badge-dark">{{ $obj->category->name }}</span></a>
                @endif
            </div>

            <!-- Author and share -->
            <div class="border-top border-bottom py-4 mb-5">
                <div class="row align-items-md-center">
                    <div class="col-7 p-0 pl-3">
                        <div class="media align-items-center">
                            @if($author)
                                @if($author->image)
                                    <div class="avatar avatar-circle">
                                        <img class="avatar-img" src="{{ url('/').'/storage/'.$author->image }}" alt="Image Description">
                                    </div>
                                @else
                                    <div class="avatar avatar-circle bg-soft-primary text-primary d-flex align-items-center justify-content-center">
                                        <h3 class="m-0 p-0">{{ strtoupper($author->name[0]) }}</h3>
                                    </div>
                                @endif
                            @endif
                            <div class="media-body font-size-1 ml-3">
                                <span class="h6"><a href="{{ route($app->module.'.author', $author->id) }}">{{ $author->name}}</a></span>
                                <span class="d-block text-muted">{{ $obj->created_at ? $obj->created_at->diffForHumans() : "" }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-5 p-0 pr-4">
                        <div class="d-flex justify-content-md-end align-items-center">
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

            <!-- Ad -->
            <div class="my-5">
                @if($settings->ads)
                    @foreach($settings->ads as $ad)
                        @if($ad->position == 'before-content')
                            {!! $ad->content !!}
                        @endif
                    @endforeach
                @endif
            </div>
            <!-- End Ad Section -->

            @if($obj->visibility == "private")
                @php
                    $user_group = explode(",", auth()->user()->group);
                    $post_group = explode(",", $obj->group);
                    $group = array_intersect($user_group, $post_group);
                @endphp
                @if(sizeOf($group) > 0)
                    {!! $obj->content !!}
                @else
                    <div class="text-center bg-soft-danger p-3 rounded-lg">
                        <h3 class="rounded-lg">Sorry but it seems that this post is currently locked</h3>
                        <img src="{{ asset('img/locked.png') }}" class="img-fluid w-50">
                    </div>
                @endif
            @else
                {!! $obj->content !!}
            @endif

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
            <div class="d-flex justify-content-sm-between align-items-sm-center my-5">
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

            <!-- Ad -->
            <div class="my-5">
                @if($settings->ads)
                    @foreach($settings->ads as $ad)
                        @if($ad->position == 'after-content')
                            {!! $ad->content !!}
                        @endif
                    @endforeach
                @endif
            </div>
            <!-- End Ad Section -->

            <!-- Related Posts Full Section -->
            @if($settings->post_layout == 'full')
            <div class="my-5 d-none d-lg-block">
                @if($obj->category && count($obj->category->posts) > 1)
                    <div class="my-3">
                        <h3 class="font-weight-bold">@if($settings->language == 'telugu') సంబంధిత వార్తలు @else Related Posts @endif</h3>
                    </div>
                    <div class="row">
                        @foreach($obj->category->posts->take(7) as $post)
                            @if($post->id != $obj->id)
                                @if(!empty($post->image) && strlen($post->image) > 5)
                                    @if(Storage::disk('s3')->exists($post->image))
                                        <div class="col-4 mb-3">
                                            <div class="bg-soft-primary p-3 rounded-lg d-flex align-items-center" style="min-height: 9.3rem;">
                                                <!-- Related Post -->
                                                <div class="row justify-content-between align-items-center">
                                                    <div class="col-4">
                                                        <img class="img-fluid rounded-lg" src="{{ Storage::disk('s3')->url($post->image) }}" alt="Image Description">
                                                    </div>
                                                    <div class="col-8 pl-0">
                                                        <h4 class="mb-0"><a class="text-decoration-none text-dark" href="{{ route($app->module.'.show', $post->slug) }}">{{ $post->title }}</a></h4>
                                                        <p class="text-muted m-0">{{ $post->created_at ? $post->created_at->diffForHumans() : "" }}</p>
                                                    </div>
                                                </div>
                                                <!-- End Related Post -->
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <div class="col-4 mb-3">
                                        <!-- Related Post -->
                                        <div class="bg-soft-primary p-3 rounded-lg d-flex align-items-center" style="min-height: 9.3rem;">
                                            <div>
                                                <h4 class="mb-0"><a class="text-decoration-none text-dark" href="">{{ $post->title }}</a></h4>
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
                                        </div>
                                        <!-- End Related Post -->
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                   
                @endif
            </div>
            @endif
            <!-- End Related Posts Section -->
        @if($settings->post_layout != 'full')
        </div>
        @endif

        <div class="d-lg-none px-3">

            <!-- Related Posts Right Section -->
            <div class="my-5">
                @if($obj->category && count($obj->category->posts) > 1)
                    <h3 class="font-weight-bold my-3">@if($settings->language == 'telugu') సంబంధిత వార్తలు @else Related Posts @endif</h3>
                    @foreach($obj->category->posts->take(4) as $post)
                        @if($post->id != $obj->id)
                            @if(!empty($post->image) && strlen($post->image) > 5)
                                @if(Storage::disk('s3')->exists($post->image))
                                    <!-- Related Post -->
                                    <div class="bg-soft-primary p-3 rounded-lg mb-3">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-4">
                                                <img class="img-fluid rounded-lg" src="{{ Storage::disk('s3')->url($post->image) }}" alt="Image Description">
                                            </div>
                                            <div class="col-8 pl-0">
                                                <h4 class="mb-0"><a class="text-decoration-none text-dark" href="{{ route($app->module.'.show', $post->slug) }}">{{ $post->title }}</a></h4>
                                                <p class="text-muted m-0">{{ $post->created_at ? $post->created_at->diffForHumans() : "" }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Related Post -->
                                @endif
                            @else
                                <div class="bg-soft-primary p-3 rounded-lg mb-3">
                                    <h4 class="mb-0"><a class="text-decoration-none text-dark" href="{{ route($app->module.'.show', $post->slug) }}">{{ $post->title }}</a></h4>
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
                @endif
            </div>
            <!-- End Related Posts Section -->

            <!----- Tags section------>
            <div class="mb-5">
                <h3 class="font-weight-bold mb-3">@if($settings->language == 'telugu') టాగ్లు @else Tags @endif</h3>
                @foreach($tags as $tag)
                <a class="btn btn-sm btn-outline-dark mb-1" href="{{ route('Tag.show', $tag->slug) }}">{{ $tag->name }}</a>
                @endforeach
            </div>
            <!----- End Tags Section------>

            <!-- Popular Posts -->
            <div class="mb-5">
                <h3 class="font-weight-bold my-3">@if($settings->language == 'telugu') ముఖ్య విశేషాలు @else Popular Posts @endif</h3>
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
            </div>
            <!-- End Popular Posts --> 
        </div>

        @if($settings->post_layout == 'right')
        <div class="col-12 col-lg-4 d-none d-lg-block">

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

            <!-- Related Posts Right Section -->
            <div class="my-5">
                @if($obj->category && count($obj->category->posts) > 1)
                    <div class="my-3">
                        <h3 class="font-weight-bold">@if($settings->language == 'telugu') సంబంధిత వార్తలు @else Related Posts @endif</h3>
                    </div>
                    @foreach($obj->category->posts->take(4) as $post)
                        @if($post->id != $obj->id)
                            @if(!empty($post->image) && strlen($post->image) > 5)
                                @if(Storage::disk('s3')->exists($post->image))
                                    <!-- Related Post -->
                                    <div class="bg-soft-primary p-3 rounded-lg mb-3">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-4">
                                                <img class="img-fluid rounded-lg" src="{{ Storage::disk('s3')->url($post->image) }}" alt="Image Description">
                                            </div>
                                            <div class="col-8 pl-0">
                                                <h4 class="mb-0"><a class="text-decoration-none text-dark" href="{{ route($app->module.'.show', $post->slug) }}">{{ $post->title }}</a></h4>
                                                <p class="text-muted m-0">{{ $post->created_at ? $post->created_at->diffForHumans() : "" }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Related Post -->
                                @endif
                            @else
                                <div class="bg-soft-primary p-3 rounded-lg mb-3">
                                    <h4 class="mb-0"><a class="text-decoration-none text-dark" href="{{ route($app->module.'.show', $post->slug) }}">{{ $post->title }}</a></h4>
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
                @endif
            </div>
            <!-- End Related Posts Section -->

            <!----- Tags section------>
            <div class="my-5">
                <h3 class="font-weight-bold mb-3">@if($settings->language == 'telugu') టాగ్లు @else Tags @endif</h3>
                @foreach($tags as $tag)
                <a class="btn btn-sm btn-outline-dark mb-1" href="{{ route('Tag.show', $tag->slug) }}">{{ $tag->name }}</a>
                @endforeach
            </div>
            <!----- End Tags Section------>

            <!-- Popular Posts -->
            <div class="my-5">
                <h3 class="font-weight-bold mb-3">@if($settings->language == 'telugu') ముఖ్య విశేషాలు @else Popular Posts @endif</h3>
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
            </div>
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
        @endif
    </div>

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
<!-- End Article Description Section -->

</x-dynamic-component>