<x-app-layout title="Login" bodyClass="page-login">
  <main>
    <div class="container-small page-login">
      <div class="flex" style="gap: 5rem">
        <div class="auth-page-form">
          <div class="text-center">
            <a href="/">
              <img src="/img/logoipsum-265.svg" alt=""/>
            </a>
          </div>
          <h1 class="auth-page-title text-2xl pb-2">Login</h1>
          {{ session('error') }}
          <form action="{{ route('login.store') }}" method="post">
            @csrf
            <div class="form-group @error('email') has-error @enderror">
              <input type="email" placeholder="Your Email" name="email"
                     value="{{ old('email') }}"/>
              <div class="error-message">
                {{ $errors->first('email') }}
              </div>
            </div>
            <div class="form-group @error('password') has-error @enderror">
              <input type="password" placeholder="Your Password" name="password"/>
              <div class="error-message">
                {{ $errors->first('password') }}
              </div>
            </div>
            <div class="text-right mb-medium">
              <a href="{{ route('password.request') }}"
                 class="auth-page-password-reset">
                Forgot Password?
              </a>
            </div>
            
            <button class="btn btn-primary btn-login w-full">Login</button>
            {{--            <div class="grid grid-cols-2 gap-1 social-auth-buttons">--}}
            {{--              <x-partials.GoogleButton/>--}}
            {{--              <x-partials.FbButton/>--}}
            {{--            </div>--}}
            <x-layouts.SocialsButtons/>
            <a href="{{ route('login.oauth', 'google') }}"
               class="btn btn-default flex justify-center items-center gap-1"
            >
              <img src="/img/google.png" alt="" style="width: 20px"/>
              Google
            </a>
            
            <div class="login-text-dont-have-account">
              Don't have an account? -
              <a href="{{ route('signup') }}"> Click here to create one</a>
            </div>
          </form>
        </div>
        <div class="auth-page-image">
          <img src="/img/car-png-39071.png" alt="" class="img-responsive"/>
        </div>
      </div>
    </div>
  </main>
</x-app-layout>