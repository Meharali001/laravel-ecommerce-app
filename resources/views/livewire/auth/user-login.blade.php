
<div class="login-wrap">
    <div class="login-content">
        <div class="login-logo">
            <a href="#">
                <img src="{{ asset('assets/admin/images/icon/logo.png') }}" alt="X.Y.Z">
            </a>
        </div>
        <div class="login-form">
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form wire:submit.prevent="login">
                <div class="form-group">
                    <label>Email Address</label>
                    <input class="au-input au-input--full" type="email" wire:model="email" placeholder="Email">
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input class="au-input au-input--full" type="password" wire:model="password" placeholder="Password">
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="login-checkbox">
                    <label>
                        <input type="checkbox" wire:model="">Remember Me
                    </label>
                    <label>
                        <a href="#">Forgotten Password?</a>
                    </label>
                </div>
                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Sign In</button>
                <div class="social-login-content">
                    <div class="social-button">
                        <button class="au-btn au-btn--block au-btn--blue m-b-20">Sign in with Facebook</button>
                        <button class="au-btn au-btn--block au-btn--blue2">Sign in with Twitter</button>
                    </div>
                </div>
            </form>
            <div class="register-link">
                <p>
                    Don't have an account?
                    <a href="#">Sign Up Here</a>
                </p>
            </div>
        </div>
    </div>
</div>
{{-- </div> --}}