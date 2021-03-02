<x-dynamic-component :component="$app->componentName" class="mt-4" >

  <!--begin::Breadcrumb-->
  <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-4 font-size-sm ">
    <li class="breadcrumb-item">
      <a href="{{ route('dashboard')}}" class="text-muted">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href=""  class="text-muted">{{ ucfirst($app->module) }}</a>
    </li>
  </ul>
  <!--end::Breadcrumb-->

  <!--begin::Alert-->
  @if($alert)
    <x-snippets.alerts.basic>{{$alert}}</x-snippets.alerts.basic>
  @endif
  <!--end::Alert-->

  <!--begin::Indexcard-->
  <x-snippets.cards.indexcard title="Contact"  :module="$app->module" :action="route($app->module.'.index')"  />
  <!--end::Indexcard-->


  
  <div class="row mb-4">
    <div class="col-12 col-md-4">
      <x-snippets.cards.basic class="bg-light-primary border border-primary">
        <h5 class="text-primary">Total Forms</h5>
        <div class="display-1">{{$objs->total()}}</div>
      </x-snippets.cards.basic>
    </div>
    <div class="col-12 col-md-4">
      <x-snippets.cards.basic>
        <h5>Open</h5>
        <div class="display-1">{{$objs->total()}}</div>
      </x-snippets.cards.basic>
      
    </div>
    <div class="col-12 col-md-4">
        <x-snippets.cards.basic>
        <h5>Contacted</h5>
        <div class="display-1">{{$objs->total()}}</div>
      </x-snippets.cards.basic>
    </div>
  </div>
  <!--begin::basic card-->
  <x-snippets.cards.basic>
    @if($objs->total()!=0)
        <div class="table-responsive">
          <table class="table table-bordered mb-0">
            <thead>
              <tr>
                <th scope="col">#({{$objs->total()}})</th>
                <th scope="col">Name </th>
                <th scope="col" style="max-width: 200px ;">Message</th>
                <th scope="col">Comment</th>
                <th scope="col">Status</th>
                <th scope="col">Created</th>
              </tr>
            </thead>
            <tbody>
              @foreach($objs as $key=>$obj)  
              <tr>
                <th scope="row">{{ $objs->currentpage() ? ($objs->currentpage()-1) * $objs->perpage() + ( $key + 1) : $key+1 }}</th>
                <td>
                  <a href=" {{ route($app->module.'.show',$obj->id) }} ">
                  {{ $obj->name }}
                  </a><br> 
                  {{$obj->phone}}<br>
                    {{ $obj->email }}<br>
                </td>
                  <td > {!! $obj->message !!}</td>

                <td>{!! $obj->comment !!}</td>
                <td>
                  @if($obj->status==0)
                  <span class="badge badge-warning">Contacted</span>
                  <div class="mt-2">
                  @if($obj->user)
                  <span class="badge badge-info">{{$obj->user->name}}</span>
                    @endif
                  </div>
                  @elseif($obj->status==1)
                  <span class="badge badge-success">Open</span>
                  @endif
              </td>
                <td>{{ ($obj->created_at) ? $obj->created_at->diffForHumans() : '' }}</td>
              </tr>
              @endforeach      
            </tbody>
          </table>
        </div>
        @else
        <div class="card card-body bg-light">
          No items found
        </div>
        @endif
        <nav aria-label="Page navigation  " class="card-nav @if($objs->total() > config('global.no_of_records'))mt-3 @endif">
        {{$objs->appends(request()->except(['page','search']))->links()  }}
      </nav>
  </x-snippets.cards.basic>
  <!--end::basic card-->
</x-dynamic-component>