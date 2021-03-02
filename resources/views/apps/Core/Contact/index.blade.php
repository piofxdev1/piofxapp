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

<div class="card card-custom gutter-b bg-diagonal bg-diagonal-light-success">
 <div class="card-body">
  <div class="d-flex align-items-center justify-content-between p-4 flex-lg-wrap flex-xl-nowrap">
   <div class="d-flex flex-column mr-5">
    <div class="h2 text-dark text-hover-primary mb-0">
    Contact Form
    @if(Auth::user()->checkRole(['superadmin','agencyadmin','clientadmin']))
          <a href="{{ route('Contact.settings') }}" class="btn btn-warning btn-sm mt-1 mt-md-0"  >
            <i class="flaticon-settings p-0"></i> 
          </a>
          @endif
         
          <a href="{{ route('Contact.create') }}" class="btn btn-primary btn-sm mt-1 mt-md-0"  >
            <i class="flaticon-plus"></i> Create 
          </a>

    </div> 
    @if(request()->get('status')!=null)
    <div class="mb-3">Filter: @if(request()->get('status')==0)
                  <span class="label label-light-success label-pill label-inline">Customer</span>
                  @elseif(request()->get('status')==1)
                  <span class="label label-light-warning label-pill label-inline">Open Lead</span>
                  @elseif(request()->get('status')==2)
                  <span class="label label-light-danger label-pill label-inline">Cold Lead</span>
                  @elseif(request()->get('status')==3)
                  <span class="label label-light-info label-pill label-inline">Warm Lead</span>
                  @elseif(request()->get('status')==4)
                  <span class="label label-light-primary label-pill label-inline">Prospect</span>
                  @endif
    </div>
    <a href="{{ route('Contact.index') }} "><i class="fa flaticon2-left-arrow text-primary"></i> back</a>
    @endif

    
   </div>
   <div class="ml-8 ml-lg-0 ml-xxl-8 flex-shrink-0">
    <!--begin::Form-->
    <form class="form" action="{{ route('Contact.index') }}" method="get">
      <div class="row">
        <div class="col-12 " >
         <div class="input-icon">
           <input type="text" class="form-control" name="item" placeholder="Search..." @if(request()->get('item')) value="{{request()->get('item')}}" @endif style="max-width:250px"/>
           <span><i class="flaticon2-search-1 icon-md"></i></span>
         </div>
       </div>
         
      </div>
    </form>
    <!--end::Form-->
   
   </div>
  </div>
 </div>
</div>

<!--end::Indexcard-->


@if(request()->get('status')==null)
  <div class="row mb-5">
    <div class="col-12 col-md-2">
      <x-snippets.cards.basic class="border border-silver">
        <h5 class="">Entries</h5>
        <div class="display-1">
          <a href="{{ route('Contact.index')}}">{{$objs->total()}}</a>
        </div>
      </x-snippets.cards.basic>
    </div>
    <div class="col-12 col-md-2" >
      <x-snippets.cards.basic class="bg-light-warning border border-warning">
        <h5>Open Leads</h5>
        <div class="display-1">
          <a href="{{ route('Contact.index')}}?status=1">{{ count($data['overall'][1])}}</a>
        </div>
      </x-snippets.cards.basic>
      
    </div>
    <div class="col-12 col-md-2">
        <x-snippets.cards.basic class="bg-light-danger border border-danger">
        <h5>Cold Leads</h5>
        <div class="display-1">
          <a href="{{ route('Contact.index')}}?status=2">{{ count($data['overall'][2])}}</a>
        </div>
      </x-snippets.cards.basic>
    </div>
    <div class="col-12 col-md-2" >
        <x-snippets.cards.basic class="bg-light-info border border-info">
        <h5>Warm Leads</h5>
        <div class="display-1">
          <a href="{{ route('Contact.index')}}?status=3">{{ count($data['overall'][3])}}</a>
        </div>
      </x-snippets.cards.basic>
    </div>
    <div class="col-12 col-md-2">
        <x-snippets.cards.basic class="bg-light-primary  border border-primary">
        <h5>Prospects</h5>
        <div class="display-1">
          <a href="{{ route('Contact.index')}}?status=4">{{ count($data['overall'][4])}}</a>
        </div>
      </x-snippets.cards.basic>
    </div>
    <div class="col-12 col-md-2">
        <x-snippets.cards.basic class="bg-light-success border border-success">
        <h5>Customers</h5>
        <div class="display-1">
          <a href="{{ route('Contact.index')}}?status=0">{{ count($data['overall'][0])}}</a>
        </div>
      </x-snippets.cards.basic>
    </div>
  </div>
@else

@endif
  <div class="row">
  <div class="col-12 col-md-9">
  <!--begin::basic card-->
  <x-snippets.cards.basic>
    @if($objs->total()!=0)
        <div class="table-responsive">
          <table class="table table-bordered mb-0">
            <thead>
              <tr class="bg-light">
                <th scope="col">#</th>
                <th scope="col">Name </th>
                <th scope="col" style="max-width: 200px ;">Message</th>
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
                </td>
                  <td > {!! $obj->message !!}

                    @if($obj->comment )
                    <div class="bg-light rounded p-3 mt-3 mb-1">
                      <b>Comment by <span class="label label-light-white label-pill label-inline text-dark">{{$obj->user->name}}</span>
                        <span class="float-right text-muted"><small>{{ ($obj->created_at) ? $obj->updated_at->diffForHumans() : '' }}</small></span>
                      </b><br>
                      {!! $obj->comment !!}
                    </div>
                    @endif
                  </td>

                
                <td>{{ ($obj->created_at) ? $obj->created_at->diffForHumans() : '' }} </td>
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
  </div>
  <div class="col-12 col-md-3">
  <!--begin::List Widget 7-->
  <div class="card card-custom gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0">
      <h3 class="card-title font-weight-bolder text-dark">Team 
      </h3>

    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body pt-0">

    @foreach($users as $user)

    <div class="mb-3">

        @if(isset($data['users'][$user->id]))
        <div class="label label-light label-pill float-md-right label-inline ml-3">{{ count($data['users'][$user->id])}}</div>
        @endif
        <div class="">{{$user->name}}</div>
    </div>
      
  @endforeach
  </div>
  <!--end::Body-->
</div>
<!--end::List Widget 7-->
                  
  </div>
  </div>
</x-dynamic-component>