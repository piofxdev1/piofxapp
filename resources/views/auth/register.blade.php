<x-dynamic-component :component="$app->componentName" class="mt-4" >
        <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <!--begin::Form-->
        <form method="POST" action="{{ route('register') }}">
            @csrf
                    <!--begin::Title-->
                    <div class="pb-13 pt-lg-0 pt-5">
                    <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Sign Up</h3>
                    <span class="text-muted font-weight-bold font-size-h4">Enter your details to create your account</span>
                    </div>
                    <!--end::Title-->
                    <!-- Name -->
                    <div class="form-group">
                        <label class="font-size-h6 font-weight-bolder text-dark" for="name" :value="__('Name')">Name</label>
                        <input id="name" class="form-control form-control-solid h-auto py-4 px-4 rounded-lg" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="off" />
                    </div>

                    <!-- Email Address -->
                    <div class="form-group">
                        <label class="font-size-h6 font-weight-bolder text-dark" for="email" :value="__('Email')">Email</label>
                        <input id="email" class="form-control form-control-solid h-auto py-4 px-4 rounded-lg" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="off" />
                    </div>

                    <!-- Phone number -->
                    <div class="form-group">
                        <label class="font-size-h6 font-weight-bolder text-dark" for="phone" :value="__('Phone')">Phone</label>
                        <input id="phone" class="form-control form-control-solid h-auto py-4 px-4 rounded-lg" type="phone" name="phone" value="{{ old('phone') }}" required autofocus autocomplete="off" />
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label class="font-size-h6 font-weight-bolder text-dark" for="password" :value="__('Password')" >Password</label>
                        <input id="password" class="form-control form-control-solid h-auto py-4 px-4 rounded-lg" type="password" name="password" value="{{ old('password') }}" required autocomplete="new-password" />
                    </div>

                    <!-- Confirm Password -->
                    
                    <div class="form-group">
                        <label class="font-size-h6 font-weight-bolder text-dark" for="password_confirmation" :value="__('Confirm Password')" >Confrim Password</label>
                        <input id="password_confirmation" class="form-control form-control-solid h-auto py-4 px-4 rounded-lg" type="password" name="password_confirmation" />
                    </div>
                    
                    <!--begin::Action-->
                    <div class="pb-lg-4 pb-5 d-flex align-items-center ">
                    <div>
                    <button type="submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">Register</button>
                    </div>
                    <div class="pb-lg-0 pb-5 ml-3">
                    <a href="{{ route('login')}}"  class="text-muted font-size-h6 font-weight-bolder text-hover-primary pt-5">Already registered?</a>                
                    </div>
                    </div>
                    <!--end::Action-->
                
        </form>
    <!--end::Form-->    
</x-dynamic-component>
