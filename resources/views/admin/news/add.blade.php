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

            </div>

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