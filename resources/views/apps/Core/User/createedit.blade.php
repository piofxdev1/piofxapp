
<x-dynamic-component :component="$app->componentName" class="mt-4" >

	<!--begin::Breadcrumb-->
	<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-4 font-size-sm ">
		<li class="breadcrumb-item">
			<a href="{{ route('profile')}}" class="text-muted">Profile</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ route($app->module.'.index') }}"  class="text-muted">{{ ucfirst($app->module) }}</a>
		</li>
		@if($stub!='Create')
		<li class="breadcrumb-item">
			<a href="" class="text-muted">{{ $obj->name }}</a>
		</li>
		@endif
	</ul>
	<!--end::Breadcrumb-->



  @if($stub=='Create')
    <form method="post" action="{{route($app->module.'.store')}}" enctype="multipart/form-data">
  @endif
  @if($stub == 'Update')
    <form method="post" action="{{route($app->module.'.update',$obj->id)}}" enctype="multipart/form-data">
  @endif  
  @if($stub=='User') 
    <form method="post" action="{{route('profile.update',$obj->name)}}" enctype="multipart/form-data">
  @endif
	<!--begin::basic card-->
	<x-snippets.cards.action :title="$app->module " class="border"  >
  
    <div class="row">
      <div class="col-12 col-md-4">
        <div class="js-form-message form-group mb-4">
            <label for="inputName" class="input-label">Name</label>
            <input type="text" class="form-control" name="name" id="inputName" placeholder="Alex Hecker" aria-label="Alex Hecker" required
                   data-msg="Please enter your name." value="@if(isset($obj->name)) {{$obj->name}} @endif">
          </div>

      </div>
      <div class="col-12 col-md-4">
        <div class="js-form-message form-group mb-4">
            <label for="emailAddressExample2" class="input-label">Phone</label>
            <input type="text" class="form-control" name="phone" id="emailAddressExample2" required
                   data-msg="Please enter a valid phone number" value="@if(isset($obj->phone)) {{$obj->phone}} @endif">
          </div>

      </div>
      <div class="col-12 col-md-4">
        <div class="js-form-message form-group mb-4">
            <label for="emailAddressExample2" class="input-label">Email address</label>
            <input type="email" class="form-control" name="email" id="emailAddressExample2" placeholder="alexhecker@pixeel.com" aria-label="alexhecker@pixeel.com" required
                   data-msg="Please enter a valid email address." value="@if(isset($obj->email)) {{$obj->email}} @endif">
          </div>

      </div>
    </div>
        
      <div class="row">
        <div class="col-12 col-md-4">
          <div class="js-form-message form-group mb-4">
              <label class="input-label">Group</label>
              <input type="text" class="form-control" name="group" placeholder="Enter the Group" aria-label="Enter the Group"
                       value="@if(isset($obj->group)) {{$obj->group}} @endif">
          </div>
        </div>
        <div class="col-12 col-md-4">
          <div class="js-form-message form-group mb-4">
              <label class="input-label">Sub Group</label>
              <input type="text" class="form-control" name="subgroup" placeholder="Enter the Subgroups in CSV format" aria-label="Enter the Subgroups in CSV format"
                      value="@if(isset($obj->subgroup)) {{$obj->subgroup}} @endif">
          </div>
        </div>
        <div class="col-12 col-md-4">
          <div class="js-form-message form-group mb-4">
              <label class="input-label">Data</label>
              <input type="text" class="form-control" name="data" placeholder="Enter the data" aria-label="Enter the data"
                      value="@if(isset($obj->data)) {{$obj->data}} @endif">
          </div>
        </div>
      </div>
      
      <div class="row">     
        <div class="col-12 col-md-4">
          <div class="form-group">
            <label for="formGroupExampleInput ">Role</label>
            <select class="form-control" id="exampleSelectd" name="role">
              @if(Auth::user()->checkRole(['superadmin','agencyadmin']))
              <option value="agencyadmin" @if(isset($obj)) @if($obj->role =='agencyadmin') selected @endif @endif>Agency Admin</option>
              <option value="agencydeveloper" @if(isset($obj)) @if($obj->role =='agencydeveloper') selected @endif @endif>Agency Developer</option>
              <option value="agencymanager" @if(isset($obj)) @if($obj->role =='agencymanager') selected @endif @endif>Agency Manager</option>
              <option value="agencymoderator" @if(isset($obj)) @if($obj->role =='agencymoderator') selected @endif @endif>Agency Moderator</option>
              @endif
             <option value="clientadmin" @if(isset($obj)) @if($obj->role =='clientadmin') selected @endif @endif>Client Admin</option>
             <option value="clientdeveloper" @if(isset($obj)) @if($obj->role =='clientdeveloper') selected @endif @endif>Client Developer</option>
             <option value="clientmanager" @if(isset($obj)) @if($obj->role =='clientmanager') selected @endif @endif>Client Manager</option>
             <option value="clientmoderator" @if(isset($obj)) @if($obj->role =='clientmoderator') selected @endif @endif>Client Moderator</option>
             <option value="user" @if(isset($obj)) @if($obj->role =='user') selected @endif @endif>User</option>

            </select>
          </div>
        </div>
  
        <div class="col-12 col-md-4">
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
        
      <div class="row-md-4">
        <label class="input-label">Enter Json Data</label>
          <textarea type="text" class="form-control" rows="9"  name="json">@if($stub == 'Update'){{$obj->json ? $obj->json : ''}}@endif
          </textarea>
      </div>

      @if($stub=='Update')
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="{{ $obj->id }}">
      @endif
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="agency_id" value="{{ request()->get('agency.id') }}">
        <input type="hidden" name="client_id" value="{{ request()->get('client.id') }}">
      
      
    
    
	</x-snippets.cards.action>
	<!--end::basic card-->   
  </form>

</x-dynamic-component>