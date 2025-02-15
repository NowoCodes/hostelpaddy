@extends('layouts.students.app')

@section('styles')
  {{-- <link type="text/css" href="{{ asset('main/css/styles.css') }}" rel="stylesheet" /> --}}
@endsection

{{-- @section('title', 'Student - Home') --}}
@section('title')
  {{ auth('student')->user()->name }} - Student
@endsection

@section('content')
  <div class="container mt-5">
    {{-- Tab Navigation --}}
    <section class="d-flex justify-content-center">
      <ul class="p-3 nav nav-pills pill-color" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="pill" href="#shared-hostels">Shared hostels</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="pill" href="#my-hostels">My hostels</a>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link" data-toggle="pill" href="#saved">Saved</a>
        </li> --}}
      </ul>
    </section>

    {{-- Tab Panes --}}
    <section class="tab-content">
      <div id="shared-hostels" class="container tab-pane active">
        @include('partials.main.search-bar')
        <h1>Saved</h1>
        @include('partials.student.saved')

        <div class="my-5">
          <hr>
        </div>

        <h1>Shared Hostels</h1>
        @include('partials.student.shared-hostels')
      </div>

      <div id="my-hostels" class="container tab-pane fade">
        @include('partials.student.share-hostel-search-bar')
        @include('partials.student.my-hostels')
      </div>

      {{-- <div id="saved" class="container tab-pane fade">
        @include('partials.student.search-bar')
        @include('partials.student.saved')
      </div> --}}
    </section>
  </div>
@endsection
