@extends('layouts.app')

@section('title', isset($role) ? 'Edit Role' : 'Create Role')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')

<div class="bg-overlay"></div>

<div class="login-wrapper">

    <div class="login-card">

        <div class="brand">
            <span class="brand-icon"></span>
            <span class="brand-name">my mug</span>
        </div>

        <h1>{{ isset($role) ? 'Edit Role' : 'Create Role' }}</h1>

        <form class="login-form"
             method="POST"
             action="{{ isset($role) ? route('roles.update', $role->id) : route('roles.store') }}">

            @csrf
     
            @if(isset($role))
                 @method('PUT')
            @endif
            
            <div class="field">

                <label for="name">Role Name</label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $role->name ?? '') }}"
                    placeholder="Enter role name"
                    required
                >

                @error('name')
                    <span class="error-text">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            
            <div class="field">

                <label for="permissions">
                    Permissions
                </label>

                <div style="
                    display: flex;
                    flex-direction: column;
                    gap: 10px;
                    margin-top: 10px;
                    max-height: 300px;
                    overflow-y: auto;
                ">

                    @foreach($permissions as $permission)

                        <label style="
                            display: flex;
                            align-items: center;
                            gap: 10px;
                            cursor: pointer;
                            font-size: 14px;
                        ">

                            <input
                                type="checkbox"
                                name="permissions[]"
                                value="{{ $permission->id }}"
                                style="
                                    width: 16px;
                                    height: 16px;
                                    margin: 0;
                                    flex-shrink: 0;
                                    cursor: pointer;
                                "
                               {{ in_array(
                                   $permission->id,
                                   old('permissions', isset($role) ? $rolePermissions : [])
                               ) ? 'checked' : '' }}
                            >

                            <span>
                                {{ $permission->name }}
                            </span>

                        </label>

                    @endforeach

                </div>

                @error('permissions')
                    <span class="error-text">
                        {{ $message }}
                    </span>
                @enderror

                @error('permissions.*')
                    <span class="error-text">
                        {{ $message }}
                    </span>
                @enderror

            </div>


           
            <button type="submit" class="login-btn">
                {{ isset($role) ? 'Update Role' : 'Create Role' }}
            </button>

        </form>


        
        <p class="signup-text">

            <a href="{{ route('roles.index') }}"
               class="signup-link">
                Back to Roles
            </a>

        </p>

    </div>

</div>

@endsection