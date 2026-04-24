@extends('admin.layouts.app')

@section('content')
<div class="admin-page admin-page--narrow">
    <section class="admin-page-header">
        <div class="admin-page-header__body">
            <p class="admin-page-header__eyebrow">User Management</p>
            <h1 class="admin-page-header__title">Create a new platform user</h1>
            <p class="admin-page-header__text">Add a super admin or organizer account with the right access level and activation status from the start.</p>
        </div>
        <div class="admin-page-actions">
            <a href="{{ url('/admin/users') }}" class="admin-btn admin-btn--secondary">Back to users</a>
        </div>
    </section>

    <form method="POST" action="{{ url('/admin/users/add') }}" class="admin-panel">
        @csrf

        <section class="admin-form-section">
            <h2 class="admin-form-section__title">Profile details</h2>
            <p class="admin-form-section__text">Start with the personal information needed to identify and contact the account holder.</p>

            <div class="admin-form-grid" style="margin-top: 20px;">
                <div class="admin-field">
                    <label for="first_name" class="admin-label">First name</label>
                    <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" class="admin-input">
                    @error('first_name')
                        <p class="admin-field__error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="admin-field">
                    <label for="last_name" class="admin-label">Last name</label>
                    <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" class="admin-input">
                    @error('last_name')
                        <p class="admin-field__error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="admin-field">
                    <label for="email" class="admin-label">Email address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" class="admin-input">
                    @error('email')
                        <p class="admin-field__error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="admin-field">
                    <label for="mobile_number" class="admin-label">Phone number</label>
                    <input id="mobile_number" type="text" name="mobile_number" value="{{ old('mobile_number') }}" class="admin-input">
                    @error('mobile_number')
                        <p class="admin-field__error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="admin-field">
                    <label for="gender" class="admin-label">Gender</label>
                    <select id="gender" name="gender" class="admin-select">
                        <option value="">Select gender</option>
                        @foreach (Gender::getAll() as $key => $value)
                            <option value="{{ $key }}" {{ old('gender') === (string) $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                    @error('gender')
                        <p class="admin-field__error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </section>

        <section class="admin-form-section">
            <h2 class="admin-form-section__title">Access and permissions</h2>
            <p class="admin-form-section__text">Choose the role, activation state, and initial credentials for the new account.</p>

            <div class="admin-form-grid" style="margin-top: 20px;">
                <div class="admin-field">
                    <label for="user_type" class="admin-label">User type</label>
                    <select id="user_type" name="user_type" class="admin-select">
                        <option value="">Select type</option>
                        @foreach (UserType::getAll() as $key => $value)
                            <option value="{{ $key }}" {{ old('user_type') === (string) $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                    @error('user_type')
                        <p class="admin-field__error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="admin-field">
                    <label for="is_active" class="admin-label">Status</label>
                    <select id="is_active" name="is_active" class="admin-select">
                        <option value="">Select status</option>
                        @foreach (ActiveStatus::getAll() as $key => $value)
                            <option value="{{ $key }}" {{ old('is_active') === (string) $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                    @error('is_active')
                        <p class="admin-field__error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="admin-field">
                    <label for="password" class="admin-label">Password</label>
                    <input id="password" type="password" name="password" class="admin-input">
                    @error('password')
                        <p class="admin-field__error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="admin-field">
                    <label for="password_confirmation" class="admin-label">Confirm password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="admin-input">
                </div>
            </div>
        </section>

        <section class="admin-form-section">
            <div class="admin-form-actions admin-form-actions--between">
                <a href="{{ url('/admin/users') }}" class="admin-btn admin-btn--secondary">Cancel</a>
                <button type="submit" class="admin-btn admin-btn--primary">Create user</button>
            </div>
        </section>
    </form>
</div>
@endsection
