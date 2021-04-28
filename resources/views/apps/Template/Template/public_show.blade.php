<x-dynamic-component :component="$app->componentName">

<div class="bg-soft-dark py-5" style="margin-top: 5.5rem;">
    <div class="container d-flex justify-content-between align-items-center">
        <div>
            <h2 class="d-inline">{{$obj->name}}</h2>
            <h5 class="text-muted">{{$obj->slug}}</h5>
        </div>
        <div>
            <button class="btn btn-primary btn-sm">Preview</button>
            <a href="{{$obj->download_path}}"><button class="btn btn-dark btn-sm">Download</button></a>
        </div>
    </div>
</div>

<div class="container">
    <div class="row ">
        <div class="col-4">
            <div class="card shadow-lg rounded-lg m-5" style="width: 22rem;">
                <img class="card-img-top" src="{{$obj->index_screenshot}}" alt="Card image cap">
                <div class="card-body">
                    <a class="card-title"><h3>{{$obj->name}}</h3></a>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> 
                </div>
            </div>
        </div>
        @foreach($screen_shots as $screen_shot)
        <div class="col-4">
            <div class="card shadow-lg rounded-lg m-5" style="width: 22rem;">
                <img class="card-img-top" src="{{$screen_shot}}" alt="Card image cap">
                <div class="card-body">
                    <a class="card-title"><h3>{{$obj->name}}</h3></a>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> 
                </div>
            </div>
        </div>
        @endforeach
       
    </div>
    <div class="row">
        @if($obj->template_tags) 
        @foreach($obj->template_tags as $tag)
        <a class="btn btn-xs btn-outline-dark mb-2 mr-2" href="{{ route('Template.public_index', 'tag_id='.$tag->id.'') }}">
        {{ $tag->name}}
        </a>
        @endforeach
        @endif
    </div>
</div>

</x-dynamic-component>