@props(['title' => '', 'bodyClass' => '', 'socialAuth' => true])
<x-app-layout title="Forgot Password" bodyClass="page-login" :socialAuth="false">
  <main>
    <div class="container-small page-login">
      <div class="flex" style="gap: 5rem">
        <div class="auth-page-form">
          <div class="text-center">
            <a href="/">
              <img src="/img/logoipsum-265.svg" alt=""/>
            </a>
          </div>
          
          @session('successpassw')
          <div class="my-large">
            <div class="success-message">
              {{ session('successpassw') }}
            </div>
          </div>
          @endsession
          <h1 class="auth-page-title">Request Password Reset</h1>
          
          <form action="{{ route('password.email') }}" method="post">
            @csrf
            <div class="form-group @error('email') has-error @enderror">
              <input type="email" placeholder="Your Email" name="email"
                     value="{{ old('email') }}"/>
              <div class="error-message">
                {{ $errors->first('email') }}
              </div>
            </div>
            
            <button class="btn btn-primary btn-login w-full">
              Request password reset
            </button>
            
            <div class="login-text-dont-have-account">
              Already have an account? -
              <a href="{{ route('login') }}"> Click here to login </a>
            </div>
          </form>
          
          @if ($socialAuth)
            <x-layouts.SocialsButtons/>
          @endif
          @isset($footerLink)
            <div class="login-text-dont-have-account">
              {{ $footerLink }}
            </div>
          @endisset
        </div>
        <div class="auth-page-image">
          <img src="/img/car-png-39071.png" alt="" class="img-responsive"/>
        </div>
      </div>
    </div>
  </main>

</x-app-layout>
