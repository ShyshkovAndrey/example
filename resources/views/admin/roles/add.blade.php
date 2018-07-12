@extends('admin.layouts.app')
@section('content')

    <div class="form-group ">
        <h1> Add Role</h1>

        <a class="btn btn-warning" href="{{route('roles.index')}}">{{ __('buttons.back') }}</a>
    </div>

    <div class="card">
        <form action="{{route('roles.store')}}" method="POST" class="d-inline-block">
            {{csrf_field()}}
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
                           placeholder="Enter role name here"
                           name="name"
                           value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    @if ($errors->has('label'))

                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('label') }}
                        </div>
                    @endif
                    <label for="label" class="control-label">Role label</label>
                    <input type="text"
                           class="form-control"
                           id="label"
                           placeholder="Enter role label here"
                           name="label"
                           value="{{old('label')}}">
                </div>

                <label for="permission">Permission</label><br>
                <a href="#" class="permission-select-all">Select all</a> / <a href="#" class="permission-deselect-all">deselect_all</a>
                <ul class="permissions checkbox">

                    @foreach($permissions as $table => $permission)
                        <li>
                            <input type="checkbox" id="{{$table}}" class="permission-group">
                            <label for="{{$table}}"><strong>{{title_case(str_replace('_',' ', $table))}}</strong></label>
                            <ul>
                                @foreach($permission as $perm)
                                    <li>
                                        <input type="checkbox"
                                               id="permission-{{$perm->id}}"
                                               name="permissions[]"
                                               class="the-permission"
                                               value="{{$perm->id}}"
                                               @if(in_array($perm->id, old('permissions', []))) checked @endif

                                        >
                                        <label for="permission-{{$perm->id}}">{{title_case(str_replace('_', ' ', $perm->name))}}</label>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>


                <div class="border-top">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary">{{ __('buttons.save') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


@endsection