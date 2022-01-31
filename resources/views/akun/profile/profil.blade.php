@extends('layouts.app')
@section('title','Profile')

@section('top')

   @include('layouts.top')

@endsection

@section('header')

   @include('layouts.header.header')

@endsection

@section('sidebar')

   @include('layouts.sidebar.sidebarPanitia')

@endsection

@section('bottom')

   @include('layouts.bottom')

@endsection
@section('content')
<main class="app-content">
  <div class="row user">
    <div class="col-md-12">
      <div class="profile">
        <div class="info"><img class="user-img" src="">
          <h4>John Doe</h4>
          <p>FrontEnd Developer</p>
        </div>
      </div>
    </div>

    <div class="tab-pane fade" id="user-settings">
      <div class="tile user-settings">
        <h4 class="line-head">Update Profile</h4>
        <form>
          <div class="row mb-4">
            <div class="col-md-4">
              <label></label>
              <input class="form-control" type="text">
            </div>
            <div class="col-md-4">
              <label>Last Name</label>
              <input class="form-control" type="text">
            </div>
          </div>
          <div class="row">
            <div class="col-md-8 mb-4">
              <label>Email</label>
              <input class="form-control" type="text">
            </div>
            <div class="clearfix"></div>
            <div class="col-md-8 mb-4">
              <label>Mobile No</label>
              <input class="form-control" type="text">
            </div>
            <div class="clearfix"></div>
            <div class="col-md-8 mb-4">
              <label>Office Phone</label>
              <input class="form-control" type="text">
            </div>
            <div class="clearfix"></div>
            <div class="col-md-8 mb-4">
              <label>Home Phone</label>
              <input class="form-control" type="text">
            </div>
          </div>
          <div class="row mb-10">
            <div class="col-md-12">
              <button class="btn btn-primary" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i> Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
</main>
@endsection