@extends('admin.layouts.app')
@section('content')
    <div class="form-group ">
        <h1> Update Role</h1>
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

        <form action="{{route('users.update', $user ->id)}}" method="POST" class="d-inline-block">
            {{csrf_field()}}
            {{method_field('PATCH')}}
            <div class="card-body">

                <div class="form-group">
                    @if ($errors->has('name'))

                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <label for="name" class="control-label">Role Name</label>
                    <input type="text"
                           class="form-control"
                           id="name"
                           placeholder="Enter name"
                           name="name"
                           value="{{ $user->name}}">
                </div>
                <div class="form-group">
                    @if ($errors->has('email'))

                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <label for="label" class="control-label">Role label</label>
                    <input type="text"
                           class="form-control"
                           id="label"
                           placeholder="Enter email"
                           name="label"
                           value="{{$user ->email}}">
                </div>

                <div class="form-group">
                    <label class="control-label">Multiple Select</label>

                        <select class="select2 form-control" multiple="multiple" name="roles[]" style="height: 36px;width: 100%;">
                            @foreach($roles as $role)

                                <option value="{{$role->id}}" @if(in_array($role->name, $user_roles)) selected @endif >{{$role->label}}</option>

                                @endforeach

                        </select>
                </div>
                <div class="border-top">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary">{{ __('buttons.update') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>



@endsection