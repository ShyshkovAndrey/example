@extends('admin.layouts.app')
@section('content')
    <div class="form-group ">
        <h1>Languages</h1>
        <a class="btn btn-primary" href="{{route('languages.create')}}">{{__('buttons.add_new')}}</a>
    </div>
    @if($message = Session::get('success'))
        <div class="alert alert-success">
            {{$message}}
        </div>
    @endif
    @if($message = Session::get('error'))
        <div class="alert alert-danger">
            {{$message}}
        </div>
    @endif
    <div class="card">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Key</th>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($languages as $language)

                <tr>
                    <th scope="col">{{$language->id}}</th>
                    <td>{{$language->key}} </td>
                    <td>{{$language->name}} </td>
                    <td>{{$language->status}}</td>
                    <td>
                        <a class="btn btn-info" href="{{route('languages.show', $language->id)}}">{{ __('buttons.show') }}</a>
                        <a class="btn btn-primary" href="{{route('languages.edit', $language->id)}}">{{ __('buttons.edit') }}</a>
                        @if( !$language->default)
                        <form action="{{route('languages.destroy', $language->id)}}" method="POST"
                              style="display: inline-block">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-danger">
                                {{ __('buttons.delete') }}
                            </button>

                        </form>
                    @endif
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

    </div>{{$languages->links()}}
@endsection