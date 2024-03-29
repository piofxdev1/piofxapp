
<x-dynamic-component :component="$app->componentName" class="mt-4" >

  <!--begin::Breadcrumb-->
  <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-4 font-size-sm ">
    <li class="breadcrumb-item">
      <a href="{{ route('dashboard')}}" class="text-muted">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route($app->module.'.index',$app->id) }}"  class="text-muted">{{ ucfirst($app->module) }}</a>
    </li>
    @if($stub!='Create')
    <li class="breadcrumb-item">
      <a href="" class="text-muted">{{ $obj->name }}</a>
    </li>
    @endif
  </ul>
  <!--end::Breadcrumb-->



  @if($stub=='Create')
    <form method="post" action="{{route($app->module.'.store',$app->id)}}" enctype="multipart/form-data">
  @else
    <form method="post" action="{{route($app->module.'.update',[$app->id,$obj->id])}}" enctype="multipart/form-data">
  @endif  

  <!--begin::basic card-->
  <x-snippets.cards.action :title="$app->module " class="border"  >
  
      <div class="row">
        <div class="col-12 col-md-3">
          <div class="form-group">
            <label for="formGroupExampleInput ">{{ ucfirst($app->module)}} Name</label>
            <input type="text" class="form-control" name="name" id="formGroupExampleInput" placeholder="Enter the Category Name" 
                @if($stub=='Create')
                value="{{ (old('name')) ? old('name') : '' }}"
                @else
                value = "{{ $obj->name }}"
                @endif
              >
          </div>
        </div>
        <div class="col-12 col-md-3">
          <div class="form-group">
            <label for="formGroupExampleInput ">Client</label>
            <select class="form-control" id="exampleSelectd" name="client_id">
            @foreach($clients as $c)
             <option value="{{$c->id}}" @if(isset($obj)) @if($obj->client_id==$c->id) selected @endif @endif>{{$c->name}}</option>
            @endforeach
            </select>
          </div>
        </div>
        <div class="col-12 col-md-3">
          <div class="form-group">
            <label for="formGroupExampleInput ">Status </label>
            <div class="col-9 col-form-label">
            <div class="radio-inline">
                <label class="radio radio-success">
                    <input type="radio" name="status" @if(isset($obj)) @if($obj->status==1) checked="checked" @endif @endif value="1"/>
                    <span></span>
                    Active
                </label>
                <label class="radio radio-danger">
                    <input type="radio" name="status" @if(isset($obj)) @if($obj->status==0) checked="checked" @endif @endif value="0"/>
                    <span></span>
                    Inactive
                </label>
            </div>
            </div>
          </div>
        </div>
      </div>  

      <div class="form-group bg-light border p-4">
    <label for="exampleFormControlFile1">Upload File</label>
    <input type="file" class="form-control-file" name="file" id="exampleFormControlFile1">
  
      </div>
      
      @if($stub=='Update')
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="{{ $obj->id }}">
      @endif
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

        <input type="hidden" name="agency_id" value="{{ request()->get('agency.id') }}">
        <input type="hidden" name="client_id" value="{{ request()->get('client.id') }}">
        <input type="hidden" name="theme_id" value="{{ $app->id }}">
      
    
    
  </x-snippets.cards.action>
  <!--end::basic card-->   
  </form>

</x-dynamic-component>