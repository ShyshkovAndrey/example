@extends('admin.layouts.app')
@section('content')
    <div class="form-group ">
        <h1> Add News
            @if(isset($lang_id))
                @foreach($languages as $language)
                    @if($language->id == $lang_id)
                        {{$language->name}}
                    @endif
                @endforeach
            @else
                default
            @endif
        </h1>
        <a class="btn btn-warning" href="{{route('news.index')}}">{{ __('buttons.back') }}</a>
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
        <form action="{{route('news.store')}}" method="POST" class="d-inline-block">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$id}}">
            <input type="hidden" name="lang_id" value="{{$lang_id}}">
            <div class="card-body">
                <div class="form-group">
                    <label for="title" class="control-label">Title</label>
                    <input type="text"
                           class="form-control"
                           id="title"
                           placeholder="Enter title here"
                           name="title"
                           value="{{ old('title') }}">
                </div>
                <div class="form-group">

                    <label for="body" class="control-label">Body</label>
                    <textarea type="text"
                              class="form-control"
                              id="body"
                              placeholder="Enter body here"
                              name="body"
                    >{{ old('body') }}</textarea>
                </div>
            </div>
            @if(!isset($id))
                <div class="form-group">
                    <label class="col-md-3 m-t-15">Status</label>
                    <div class="col-md-9">
                        <select class="select2 form-control custom-select" style="width: 100%; height:36px;"
                                name="status">
                            <option value="DRAFT" @if(old('status') == 'DRAFT') selected @endif>DRAFT</option>
                            <option value="PUBLISHED" @if(old('status') == 'PUBLISHED') selected @endif>PUBLISHED
                            </option>
                        </select>
                    </div>
                </div>
            @endif
            <div class="border-top">
                <div class="card-body">
                    <button type="submit" class="btn btn-primary">{{ __('buttons.save') }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection