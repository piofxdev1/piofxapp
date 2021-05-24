<x-dynamic-component :component="$app->componentName">

  <!-- Hero Section -->
  <div class="bg-dark space-top-3 pb-5 d-flex justify-content-center align-items-center">
      <div class="text-center">
          <h3 class="mt-3 mb-1"><span class="badge bg-light text-dark">Tag</span></h3>
          <h1 class="text-white mb-0">{{ $tag }}</h1>
      </div>
  </div>
  <!-- End Hero Section -->

  <!-- Blogs Section -->
  <div class="container space-1 space-lg-2">
    <div class="row justify-content-lg-between">
      <div class="col-lg-8">
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
                                        <a href="{{ route('Post.show', $post->slug) }}" class="btn btn-sm btn-primary">Continue Reading</a>
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
                                <a href="{{ route($app->module.'.show', $post->slug) }}" class="btn btn-sm btn-primary">Continue Reading</a>
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
      </div>
      <!-- End Blog -->

      <!-- Right Section -->
      <div class="col-lg-3">
        <div class="mb-7">
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
          @foreach($objs as $obj)
            <a class="btn btn-sm btn-outline-dark mb-1" href="{{ route('Tag.show', $obj->slug) }}">{{ $obj->name }}</a>
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

      </div>
    </div>
    <!-- End of Row -->
    {{$posts->links()}}

  </div>
  <!-- End Blogs Section -->



</x-dynamic-component>