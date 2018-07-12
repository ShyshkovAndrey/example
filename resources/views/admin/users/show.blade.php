@extends('admin.layouts.app')
@section('content')
    <div class="form-group ">
        <h1> Viewing User</h1>
        <a class="btn btn-primary" href="{{route('users.edit', $user->id)}}">{{ __('buttons.edit') }}</a>
        <form action="{{route('users.destroy', $user->id)}}" method="POST" class="d-inline-block">

            {{csrf_field()}}
            {{method_field('DELETE')}}
            <button type="submit" class="btn btn-danger">
                {{ __('buttons.delete') }}
            </button>
        </form>
        <a class="btn btn-warning" href="{{route('users.index')}}">{{ __('buttons.back') }}</a>
    </div>
    <div class="card">
        <div class="card-header">User name</div>
        <div class="card-body">{{ $user->name }}</div>
    </div>
    <div class="card">
        <div class="card-header">Email</div>
        <div class="card-body">{{ $user->email }}</div>
    </div>
    <div class="card">
        <div class="card-header">Avatar</div>
        <div class="card-body">{{ $user->avatar }}</div>
    </div>
    <div class="card">
        <div class="card-header">Status</div>
        <div class="card-body">{{ $user->status }}</div>
    </div>
    <div class="card">
        <div class="card-header">Roles</div>
        <div class="card-body">
            @foreach($roles as $role)
                <span class="badge badge-info">{{$role->label}}</span>
            @endforeach
        </div>
    </div>
    <div class="card">
        <div class="card-header">Created At</div>
        <div class="card-body">{{ date('F d, Y', strtotime($user->created_at)) }}</div>
    </div>
@endsection