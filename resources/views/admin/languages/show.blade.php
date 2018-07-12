@extends('admin.layouts.app')
@section('content')
    <div class="form-group ">
        <h1> Viewing News</h1>
        <a class="btn btn-primary" href="{{route('languages.edit', $language->id)}}">{{ __('buttons.edit') }}</a>
        @if( !$language->default)
        <form action="{{route('languages.destroy', $language->id)}}" method="POST" class="d-inline-block">

            {{csrf_field()}}
            {{method_field('DELETE')}}
            <button type="submit" class="btn btn-danger">
                {{ __('buttons.delete') }}
            </button>
        </form>
        @endif
        <a class="btn btn-warning" href="{{route('languages.index')}}">{{ __('buttons.back') }}</a>
    </div>

    <div class="card">
        <div class="card-header">Key</div>
        <div class="card-body">{{ $language->key }}</div>
    </div>
    <div class="card">
        <div class="card-header">Name</div>
        <div class="card-body">{{ $language->name }}</div>
    </div>
    <div class="card">
        <div class="card-header">Status</div>
        <div class="card-body">{{ $language->status }}</div>
    </div>
    <div class="card">
        <div class="card-header">Created At</div>
        <div class="card-body">{{ date('F d, Y', strtotime($language->created_at)) }}</div>
    </div>

@endsection