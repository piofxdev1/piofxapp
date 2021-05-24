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
  <x-snippets.cards.indexcard title="Users"  :module="$app->module" :action="route($app->module.'.search')"  />
  <!--end::Indexcard-->
  
  <!--begin::basic card-->
  <x-snippets.cards.basic>
  <div class="row">
      <div class="col-10">
        @if($objs != '')
            <div class="table-responsive">
              <table class="table table-bordered mb-0">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name </th>
                    <th scope="col">Client</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Status</th>
                    <th scope="col">Created</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; ?>
                  @foreach($objs as $key=>$obj)  
                  <tr>
                    <th scope="row">{{$i++}}</th>
                    <td>
                      <a href=" {{ route($app->module.'.show',$obj->id) }} ">
                      {{ $obj->name }}
                      </a>
                    </td>
                    <td>{{$obj->client->name}}</td>
                    <td>{{$obj->phone}}</td>
                    <td>{{ $obj->email }}</td>
                    <td>@if($obj->status==0)
                      <span class="badge badge-warning">Inactive</span>
                      @elseif($obj->status==1)
                      <span class="badge badge-success">Active</span>
                    @endif</td>
                    <td></td>
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
     </div>
        <div class="col-2 p-5">
          <h5 class="input-label text-info">Search</h5>
          <div class="rounded mt-5" style="background-color:#DDBBFF;padding:25px;">
                <form action="{{ route($app->module.'.search') }}" method="GET">
                  <label class="input-label text-dark">Group</label>
                    <input type="text p-2" name="group" class="form-control" placeholder="By Group....">
                  <label class="input-label mt-2 text-dark">Sub Group</label>
                    <input type="text p-2" name="subgroup" class="form-control" placeholder="By Sub Group....">
                    <div class="mt-3 ml-5">
                      <button type="submit" class="btn btn-danger">Search</button>
                    </div>
                </form>
           </div>
       </div>
    </div>
  </x-snippets.cards.basic>
  <!--end::basic card-->
</x-dynamic-component>