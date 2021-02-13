<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
		<meta charset="utf-8" />
		<title>Piofx Media</title>
		<meta name="description" content="Page with empty content" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		@include('components.themes.metronic7.blocks.styles')
		<link rel="shortcut icon" href="{{ asset('favicon_piofx.ico') }}" />
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body style="max-width= 100vw; overflow-x: hidden;">
            <!--begin::Main-->
            <div class="row" style="min-height: 100vh;">
                <div class="col-12 col-lg-4 text-center d-flex flex-column" style="background-color: #F2C98A;">
                    <div class="">
                        <img src="{{ asset('img/logos/piofx-black.png') }}" class="max-h-70px mt-5 mb-3" alt="" />
                        <h3 class="font-weight-bold text-center my-5" style="color: #986923;">There's only one thing that matters
                        <br /><span class="font-weight-bolder">Customer Satisfaction</span></h3>
                    </div>
                    <img src="{{ asset('themes/metronic/media/svg/illustrations/login-visual-1.svg') }}" class="img-fluid mt-auto">
                </div>
                <div class="col-12 col-lg-8 d-flex flex-column">
                    <!--begin::Container-->
                    <div class="container my-5" style="max-width: 60rem;">
                        @if($alert ?? "")
                            @guest
                                <div class="container-lg mt-3">
                                    <!--begin::Engage Widget 7-->
                                    <div class="card card-custom card-stretch gutter-b">
                                        <div class="card-body d-flex p-0">
                                            <div class="flex-grow-1 p-12 card-rounded bgi-no-repeat d-flex flex-column justify-content-center align-items-start shadow" style="background-color: #FFF4DE; background-position: right bottom; background-size: auto 100%; background-image: url({{ asset('themes/metronic/media/svg/humans/custom-8.svg') }})">
                                                <h3 class="text-danger font-weight-bolder m-0">No records found</h3>
                                                <h5 class="text-dark-50 font-size-xl font-weight-bold">Please contact the Sales Executive</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Engage Widget 7-->
                                </div>
                            @endguest
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger mt-3">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route($app->module.'.public') }}" class="mt-5">
                            <h2 class="text-center text-dark font-weight-bolder">Know your Credits <br/> <span class="text-muted"> Redeemable</span></h2>
                            <h5 class="text-muted mt-15">Enter your Phone Number:</h5>
                            <input type="text" id="phone_number_input" name="phone" class="form-control mb-3" value="{{ $phone ?? "" }}" required>
                            <button type="submit" class="btn btn-danger">Search</button>
                        </form>

                        @if($objs ?? "")
                            @if($remaining_credits ?? '')
                                <!--begin::Mixed Widget 20-->
                                <div class="card card-custom bgi-no-repeat gutter-b mt-5" style="background-color: #4AB58E; background-position: 100% bottom; background-size: auto auto; background-image: url({{ asset('themes/metronic/media/svg/humans/custom-1.svg') }})">
                                    <a class="text-decoration-none text-dark d-flex align-items-center pl-9 pt-3" href="{{ route('Customer.show', $objs[0]->customer_id) }}">
                                        <i class="flaticon-piggy-bank icon-2x text-dark mr-2 font-weight-bolder"></i>
                                        <h3 class="m-0 font-weight-bolder">Balance</h3>
                                    </a>
                                    <!--begin::Body-->
                                    <div class="card-body d-flex align-items-center">
                                        <div class="">
                                            <div class="d-flex align-items-center">
                                                <h1 class="text-white font-weight-bolder mr-3 d-flex align-items-center">{{ $remaining_credits }} Points</h1>
                                            </div>
                                            
                                            <h3 class="text-light-success ">Remaining Balance</h3>
                                        </div>
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Mixed Widget 20-->

                                @auth
                                    <!--begin::Tiles Widget 25-->
                                    <div class="card card-custom bgi-no-repeat bgi-size-cover gutter-b bg-dark" style="height: 250px; background-image: url({{ asset('themes/metronic/media/svg/patterns/taieri.svg') }}">
                                        <div class="card-body d-flex">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <form action="{{ route($app->module.'.store') }}" class="" method="POST">
                                                        @csrf
                                    
                                                        <div class="d-block d-lg-flex align-items-center">
                                                            <!-- <label>Credit:</label> -->
                                                            <input type="text" class="form-control form-control-lg" name="credit" placeholder="Credit">

                                                            <!-- <label>Redeem:</label> -->
                                                            <input type="text" class="form-control form-control-lg mt-3 mt-lg-0 ml-lg-3" name="redeem" placeholder="Redeem">
                                                        </div>

                                                        <input type="text" hidden name="phone" value="{{ $phone }}">
                                                        <button type="submit" class="btn btn-lg btn-light-danger btn-shadow font-weight-bold mt-3 px-4">Add</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Tiles Widget 25-->
                                @endauth
                            @else
                                @auth
                                    <div class="p-5 mt-5 bg-white text-dark rounded shadow">
                                        <h1 class="text-center">Create Customer</h1>
                                        <form action="{{ route('Customer.store') }}" method="POST">
                                            @csrf
                                            <div class="row g-3 mt-4">
                                                <div class="col-12 col-lg-6">
                                                    <label >Name:</label>
                                                    <input type="text" class="form-control" name="name" required>
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <label>Phone:</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">+91</span>
                                                        <input type="text" class="form-control" name="phone" id="phone_number_output" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <label class="mt-3">Email:</label>
                                            <input type="email" class="form-control" name="email" required>
                                            <label class="mt-3">Address:</label>
                                            <textarea type="text" class="form-control" name="address" required></textarea>
                                            <label class="mt-3">Credits:</label>
                                            <input type="text" class="form-control" name="credits" required>
                                            <button type="submit" class="btn btn-light-danger px-4 mt-4">Create</button>
                                        </form>
                                    </div>
                                @endauth
                            @endif
                        @endif

                    </div>
                    <!--end::Container-->
                    <div class="mt-auto">
                        @include('components.themes.metronic7.blocks.footer')
                    </div>
                </div>
            </div>
            <!-- End Main -->
		
		@include('components.themes.metronic7.blocks.scrolltop')
		@include('components.themes.metronic7.blocks.scripts')
	</body>
	<!--end::Body-->
</html>


