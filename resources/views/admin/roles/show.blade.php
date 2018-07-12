@extends('admin.layouts.app')
@section('content')
    <div class="form-group ">
        <h1> Viewing Role</h1>
        <a class="btn btn-primary" href="{{route('roles.edit', $role->id)}}">{{ __('buttons.edit') }}</a>
        <form action="{{route('roles.destroy', $role->id)}}" method="POST" class="d-inline-block">

            {{csrf_field()}}
            {{method_field('DELETE')}}
            <button type="submit" class="btn btn-danger">
                {{ __('buttons.delete') }}
            </button>
        </form>
        <a class="btn btn-warning" href="{{route('roles.index')}}">{{ __('buttons.back') }}</a>
    </div>
    <div class="card">
        <div class="card-header">Role name</div>
        <div class="card-body">{{ $role->name }}</div>
    </div>
    <div class="card">
        <div class="card-header">Role label</div>
        <div class="card-body">{{ $role->label }}</div>
    </div>
    <div class="card">
        <div class="card-header">Role permissions</div>
        <div class="card-body">
            @foreach($permissions as $permission)
                <span class="badge badge-info">{{$permission->label.' '.$permission->group}}</span>
                @endforeach
        </div>
    </div>
@endsection