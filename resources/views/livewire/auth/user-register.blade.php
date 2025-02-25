

<div class="container">
    <div class="login-wrap">
        <div class="login-content">
            <div class="login-logo">
                <a href="#">
                    <img src="{{ asset('assets/admin/images/icon/logo.png') }}" alt="x.y.z">
                </a>
            </div>
            <div class="login-form">
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form wire:submit.prevent="register">
                    <div class="form-group">
                        <label>Username</label>
                        <input class="au-input au-input--full" type="text" wire:model="name" placeholder="Username">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
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
                    <div class="form-group">
                        <label>Password</label>
                        {{-- <input class="au-input au-input--full" type="password" wire:model="password" placeholder="Password"> --}}
                        {{-- <label for="password_confirmation" class="form-label">Confirm Password</label> --}}
                        <input type="password" id="password_confirmation" wire:model="password_confirmation" class=" au-input au-input--full" placeholder="Confirm your password">
                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    {{-- <div class="login-checkbox">
                        <label>
                            <input type="checkbox" wire:model="agree">Agree to the terms and policy
                        </label>
                        @error('agree') <span class="text-danger">{{ $message }}</span> @enderror
                    </div> --}}
                    <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Register</button>
                    <div class="social-login-content">
                        <div class="social-button">
                            <button class="au-btn au-btn--block au-btn--blue m-b-20">Register with Facebook</button>
                            <button class="au-btn au-btn--block au-btn--blue2">Register with Twitter</button>
                        </div>
                    </div>
                </form>
                <div class="register-link">
                    <p>
                        Already have an account?
                        <a href="{{ route('user.login') }}">Sign In</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>