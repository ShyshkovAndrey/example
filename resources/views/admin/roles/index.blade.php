@extends('admin.layouts.app')
@section('content')
    <div class="form-group ">
        <h1>Roles</h1>
        <a class="btn btn-primary" href="{{route('roles.create')}}">{{__('buttons.add_new')}}</a>
    </div>
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
                <th scope="col">Label</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($roles as $role)
                <tr>
                    <th scope="col">{{++$i}}</th>
                    <td>{{$role->name}}</td>
                    <td>{{$role->label}}</td>
                    <td>
                        <a class="btn btn-info" href="{{route('roles.show', $role->id)}}">{{ __('buttons.show') }}</a>
                        <a class="btn btn-primary" href="{{route('roles.edit', $role->id)}}">{{ __('buttons.edit') }}</a>
                        <form action="{{route('roles.destroy', $role->id)}}" method="POST"
                              style="display: inline-block">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-danger">
                                {{ __('buttons.delete') }}
                            </button>

                        </form>

                </tr>
            @empty
                <tr>
                    <td>
                        No entries found.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>{{$roles->links()}}
@endsection