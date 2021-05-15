    <!-- Hero Section -->
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
                <div class="js-slide bg-dark d-flex bg-img-hero min-h-620rem">
                    <!-- News Block -->
                    <div class="container min-h-620rem">
                        <div class="slider_image">
                            <img src="{{ Storage::disk('s3')->url($f->image) }}" class="img-fluid w-50">
                        </div>
                        <div class="">
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
                                <h3 class="h1 font-weight-bold text-white" data-hs-slick-carousel-animation="fadeInUp"
                                data-hs-slick-carousel-animation-delay="150">{{ $f->title }}</h3>

                                @if($f->excerpt)
                                    <p data-hs-slick-carousel-animation="fadeInUp"
                                data-hs-slick-carousel-animation-delay="150">{!! substr($f->excerpt, 0, 100) !!}...</p>
                                @else
                                    @php
                                        $content = strip_tags($f->content);
                                        $content = substr($content, 0 , 100);
                                    @endphp
                                    <p data-hs-slick-carousel-animation="fadeInUp"
                                data-hs-slick-carousel-animation-delay="150">{{ $content }}...</p>
                                @endif                  
                            </div>
                            <a class="btn btn-primary btn-wide transition-3d-hover" href="{{ route($app->module.'.show', $f->slug) }}"
                            data-hs-slick-carousel-animation="fadeInUp" data-hs-slick-carousel-animation-delay="300">Read Article<i
                            class="fas fa-angle-right fa-sm ml-1"></i></a>
                        </div>
                    </div>
                    <!-- End News Block -->
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
                            <h3 class="h1 font-weight-bold text-white" data-hs-slick-carousel-animation="fadeInUp"
                            data-hs-slick-carousel-animation-delay="150">{{ $f->title }}</h3>

                            @if($f->excerpt)
                                <p data-hs-slick-carousel-animation="fadeInUp"
                            data-hs-slick-carousel-animation-delay="150">{!! substr($f->excerpt, 0, 100) !!}...</p>
                            @else
                                @php
                                    $content = strip_tags($f->content);
                                    $content = substr($content, 0 , 100);
                                @endphp
                                <p data-hs-slick-carousel-animation="fadeInUp"
                            data-hs-slick-carousel-animation-delay="150">{{ $content }}...</p>
                            @endif                  </div>
                        <a class="btn btn-primary btn-wide transition-3d-hover" href="{{ route($app->module.'.show', $f->slug) }}"
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
                <div class="js-slide my-3">
                  <span class="text-white">{{ $f->title }}</span>

                  <span class="slick-pagination-line-progress">
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
    <!-- End Hero Section -->




        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach($featured as $k => $f)
                @if($f->status != 0)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $k }}" class="active"></li>
                @endif
            @endforeach
        </ol>
        <div class="carousel-inner">
            @foreach($featured as $k => $f)
                @if($f->status != 0)
                    @if(!empty($f->image) && strlen($f->image) > 5 && Storage::disk('s3')->exists($f->image))
                        <div class="carousel-item @if($k == 0 ){{ 'active' }}@endif" style="max-height: 40rem;"> 
                            <img class="d-block w-100 slider_image" src="{{ Storage::disk('s3')->url($f->image) }}" style="mask-image: linear-gradient(to bottom, transparent 0%, black 100%);">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Heading</h5>
                                <p>Paragraph</p>
                            </div>
                        </div>
                    @else
                        <div class="carousel-item @if($k == 0 ){{ 'active' }}@endif" style="max-height: 40rem;">
                            <img class="d-block w-100" src="https://source.unsplash.com/random/1920x1080">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Heading</h5>
                                <p>Paragraph</p>
                            </div>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>



    <div class="container">
        <div id="sliderSyncingNav" class="js-slick-carousel slick mb-2"
            data-hs-slick-carousel-options='{
            "prevArrow": "<span class=\"fas fa-arrow-left slick-arrow slick-arrow-soft-white slick-arrow-left slick-arrow-centered-y rounded-circle ml-sm-2 ml-xl-4\"></span>",
            "nextArrow": "<span class=\"fas fa-arrow-right slick-arrow slick-arrow-soft-white slick-arrow-right slick-arrow-centered-y rounded-circle mr-sm-2 mr-xl-4\"></span>",
            "infinite": true,
            "asNavFor": "#sliderSyncingThumb"
            }'>
            @foreach($featured as $f)
                @if($f->status != 0)
                    @if(!empty($f->image) && strlen($f->image) > 5 && Storage::disk('s3')->exists($f->image))
                        <div class="js-slide">
                            <img class="img-fluid" src="{{ Storage::disk('s3')->url($f->image) }}" alt="Image Description">
                        </div>
                    @else
                        <div class="js-slide">
                            <h1 class="text-dark">Heading</h1>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>

        <div id="sliderSyncingThumb" class="js-slick-carousel slick slick-gutters-1 slick-transform-off"
            data-hs-slick-carousel-options='{
            "infinite": true,
            "slidesToShow": 3,
            "isThumbs": true,
            "asNavFor": "#sliderSyncingNav",
            "responsive": [{
                "breakpoint": 992,
                "settings": {
                "slidesToShow": 2
                },
                "breakpoint": 768,
                "settings": {
                "slidesToShow": 1
                }
            }]
            }'>
            @foreach($featured as $f)
                @if($f->status != 0)
                    <div class="js-slide" style="cursor: pointer;">
                        <h1>Heading</h1>
                    </div>
                @endif
            @endforeach
        </div>
   </div>