@extends('customlayouts.master')
@section('manage-user.user-details')
active
@endsection
@section('title')
Edit | User
@endsection
@section('page-name')
Edit User
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
</li>
<li class="breadcrumb-item" aria-current="page">All User</li>
<li class="breadcrumb-item active" aria-current="page">Edit User</li>
@endsection
@section('content')
<form id="form_validation" method="POST" action="{{ route('user.update', $user->id) }}">
    @csrf
    <div class="row">
        <div class="col-lg-6 col-12">
            {{-- <input name="_method" type="hidden" value="PUT"> --}}
            <div class="form-group">
                <input type="hidden" name="id" value="{{ $user->id }}">
                <label class="form-label">User name</label> <span class="text-primary">*</span>
                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username"
                    value="{{ $user->username }}" placeholder="Username" required autofocus>
                @error('username')
                <label id="name-error" class="error" for="name">{{ $message }}</label>
                @enderror
            </div>

            <div class="form-group ">
                <label class="form-label">Email</label> <span class="text-primary">*</span>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ $user->email }}" placeholder="Email Id" required autofocus>
                @error('email')
                <label id="email-error" class="error" for="email">{{ $message }}</label>
                @enderror
            </div>

            <div class="form-group ">
                <label class="form-label">Mobile</label> <span class="text-primary">*</span>
                <input type="tel" class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                    value="{{ $user->mobile }}" placeholder="Enter Valid Mobile number" required>
                @error('mobile')
                <label id="mobile-error" class="error" for="mobile">{{ $message }}</label>
                @enderror
            </div>
            <div class="form-group ">
                <label class="form-label">Role</label> <span class="text-primary">*</span>
                <select class="form-control select2" name="role_id" data-placeholder="Select a State"
                    style="width: 100%;">
                    <option>Select Role</option>
                    @foreach ($roles as $role)
                    <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
                @error('roles')
                <label id="roles-error" class="error" for="email">{{ $message }}</label>
                @enderror
            </div>
            <div class="form-group ">
                <label class="form-label">Can Login</label> <span class="text-primary">*</span>
                <select class="form-control select2" name="can_login" required>
                    <option value="select">Select login status</option>
                    <option value="1" {{ $user->can_login == 1 ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ $user->can_login == 0 ? 'selected' : '' }}>no</option>
                    <option value="2" {{ $user->can_login == 2 ? 'selected' : '' }}>Banned</option>
                </select>
                @error('roles')
                <label id="roles-error" class="error" for="email">{{ $message }}</label>
                @enderror
            </div>
        </div>
    </div>
    <div class="box-footer">
        <a href="{{ route('user.index') }}">
            <button type="button" class="btn btn-danger">Cancel</button>
        </a>
        <button type="submit" class="btn btn-warning">Update</button>
    </div>
</form>
@endsection
@section('script')
<script type="text/javascript">
    var test = "{{ $selectedRoles }}";
        if (test != '') {
            document.getElementById('your-select').value = test;
        }
</script>
@endsection