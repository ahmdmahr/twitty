@extends('layout.layout')

@section('title','Terms')


@section('content')
<div class="row">
  <div class="col-3">
      @include('includes.left-sidebar')
  </div>
<div class="col-6">
<h1>Terms and Conditions</h1>
<div>
  <p>
    
    <br>

    &emsp;Acceptance of Terms By using this app, you agree to these terms. If you don’t agree, please don’t use it.
    <br>

    &emsp;Account Responsibility You must be responsible for your account and keep your login details private. You’re responsible for all activity under your account.
    <br>


    &emsp;Content Ownership You own the content you create and share, but you give us permission to use it in connection with the app.
    <br>


    &emsp;Prohibited Conduct Don’t post anything illegal, harmful, or offensive. Don’t harass others or use the app for spam.
    <br>


    &emsp;Privacy We collect and use your personal data according to our Privacy Policy. Review it to understand how we handle your information.
    <br>


    &emsp;Changes to Terms We may update these terms from time to time. We’ll notify you of major changes, but it’s your responsibility to review them regularly.
    <br>


    &emsp;Termination We can suspend or terminate your account if you violate these terms. You can also delete your account at any time.
    <br>

    &emsp;Limitations of Liability We’re not responsible for any damages that may occur from using the app or from content posted by other users.
  </p>
</div>
</div>
<div class="col-3">
  @include('includes.search-bar')
  @include('includes.follow-box')
  </div>
@endsection