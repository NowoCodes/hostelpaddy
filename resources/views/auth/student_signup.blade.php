@extends('layouts.onboarding.app')
@section('title', 'HostelPaddy - Student Sign Up')

@section('content')
  @include('layouts.onboarding.signup_nav')

  <!-- Onboarding content -->

  <form action="{{ route('student.register') }}" class="form" method="POST">
    @csrf
    <div class="onboard-container">
      <div class="sign-up-onboard-text">

        <div class="icon mr-2">
          <i class="fa fa-2x fa-hotel icon-icon"></i>
        </div>
        <div class="onboard-title ml-2">
          Sign up as a Student
        </div>
      </div>

      @if ($errors->any())
        <ul>
          @foreach ($errors->all() as $errors)
            <li class="text-danger">{{ $errors }}</li>
          @endforeach
        </ul>
      @endif

      <div class="form-control sign-up">

        <!-- first part of signing up -->
        <div class="firstPart animated" id="firstPart">
          <input id="name" type="text" class="input" name="name" placeholder="Full name" required aria-required="true"
            value="{{ old('name') }}">

          <input id="email" type="email" class="input" name="email" placeholder="Email" required aria-required="true"
            value="{{ old('email') }}">

          <input id="num" type="tel" class="input" name="phone" placeholder="Phone Number" required aria-required="true"
            value="{{ old('phone') }}">

          <input id="pwd" type="password" class="input" name="password" placeholder="Password" required
            aria-required="true">
          <span class="hidePass" id="hidePass" onclick="togglePass()">Show</span>

          <input id="confirmPwd" type="password" class="input d-block remove-mt" name="password_confirmation"
            placeholder="Confirm password" required aria-required="true">

        </div>
        <!-- /first part of signing up -->

        <!-- second part of signing up -->
        <div class="secondPart animated displayNone" id="secondPart">
          <select id="userState" name="state" class="select input" type="select" value="Abia" required>
            <option value="Abia">Abia</option>
            <option value="Adamawa">Adamawa</option>
            <option value="Anambra">Anambra</option>
            <option value="Enugu">Enugu</option>
            <option value="Imo">Imo</option>
          </select>
        </div>
        <!-- /second part of signing up -->
      </div>

      <div class="consent text-left mt-3">
        By signing up, you have agreed to Hostel Paddy's <a href="{{ route('tos') }}" class="signup-link">Terms
          of
          service</a> and <a href="{{ route('privacy') }}" class="signup-link">Privacy policy</a>
      </div>


      <!-- Please add ".disabled-state" after you must have sorted the script.js file out -->
      <div class="continue-onboarding button-style enabled-state animated" id="continueOnboardingStudent">
        Continue
      </div>
      <button type="submit" class="mt-3 button-primary displayNone button-style" id="submitBtn">Finish</button>
      <!-- /Onboarding content -->

    </div>
  </form>
@endsection

@section('script')
  <script src="{{ asset('main/js/student/script.js') }}"></script>
@endsection
