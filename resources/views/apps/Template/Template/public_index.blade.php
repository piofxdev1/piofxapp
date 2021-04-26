<x-dynamic-component :component="$app->componentName">

<div class="py-1" style="margin-top: 5.5rem; background-color: #e6f2ff;">
    <div class="container">
        <h2 class="d-inline">Html Templates</h2>
        <h3 class="d-inline text-muted"> > beauty</h3>
        <!---------Categories section----->

        <div class=" ">
                <h6 class="font-weight-bold mb-1">Categories</h6>
                @foreach($categories as $category)
                <a class="btn btn-xs btn-outline-dark ml-1 mb-2" href="{{ route('Template.public_index', 'category_id='.$category->id.'') }}">
                {{ $category->name }}</a>
                @endforeach
        </div>        
        <!--------- End categories section----->       
        
        <!----- Tags section------>
        <div class=" ">
                <h6 class="font-weight-bold mb-1">Tags</h6>
                @foreach($tags as $tag)
                <a class="btn btn-xs btn-outline-dark ml-1 mb-2" href="{{ route('Template.public_index', 'tag_id='.$tag->id.'') }}">{{ $tag->name }}</a>
                @endforeach
                
        </div>
        <!----- End Tags Section------>
    </div>
</div>

<div class="container mt-3">
    <div class="row">
        <div class="col-3">
            <!-- Form -->
            <div class="row">
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
            </div>
            <!-- End Form -->         
        </div>
    </div>
</div>
<section class="p-5" style="margin-left:5rem;">
    <div class="row pl-5">
        @forelse($objs as $obj)
                <div class="mt-2 p-3">
                    <div class="card shadow-lg rounded-lg" style="width: 25rem;">
                        <img class="card-img-top" src="{{$obj->index_screenshot}}" alt="Card image cap">
                        <div class="card-body">
                            <a class="card-title" href="{{ route('Template.public_show', $obj->slug) }}"><h3>{{$obj->name}}</h3></a>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
        @empty
            <p class="text-danger" style="margin-left:500px">No relevant templates yet......</p>
        @endforelse
    </div>
    {{ $objs->links() ?? "" }}
</section>
</div>

</x-dynamic-component>