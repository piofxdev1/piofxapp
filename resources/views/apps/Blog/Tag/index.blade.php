<x-dynamic-component :component="$app->componentName">
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-4 font-size-sm ">
        <li class="breadcrumb-item">
            <a href="/admin" class="text-muted text-decoration-none">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="#"  class="text-muted text-decoration-none">{{ ucfirst($app->app) }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="#"  class="text-muted text-decoration-none">{{ ucfirst($app->module) }}</a>
        </li>
    </ul>
    <!--end::Breadcrumb-->

    <!-- Actions -->
    <div class="d-flex justify-content-between align-items-center bg-white p-5 rounded shadow-sm mb-3">
        <div class="d-flex align-items-center">
            <h1 class="m-0 text-dark d-inline">Tags</h1>
        </div>
        <div class="d-flex align-items-center">
            <form action="{{ route($app->module.'.index') }}" method="GET">
                <input type="text" name="query" class="form-control" placeholder="Search..">
            </form>
            <a href="{{ route('Category.index') }}" class="btn btn-light-info font-weight-bold mx-2">Categories</a>
            <a href="{{ route('Post.list') }}" class="btn btn-light-danger font-weight-bold mx-2">Posts</a>
            <a href="{{ route($app->module.'.create') }}" class="btn btn-light-primary font-weight-bold mx-2 d-flex align-items-center"><i class="fas fa-plus fa-sm"></i> Add Record</a>
        </div>
    </div>
    <!-- End Actions -->

    <!-- Table -->
    <div class="bg-white p-3 rounded-lg shadow">
        <table class="table table-borderless bg-white">
            <tr class="border-bottom">
                <th scope="col" class="p-3">#</th>
                <th scope="col" class="p-3">Name</th>
                <th scope="col" class="p-3">Slug</th>
                <th scope="col" class="p-3 text-center">Actions</th>
            </tr>
            @foreach($objs as $key=>$obj)
            <tr class="border-bottom">
                <th scope="row" class="px-3 align-middle">{{ $key+1 }}</th>
                <td class="px-3 align-middle">{{ $obj->name }}</td>
                <td class="px-3 align-middle">{{ $obj->slug }}</td>
                <td class="px-3 align-middle">
                    <div class="d-flex justify-content-center align-items-center">

                        <!-- Edit Button -->
                        <form action="{{ route($app->module.'.edit', $obj->slug) }}">
                            <button type="submit" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2"><i class="fas fa-edit m-0"></i></button>
                        </form>
                        <!-- End Edit Button -->

                        <!-- Confirm Delete Modal Trigger -->
                        <a href="#" data-toggle="modal" class="btn btn-sm btn-default btn-text-primary btn-hover-danger btn-icon mr-2" data-target="#staticBackdrop-{{$obj->id}}"><i class="fas fa-trash-alt m-0"></i></a>
                        <!-- End Confirm Delete Modal Trigger -->

                        <!-- Confirm Delete Modal -->
                        <div class="modal fade" id="staticBackdrop-{{$obj->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Confirm Delete</h5>
                                    <button type="button" class="btn btn-xs btn-icon btn-soft-secondary" data-dismiss="modal" aria-label="Close">
                                    <svg aria-hidden="true" width="10" height="10" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                                        <path fill="currentColor" d="M11.5,9.5l5-5c0.2-0.2,0.2-0.6-0.1-0.9l-1-1c-0.3-0.3-0.7-0.3-0.9-0.1l-5,5l-5-5C4.3,2.3,3.9,2.4,3.6,2.6l-1,1 C2.4,3.9,2.3,4.3,2.5,4.5l5,5l-5,5c-0.2,0.2-0.2,0.6,0.1,0.9l1,1c0.3,0.3,0.7,0.3,0.9,0.1l5-5l5,5c0.2,0.2,0.6,0.2,0.9-0.1l1-1 c0.3-0.3,0.3-0.7,0.1-0.9L11.5,9.5z"/>
                                    </svg>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Do you want to delete this permanently?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                    <form action="{{ route($app->module.'.destroy', $obj->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger">Confirm Delete</button>
                                    </form>
                                </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Confirm Delete Modal -->
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
        {{$objs->links() ?? ''}}
    </div>
    <!-- End Table -->
</x-dynamic-component>