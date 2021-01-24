<!--begin::Header-->
<div id="kt_header" class="header flex-column header-fixed">
	<!--begin::Top-->
	<div class="header-top">
		<!--begin::Container-->
		<div class="container">
			<!--begin::Left-->
			<div class="d-none d-lg-flex align-items-center mr-3">
				<!--begin::Logo-->
				<a href="index.html" class="mr-20">
					<img alt="Logo" src="/piofx_white.png" class="max-h-45px" />
				</a>
				<!--end::Logo-->
				<!--begin::Tab Navs(for desktop mode)-->
				<ul class="header-tabs nav  font-size-lg" role="tablist">
					@if(isset(Session::get('settings')->topmenu))
						{!! Session::get('settings')->topmenu !!}
					@endif
				</ul>
				<!--begin::Tab Navs-->
			</div>
			<!--end::Left-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::Top-->

</div>
<!--end::Header-->