@extends('admin.layouts.app')
@section('content')
    <div class="form-group ">
        <h1> Update Language</h1>
        <form action="{{route('languages.destroy', $language->id)}}" method="POST" class="d-inline-block">

            {{csrf_field()}}
            {{method_field('DELETE')}}
            <button type="submit" class="btn btn-danger">
                {{ __('buttons.delete') }}
            </button>
        </form>
        <a class="btn btn-warning" href="{{route('languages.index')}}">{{ __('buttons.back') }}</a>
    </div>
    <div class="card">
        @if (count($errors) > 0)

            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach($errors->all() as  $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>

            </div>
        @endif

        <form action="{{route('languages.update', $language->id)}}" method="POST" class="d-inline-block">
            {{csrf_field()}}
            {{method_field('PATCH')}}
            <div class="card-body">
                <div class="form-group">
                    <label for="key" class="control-label">Language label</label>
                    <input type="text"
                           class="form-control"
                           id="key"
                           placeholder="Enter language key here"
                           name="key"
                           value="{{$language->key}}"

                    @if( $language->default) disabled @endif>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label">Language Name</label>
                    <input type="text"
                           class="form-control"
                           id="name"
                           placeholder="Enter language name here"
                           name="name"
                           value="{{ $language->name }}">
                </div>
                <div class="form-group">
                    <label for="status">Select list:</label>
                    <select class="form-control" id="status" name="status" @if( $language->default) disabled @endif>
                        <option value="INACTIVE" @if($language->status == 'INACTIVE') selected @endif>Inactive</option>
                        <option value="ACTIVE" @if($language->status == 'ACTIVE') selected @endif>Active</option>
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