<div>
    <!-- Styles scoped to this login component: card size, background, and underline inputs -->
    <style>
        .login-card { width: 120%; min-width: 0;  border: 10px solid grey; }
        .login-card .card-body { padding: 1.5rem; }
       .underline-input {
    width: 100% !important;
    box-sizing: border-box;

    padding-left: 0 !important;
    padding-right: 0 !important;

    border: 0 !important;
    border-bottom: 1px solid #d1d5db !important;

    border-radius: 0 !important;
    box-shadow: none !important;

    background-color: transparent !important;
    color: #fff;
}

        .underline-input:focus { box-shadow: none; border-bottom-color: #0d6efd; outline: none; color: #ffffff }
        @media (max-width: 576px) { .login-card { width: 92%; } }

        .card {
    background: rgba(92, 78, 78, 0.15) !important;
    backdrop-filter: blur(12px) !important;
    -webkit-backdrop-filter: blur(12px) !important;
        text-shadow: 1px 1px #ffffff;
        color: #27173E !important;
    border-radius: 24px !important;
    box-shadow: 0 20px 50px rgba(0,0,0,0.35) !important;
    border: 1px solid rgba(255,255,255,0.25) !important;
}

    </style>
    @error('added')
    <div class="alert alert-danger">
        <div class="d-flex flex-column">
            <span>{{$message}}</span>
        </div>
    </div>
    @enderror
    <!--<div class="text-center">
        <a href="" class="navbar-brand pe-3">
            <img class="mb-6 text-center" src="}" width="200" alt="{{$set->site_name}}" loading="lazy">
        </a>
    </div>-->
   
    <div class="section mt-2 text-center">
		    <a href="{{route('home')}}" >
			<img src="{{asset('asset/images/logo.png')}}" width="150px">
			</a>
		</div>
    <div class="card rounded-5 login-card mx-auto">
        <div class="card-body p-4">
            <form class="form" wire:submit.prevent="submitLogin" method="post">
                @csrf
                
                <div class="fv-row mb-10">
                    <label class="form-label fs-6 fw-bolder ">{{__('Account ID')}}</label>
                    <input class="form-control form-control-lg underline-input" type="email" wire:model.defer="email" autocomplete="email" value="{{old('email')}}"  />
                    @error('email')
                    <span class="form-text">{{$message}}</span>
                    @enderror
                </div>
                <div class="fv-row mb-10">
                    <div class="d-flex flex-stack mb-2">
                        <label class="form-label fw-bolder text-d fs-6 mb-0">{{__('Password')}}</label>
                    </div>
                    <div class="position-relative" wire:ignore.self>
                        <input class="form-control form-control-lg underline-input" type="password" wire:model.defer="password" autocomplete="off" required data-toggle="password" id="password" />
                       
                                                <a href="{{route('user.password.request')}}" style="text-decoration: none; color: #27173E" >{{__('Forgot Password?')}}</a>

                    </div>
                    @error('password')
                    <span class="form-text">{{$message}}</span>
                    @enderror
                </div>
                
                <div class="text-center">
                    <button style="background: #0d6efd; border: none;" type="submit" class="btn btn-lg btn-info w-100 fw-bolder my-2">

                        <span wire:loading.remove wire:target="submitLogin">{{__('Sign In')}}</span>
                        <span wire:loading wire:target="submitLogin">{{__('Signing In...')}}</span>
                    </button>
                   
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
<script>
    function initPasswordToggle() {
        $('[data-toggle="password"]').each(function() {
            var input = $(this);
            var eye_btn = $(this).parent().find('.input-password');
            eye_btn.css('cursor', 'pointer').addClass('input-password-hide');
            eye_btn.on('click', function() {
                if (eye_btn.hasClass('input-password-hide')) {
                    eye_btn.removeClass('input-password-hide').addClass('input-password-show');
                    eye_btn.find('.bi').removeClass('bi-eye').addClass('bi-eye-slash')
                    input.attr('type', 'text');
                } else {
                    eye_btn.removeClass('input-password-show').addClass('input-password-hide');
                    eye_btn.find('.bi').removeClass('bi-eye-slash').addClass('bi-eye')
                    input.attr('type', 'password');
                }
            });
        });
    }
    window.livewire.on('wrongPassword', function() {
        initPasswordToggle();
    });
    document.addEventListener('livewire:load', function() {
        initPasswordToggle();
    });
    $(document).ready(function() {
        initPasswordToggle();
    });
</script>
@endpush

