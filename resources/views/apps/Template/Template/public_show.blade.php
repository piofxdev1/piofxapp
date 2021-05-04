<x-dynamic-component :component="$app->componentName">

<div class="bg-soft-info py-5 space-top-3">
    <div class="container mt-5 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="d-inline">{{$obj->name}}</h2>
            <h5 class="text-muted">{{$obj->slug}}</h5>
        </div>
        <div>
            <a href="{{ $obj->preview_path }}" class="btn btn-primary btn-sm">Preview</a>
            <a href="{{$obj->download_path}}" class="btn btn-dark btn-sm">Download</a>
        </div>
    </div>
</div>


<div class="container my-5">
    <!----- Tags section------>
    <div class="mb-5 d-flex justify-content-center align-items-center">
        @foreach($obj->template_tags as $tag)
            <h3><a class="badge rounded-badge bg-soft-primary text-dark py-2 px-3 mb-2 ml-2" href="{{ route('Template.public_index', 'tag_id='.$tag->id.'') }}"
        {{ $tag->name}}">{{ $tag->name }}</a></h3>
        @endforeach
    </div>
    <!----- End Tags Section------>   

    <div class="row">
        <div class="col-4">
            <div class="card shadow-lg rounded-lg mb-5" style="width: 22rem;">
                 <a href="{{$obj->index_screenshot}}" data-lightbox="screens"><img class="card-img-top" src="{{$obj->index_screenshot}}"></a>
                <div class="card-body">
                    <a class="card-title"><h3>{{$obj->name}}</h3></a>
                </div>
            </div>
        </div>
        @foreach($screen_shots as $name => $screen_shot)
        <div class="col-4">
            <div class="card shadow-lg rounded-lg mb-5" style="width: 22rem;">
                <a href="{{$screen_shot}}" data-lightbox="screens"><img class="card-img-top rounded-lg" src="{{$screen_shot}}"></a> 
                <div class="card-body">
                    <a class="card-title"><h3>{{ucwords($name)}}</h3></a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>

</x-dynamic-component>