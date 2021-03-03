
<x-dynamic-component :component="$app->componentName" class="mt-4" >

	<!--begin::Breadcrumb-->
	<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-4 font-size-sm ">
		<li class="breadcrumb-item">
			<a href="{{ route('dashboard')}}" class="text-muted">Dashboard</a>
		</li>
		<li class="breadcrumb-item">
			<a href="{{ route($app->module.'.index') }}"  class="text-muted">{{ ucfirst($app->module) }}</a>
		</li>
		<li class="breadcrumb-item">
			<a href="" class="text-muted">{{ $obj->name }}</a>
		</li>
	</ul>
	<!--end::Breadcrumb-->

	<!--begin::Alert-->
	@if($alert)
	  <x-snippets.alerts.basic>{{$alert}}</x-snippets.alerts.basic>
	@endif
	<!--end::Alert-->

	<!--begin::Titlecard-->
	<x-snippets.cards.titlecard :title="$obj->name" :id="$obj->id" :module="$app->module" :obj="$obj" />
	<!--end::Titlecard-->


	<!--begin::basic card-->
	<x-snippets.cards.basic>
		<div class="row mb-2">
			<div class="col-md-4"><b>Name</b></div>
			<div class="col-md-8">{{ $obj->name }}</div>
		</div>
		<div class="row mb-2">
			<div class="col-md-4"><b>Email</b></div>
			<div class="col-md-8">{{ $obj->email }} </div>
		</div>
		
		<div class="row mb-2">
			<div class="col-md-4"><b>Category</b></div>
			<div class="col-md-8"><span class="label label-light-dark label-pill label-inline">{{ $obj->category }}</span> </div>
		</div>
		@if($obj->user)
		<div class="row mb-2">
			<div class="col-md-4"><b>User</b></div>
			<div class="col-md-8"><span class="badge badge-info">{{ $obj->user->name }}</span></div>
		</div>
		@endif
		<div class="row mb-2">
			<div class="col-md-4"><b>Message</b></div>
			<div class="col-md-8">
				<pre><code style="white-space: pre-wrap">{!! $obj->message !!}</code></pre>
			</div>
		</div>
		@if($obj->comment)
		<div class="row mb-2">
			<div class="col-md-4"><b>Comment</b></div>
			<div class="col-md-8">
				<pre><code style="white-space: pre-wrap">{!! $obj->comment !!}</code></pre>
			</div>
		</div>
		@endif
		<div class="row mb-2">
			<div class="col-md-4"><b>Status</b></div>
			<div class="col-md-8">
				@if($obj->status==0)
				<span class="label label-light-success label-pill label-inline">Customer</span>
				@elseif($obj->status==1)
				<span class="label label-light-warning label-pill label-inline">Open Lead</span>
				@elseif($obj->status==2)
				<span class="label label-light-danger label-pill label-inline">Cold Lead</span>
				@elseif($obj->status==3)
                  <span class="label label-light-info label-pill label-inline">Warm Lead</span>
                  @elseif($obj->status==4)
                  <span class="label label-light-primary label-pill label-inline">Prospect</span>
				@endif
			</div>
		</div>
		<div class="row mb-2">
			<div class="col-md-4"><b>Created</b></div>
			<div class="col-md-8">{{ ($obj->created_at) ? $obj->created_at->diffForHumans() : '' }}</div>
		</div>
		<div class="row mb-2">
			<div class="col-md-4"><b>Updated </b></div>
			<div class="col-md-8">{{ ($obj->updated_at) ? $obj->updated_at->diffForHumans() : '' }}</div>
		</div>
	</x-snippets.cards.basic>
	<!--end::basic card-->   

</x-dynamic-component>