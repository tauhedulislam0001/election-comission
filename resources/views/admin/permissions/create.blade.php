@extends('customlayouts.master')
@section('manage-user.permission-list')
    active
@endsection
@section('title')
    Create | Permission
@endsection
@section('page-name')
    Create Permission
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item" aria-current="page">Permissions</li>
    <li class="breadcrumb-item active" aria-current="page">Create Permission</li>
@endsection
@section('content')
    <form method="POST" action="{{ route('permissions.store') }}" novalidate>
        @csrf
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="form-group">
                    <h5>Permission Name<span class="text-warning">*</span></h5>
                    <div class="controls">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" required>
                        @error('name')
                            <label id="name-error" class="error" for="name">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="form-group">
                    <h5>Group Name<span class="text-warning">*</span></h5>
                    <div class="controls">
                        <input type="text" class="form-control @error('group_name') is-invalid @enderror" name="group_name"
                            value="{{ old('group_name') }}" required>
                        @error('group_name')
                            <label id="group_name-error" class="error" for="group_name">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <a href="{{ route('permissions.index') }}">
                <button type="button" class="btn btn-danger">Cancel</button>
            </a>
            <button type="submit" class="btn btn-success">Save</button>
            {{-- <button type="button" class="btn btn-success" onclick="saveCategory()">Save</button> --}}
        </div>
    </form>
@endsection
@section('script')

@endsection
