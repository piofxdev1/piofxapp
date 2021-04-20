<x-dynamic-component :component="$app->componentName">  

<!-- ========== MAIN ========== -->
<main id="content" role="main">
<!-- Article Description Section -->
<div class="container space-top-3">
    <!-- Featured Image -->
    <div class="my-3 text-center">
        <img src="{{ url('/').'/storage/'.$obj->image }}" class="img-fluid w-lg-75 rounded-lg shadow">
    </div>
    <!-- ENd Featured Image -->

    <div class="mt-5 mb-3">
        <h1>{{$obj->title}}</h1>
        @if($obj->category)
        <a href="{{ route('Category.show', $obj->category->slug) }}" class="h5 text-decoration-none"><span class="badge badge-dark">{{ $obj->category->name }}</span></a>
            @endif
    </div>

    <!-- Author -->
    <div class="border-top border-bottom py-4 mb-5">
        <div class="row align-items-md-center">
        <div class="col-md-7 mb-5 mb-md-0">
            <div class="media align-items-center">
            <div class="avatar avatar-circle">
                <img class="avatar-img" src="https://source.unsplash.com/random/1280x720" alt="Image Description">
            </div>
            <div class="media-body font-size-1 ml-3">
                <span class="h6"><a href="blog-profile.html">{{ request()->get('client.name') }}</a></span>
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
    <!-- End Author -->

    {!! $obj->content !!}

    <div class="card bg-img-hero bg-navy text-white text-center p-4 my-4" style="background-image: url({{ asset('themes/front/svg/components/abstract-shapes-1.svg') }});">
        <h4 class="text-white mb-3">Like what you're reading? Subscribe to our top stories.</h4>

        <!-- Form -->
        <form class="js-validate w-md-75 mx-md-auto">
        <div class="js-form-message">
            <div class="d-flex align-items-center">
            <label class="sr-only" for="subscribeSrArticle">Subscribe</label>
            <div class="input-group">
                <input type="email" class="form-control" id="subscribeSrArticle" placeholder="Your email" aria-label="Your email">
            </div>
            <button type="submit" class="btn btn-light ml-3">Submit</button>
            </div>
        </div>
        </form>
        <!-- End Form -->
    </div>

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
    <div class="row justify-content-sm-between align-items-sm-center mt-5">
        <div class="col-sm-6 mb-2 mb-sm-0">
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

        <div class="col-sm-6 text-sm-right">
        <a class="btn btn-xs btn-icon btn-soft-secondary rounded-circle mr-2" href="#" data-toggle="tooltip" data-placement="top" title="Bookmark story">
            <i class="far fa-bookmark"></i>
        </a>
        <a class="btn btn-xs btn-icon btn-soft-secondary rounded-circle" href="#" data-toggle="tooltip" data-placement="top" title="Report story">
            <i class="far fa-flag"></i>
        </a>
        </div>
    </div>
    <!-- End Share -->

    <!-- Author -->
    <div class="media align-items-center border-top border-bottom py-5 my-8">
        <div class="avatar avatar-circle avatar-xl">
        <img class="avatar-img" src="https://source.unsplash.com/random/1280x720" alt="Image Description">
        </div>
        <div class="media-body ml-3">
        <small class="d-block small font-weight-bold text-cap">Written by</small>
        <h3 class="mb-0"><a href="blog-profile.html">{{ request()->get('client.name') }}</a></h3>
        <p class="mb-0">I create advanced website builders made exclusively for web developers.</p>
        </div>
    </div>
    <!-- End Author -->
</div>
<!-- End Article Description Section -->

<!-- Blog Card Section -->
<div class="container">
    @if(count($obj->category->posts) > 1)
        <div class="my-3">
            <h3 class="font-weight-bold">Related stories</h3>
        </div>

        <div class="row">
            @foreach($obj->category->posts as $post)
                @if($post->id != $obj->id)
                    <div class="col-md-6 mb-3">
                        <!-- Blog Card -->
                        <div class="row justify-content-between">
                            <div class="col-4">
                                <img class="img-fluid" src="{{ url('/').'/storage/'.$post->image }}" alt="Image Description">
                            </div>
                            <div class="col-8">
                                <h4 class="mb-0"><a class="text-decoration-none text-dark" href="">{{ $post->title }}</a></h4>
                                <p class="text-muted">{{ $post->excerpt }}</p>
                            </div>
                        </div>
                        <!-- End Blog Card -->
                    </div>
                @endif
            @endforeach
        </div>
    @endif
</div>
<!-- End Blog Card Section -->

</main>
<!-- ========== END MAIN ========== -->

</x-dynamic-component>