@extends('customlayouts.master')
@section('title')
    User | Change Password
@endsection
@section('page-name')
    Change Password
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item" aria-current="page">Change Password</li>
    <li class="breadcrumb-item active" aria-current="page">{{ Auth::user()->username }}</li>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="box">
                <div class="box-header with-border text-center">
                    <h4 class="box-title">Change Password</h4>
                </div>
                <!-- /.box-header -->
                <form class="form" method="POST" action="{{ route('admin.change-password.update') }}">
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="password" name="current_password" class="form-control"
                                        placeholder="Current password">
                                    @error('current_password')
                                        <span class="text-primary">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="password" name="new_password" class="form-control"
                                        placeholder="New password">
                                    @error('new_password')
                                        <span class="text-primary">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="password" name="password_confirmation" class="form-control"
                                        placeholder="Re-type password">
                                    @error('password_confirmation')
                                        <span class="text-primary">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{ route('admin.dashboard') }}">
                                <button type="button" class="btn btn-warning mr-1">Cancel</button>
                            </a>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
