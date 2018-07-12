@extends('admin.layouts.app')
@section('content')
    <h1> Users</h1>
    <a class="btn btn-primary" href="{{route('invite.create')}}">{{ __('buttons.invite') }}</a>
@if($message = Session::get('success'))
    <div class="alert alert-success">
        {{$message}}
    </div>
    @endif
    <div class="card">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
                <th scope="col">Avatar</th>
                <th scope="col">Roles</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{++$i}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->status}}</td>
                    <th scope="col">{{!empty($user->avatar)? $user->avatar: 'No image' }}</th>
                    <td>@foreach($user->roles as $role)
                            <span class="badge badge-info">{{$role->label}}</span>
                        @endforeach
                    </td>
                    <td>
                        <a class="btn btn-info" href="{{route('users.show', $user->id)}}">{{ __('buttons.show') }}</a>
                        <a class="btn btn-primary" href="{{route('users.edit', $user->id)}}">{{ __('buttons.edit') }}</a>
                        <form action="{{route('users.destroy', $user->id)}}" method="POST" style="display: inline-block">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-danger">
                                {{ __('buttons.delete') }}
                            </button>

                        </form>

                </tr>

            @endforeach
            </tbody>
        </table>
        {{$users->links()}}
    </div>
@endsection