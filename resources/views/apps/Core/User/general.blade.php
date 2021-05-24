<x-dynamic-component :component="$app->componentName" class="mt-4" >
	<!--begin::basic card-->
	<!--begin::Breadcrumb-->
	<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-5 my-4 font-size-lg ">
		<li class="breadcrumb-item">
			<a href="/profile/{{$record->id}}/edit" class="menu-link">Edit</a>
		</li>
		<li class="breadcrumb-item">
		<a href="/logout" class="menu-link">
			<span class="menu-text">Logout</span>
		</a>
		</li>	
	</ul>
	<!--end::Breadcrumb-->

    <!--begin::Titlecard-->
	<!--end::Titlecard-->

	<x-snippets.cards.basic>
		<div class="row mb-2">
			<div class="col-md-4"><b>Name</b></div>
			<div class="col-md-8">{{ $record->name }}</div>
		</div>
		<div class="row mb-2">
			<div class="col-md-4"><b>Phone</b></div>
			<div class="col-md-8">{{ $record->phone }} </div>
		</div>
		<div class="row mb-2">
			<div class="col-md-4"><b>Email</b></div>
			<div class="col-md-8">{{ $record->email }} </div>
		</div>
        <div class="row mb-2">
			<div class="col-md-4"><b>Client</b></div>
			<div class="col-md-8">{{ $record->client->name }} ({{ $record->client->domain }})</div>
		</div>
		
		<div class="row mb-2">
			<div class="col-md-4"><b>Role</b></div>
			<div class="col-md-8">
				<pre><code style="white-space: pre-wrap">{{ $record->role}}</code></pre>
			</div>
		</div>

		<div class="row mb-2">
			<div class="col-md-4"><b>Status</b></div>
			<div class="col-md-8">@if($record->status==0)
				<span class="badge badge-warning">Inactive</span>
				@elseif($record->status==1)
				<span class="badge badge-success">Active</span>
			@endif</div>
		</div>
		<div class="row mb-2">
			<div class="col-md-4"><b>Created At</b></div>
			<div class="col-md-8">{{ ($record->created_at) ? $record->created_at->diffForHumans() : '' }}</div>
		</div>
	</x-snippets.cards.basic>
	<!--end::basic card-->   

</x-dynamic-component>