<div>
    @error('added')
    <div class="alert alert-danger">
        <div class="d-flex flex-column">
            <span>{{$message}}</span>
        </div>
    </div>
    @enderror
    <div class="text-center">
        <a href="{{route('home')}}" class="navbar-brand pe-3">
            <img class="mb-6 text-center" src="{{asset('asset/images/logo.png')}}" width="200" alt="{{$set->site_name}}" loading="lazy">
        </a>
    </div>
    <div class="card rounded-5">
        <div class="card-body m-5">
            <form class="form" wire:submit.prevent="submitLogin" method="post">
                @csrf
                <div class="text-start mb-10">
                    <h1 class="text-dark mb-3 fs-2">{{__('Jump right back in')}}</h1>
                    <div class="text-dark fw-bold fs-5">{{__('New Here?')}}
                        <a href="{{route('register')}}" class="link-info fw-bolder">{{__('Create an Account')}}</a>
                    </div>
                </div>
                <div class="fv-row mb-10">
                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Email')}}</label>
                    <input class="form-control form-control-lg form-control-solid border-light" type="email" wire:model.defer="email" autocomplete="email" value="{{old('email')}}" required placeholder="name@email.com" />
                    @error('email')
                    <span class="form-text">{{$message}}</span>
                    @enderror
                </div>
                <div class="fv-row mb-10">
                    <div class="d-flex flex-stack mb-2">
                        <label class="form-label fw-bolder text-dark fs-6 mb-0">{{__('Password')}}</label>
                        <a href="{{route('user.password.request')}}" class="link-info fs-6 fw-bolder">{{__('Forgot Password ?')}}</a>
                    </div>
                    <div class="position-relative" wire:ignore.self>
                        <input class="form-control form-control-lg form-control-solid border-light" type="password" wire:model.defer="password" autocomplete="off" required data-toggle="password" id="password" placeholder="XXXXXXXXX" />
                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2 input-password" data-kt-password-meter-control="visibility">
                            <i class="bi bi-eye fs-2 text-dark"></i>
                        </span>
                    </div>
                    @error('password')
                    <span class="form-text">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-check form-check-custom form-check-solid mb-6">
                    <input class="form-check-input" type="checkbox" id="flexCheckDefault" wire:model.defer="remember_me" checked />
                    <label class="form-check-label" for="flexCheckDefault">{{__('Stayed signed in for 30 days')}}</label>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                        <span wire:loading.remove wire:target="submitLogin">{{__('Sign In')}}</span>
                        <span wire:loading wire:target="submitLogin">{{__('Signing In...')}}</span>
                    </button>
                    @if($set->google_sl == 1)
                    <a href="{{route('redirect.login', ['type' => 'google'])}}" class="btn btn-secondary btn-block btn-lg fw-bolder my-2">
                        <img alt="Logo" src="{{asset('dashboard/media/svg/brand-logos/google-icon.svg')}}" class="h-20px me-3">Sign in with Google
                    </a>
                    @endif
                    @if($set->facebook_sl == 1)
                    <a href="{{route('redirect.login', ['type' => 'facebook'])}}" class="btn btn-secondary btn-block btn-lg fw-bolder my-2">
                        <img alt="Logo" src="{{asset('dashboard/media/svg/brand-logos/facebook-icon.svg')}}" class="h-20px me-3">Sign in with Facebook
                    </a>
                    @endif
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