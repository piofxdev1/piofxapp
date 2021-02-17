<x-dynamic-component :component="$app->componentName">
    <div class="row">
        <div class="col-12 col-lg-9 bg-white p-7 rounded-lg">
            @if($stub == 'create')
                <form action="{{ route($app->module.'.store') }}" method="POST">
            @else
                <form action="{{ route($app->module.'.update', request()->get('client.id')) }}" method="POST">
            @endif
                    <h3 class="m-0">Mode:</h3>
                    <select class="form-select mb-3" name="mode">
                        <option value="default" @if($stub == 'update'){{$settings->mode == 'default' ? 'selected' : ''}}@endif>Default</option>
                        <option value="generic" @if($stub == 'update'){{$settings->mode == 'generic' ? 'selected' : ''}}@endif>Generic</option>
                        <option value="range_percent" @if($stub == 'update'){{$settings->mode == 'range_percent' ? 'selected' : ''}}@endif>Range - Percent</option>
                        <option value="range_fixed" @if($stub == 'update'){{$settings->mode == 'range_fixed' ? 'selected' : ''}}@endif>Range - Fixed</option>
                    </select>
                    <h3 class="m-0 mt-3">Range:</h3>
                    <small class="d-block text-danger font-weight-bolder">The range will work only if mode is chosen as range</small>
                    <div class="bg-light p-5 rounded-lg mt-4">
                        <div class="d-flex justify-content-start align-items-center">
                            <div>
                                <label>Start:</label>
                                <input type="text" class="form-control" name="percent_start_1" value="@if($stub == 'update'){{ $settings->mode == 'range_percent' ? $settings->start_1 : '' }}@endif">
                            </div>
                            <div class="ml-3">
                                <label>End:</label>
                                <input type="text" class="form-control" name="percent_end_1" value="@if($stub == 'update'){{ $settings->mode == 'range_percent' ? $settings->end_1 : '' }}@endif">
                            </div>
                            <div class="ml-3">
                                <label>Percent:</label>
                                <input type="text" class="form-control" name="percent_percentage_1" value="@if($stub == 'update'){{ $settings->mode == 'range_percent' ? $settings->percent_1 : '' }}@endif">
                            </div>
                        </div>
                        <label class="mt-3 d-block">Description:</label>
                        <input type="text" class="form-control" name="percent_description_1" value="@if($stub == 'update'){{ $settings->mode == 'range_percent' ? $settings->description_1 : '' }}@endif">
                    </div>
                    <div class="bg-light p-5 rounded-lg mt-4">
                        <div class="d-flex justify-content-start align-items-center">
                            <div>
                                <label>Start:</label>
                                <input type="text" class="form-control" name="percent_start_2" value="@if($stub == 'update'){{ $settings->mode == 'range_percent' ? $settings->start_2 : '' }}@endif">
                            </div>
                            <div class="ml-3">
                                <label>End:</label>
                                <input type="text" class="form-control" name="percent_end_2" value="@if($stub == 'update'){{ $settings->mode == 'range_percent' ? $settings->end_2 : '' }}@endif">
                            </div>
                            <div class="ml-3">
                                <label>Percent:</label>
                                <input type="text" class="form-control" name="percent_percentage_2" value="@if($stub == 'update'){{ $settings->mode == 'range_percent' ? $settings->percent_2 : '' }}@endif">
                            </div>
                        </div>
                        <label class="mt-3 d-block">Description:</label>
                        <input type="text" class="form-control" name="percent_description_2" value="@if($stub == 'update'){{ $settings->mode == 'range_percent' ? $settings->description_2 : '' }}@endif">
                    </div>
                    <div class="bg-light p-5 rounded-lg mt-4">
                        <div class="d-flex justify-content-start align-items-center">
                            <div>
                                <label>Start:</label>
                                <input type="text" class="form-control" name="percent_start_3" value="@if($stub == 'update'){{ $settings->mode == 'range_percent' ? $settings->start_3 : '' }}@endif">
                            </div>
                            <div class="ml-3">
                                <label>End:</label>
                                <input type="text" class="form-control" name="percent_end_3" value="@if($stub == 'update'){{ $settings->mode == 'range_percent' ? $settings->end_3 : '' }}@endif">
                            </div>
                            <div class="ml-3">
                                <label>Percent:</label>
                                <input type="text" class="form-control" name="percent_percentage_3" value="@if($stub == 'update'){{ $settings->mode == 'range_percent' ? $settings->percent_3 : '' }}@endif">
                            </div>
                        </div>
                        <label class="mt-3 d-block">Description:</label>
                        <input type="text" class="form-control" name="percent_description_3" value="@if($stub == 'update'){{ $settings->mode == 'range_percent' ? $settings->description_3 : '' }}@endif">
                    </div>

                    <div class="bg-light p-5 rounded-lg mt-4">
                        <div class="d-flex justify-content-start align-items-center">
                            <div>
                                <label>Start:</label>
                                <input type="text" class="form-control" name="fixed_start_1" value="@if($stub == 'update'){{ $settings->mode == 'range_fixed' ? $settings->start_1 : '' }}@endif">
                            </div>
                            <div class="ml-3">
                                <label>End:</label>
                                <input type="text" class="form-control" name="fixed_end_1" value="@if($stub == 'update'){{ $settings->mode == 'range_fixed' ? $settings->end_1 : '' }}@endif">
                            </div>
                            <div class="ml-3">
                                <label>Credits:</label>
                                <input type="text" class="form-control" name="fixed_credits_1" value="@if($stub == 'update'){{ $settings->mode == 'range_fixed' ? $settings->credits_1 : '' }}@endif">
                            </div>
                        </div>
                        <label class="mt-3 d-block">Description:</label>
                        <input type="text" class="form-control" name="fixed_description_1" value="@if($stub == 'update'){{ $settings->mode == 'range_fixed' ? $settings->description_1 : '' }}@endif">
                    </div>
                    <div class="bg-light p-5 rounded-lg mt-4">
                        <div class="d-flex justify-content-start align-items-center">
                            <div>
                                <label>Start:</label>
                                <input type="text" class="form-control" name="fixed_start_2" value="@if($stub == 'update'){{ $settings->mode == 'range_fixed' ? $settings->start_2 : '' }}@endif">
                            </div>
                            <div class="ml-3">
                                <label>End:</label>
                                <input type="text" class="form-control" name="fixed_end_2" value="@if($stub == 'update'){{ $settings->mode == 'range_fixed' ? $settings->end_2 : '' }}@endif">
                            </div>
                            <div class="ml-3">
                                <label>Credits:</label>
                                <input type="text" class="form-control" name="fixed_credits_2" value="@if($stub == 'update'){{ $settings->mode == 'range_fixed' ? $settings->credits_2 : '' }}@endif">
                            </div>
                        </div>
                        <label class="mt-3 d-block">Description:</label>
                        <input type="text" class="form-control" name="fixed_description_2" value="@if($stub == 'update'){{ $settings->mode == 'range_fixed' ? $settings->description_2 : '' }}@endif">
                    </div>
                    <div class="bg-light p-5 rounded-lg mt-4">
                        <div class="d-flex justify-content-start align-items-center">
                            <div>
                                <label>Start:</label>
                                <input type="text" class="form-control" name="fixed_start_3" value="@if($stub == 'update'){{ $settings->mode == 'range_fixed' ? $settings->start_3 : '' }}@endif">
                            </div>
                            <div class="ml-3">
                                <label>End:</label>
                                <input type="text" class="form-control" name="fixed_end_3" value="@if($stub == 'update'){{ $settings->mode == 'range_fixed' ? $settings->end_3 : '' }}@endif">
                            </div>
                            <div class="ml-3">
                                <label>Credits:</label>
                                <input type="text" class="form-control" name="fixed_credits_3" value="@if($stub == 'update'){{ $settings->mode == 'range_fixed' ? $settings->credits_3 : '' }}@endif">
                            </div>
                        </div>
                        <label class="mt-3 d-block">Description:</label>
                        <input type="text" class="form-control" name="fixed_description_3" value="@if($stub == 'update'){{ $settings->mode == 'range_fixed' ? $settings->description_3 : '' }}@endif">
                    </div>
                    <label class="mt-3">Default Credits:</label>
                    <input type="text" class="form-control" name="default_credits" value="@if($stub == 'update'){{ $settings->mode == 'default' ? $settings->default_credits : '' }}@endif">
                    <label class="mt-3">Minimum Redeem:</label>
                    <input type="text" class="form-control" name="min_redeem" value="@if($stub == 'update'){{ $settings->min_redeem }}@endif">
                    <label class="mt-3">Maximum Redeem:</label>
                    <input type="text" class="form-control" name="max_redeem" value="@if($stub == 'update'){{ $settings->max_redeem }}@endif">
                    @if($stub=='update')
                        <input type="hidden" name="_method" value="PUT">
                    @endif
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="text" hidden value="{{ Auth::user()->id }}" name="user_id">
                    <input type="hidden" name="agency_id" value="{{ request()->get('agency.id') }}">
                    <input type="hidden" name="client_id" value="{{ request()->get('client.id') }}">
                    <button type="submit" class="btn btn-dark mt-3">Save</button>
                </form>
        </div>
        <div class="col-12 col-lg-3">
            <div class="list-group">
				<a href="/admin" class="list-group-item list-group-item-action active">Dashboard</a>
				<a href="{{ route('Customer.index', 'all_data') }}" class="list-group-item list-group-item-action">Customers</a>
				<!-- <a href="" class="list-group-item list-group-item-action">Users</a> -->
				<a href="{{ route('Setting.create') }}" class="list-group-item list-group-item-action">Settings</a>
			</div>
        </div>
    </div>
</x-dynamic-component>