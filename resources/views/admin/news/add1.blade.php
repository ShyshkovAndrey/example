@extends('admin.layouts.app')
@section('content')

    <div class="form-group ">
        <h1> Add News</h1>

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
            <div class="card-title">
                <ul class="nav nav-tabs">
                    @foreach($languages as $language)
                    <li class="nav-item">
                        <a class="nav-link @if($language->key == 'en') active @endif" data-toggle="tab" href="#{{$language->key}}">{{$language->key}}</a>
                    </li>
                    @endforeach

                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content">
                    @foreach($languages as $language)
                    <div class="tab-pane container @if($language->key == 'en') active @endif" id="{{$language->key}}">

                        <div class="form-group">

                            <label for="title{{'_'.$language->key}}" class="control-label">Title</label>
                            <input type="text"
                                   class="form-control"
                                   id="title"
                                   placeholder="Enter title here"
                                   name="title{{'_'.$language->key}}"
                                   value="{{ old('title_'.$language->key) }}">
                        </div>

                        <div class="form-group">

                            <label for="body{{'_'.$language->key}}" class="control-label">Body</label>
                            <textarea type="text"
                                      class="form-control"
                                      id="body"
                                      placeholder="Enter body here"
                                      name="body{{'_'.$language->key}}"
                            >{{ old('body_'.$language->key) }}</textarea>
                        </div>

                    </div>
                    @endforeach
                </div>

                <div class="form-group">
                    <label class="col-md-3 m-t-15">Status</label>
                    <div class="col-md-9">
                        <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="status">
                            <option value="DRAFT"@if(old('status') == 'DRAFT') selected @endif>DRAFT</option>
                            <option value="PUBLISHED" @if(old('status') == 'PUBLISHED') selected @endif>PUBLISHED</option>
                        </select>
                    </div>
                </div>

                <div class="border-top">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary">{{ __('buttons.save') }}</button>
                    </div>
                </div>
            </div>

        </form>
    </div>


@endsection