@extends('admin.layouts.app')
@section('content')
    <div class="form-group ">
        <h1> Update News</h1>
        <form action="{{route('news.destroy', $news->id)}}" method="POST" class="d-inline-block">

            {{csrf_field()}}
            {{method_field('DELETE')}}
            <button type="submit" class="btn btn-danger">
                {{ __('buttons.delete') }}
            </button>
        </form>
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

        <form action="{{route('news.update', $news->id)}}" method="POST" class="d-inline-block">
            {{csrf_field()}}
            {{method_field('PATCH')}}
            <div class="card-body">
                <div class="form-group">

                    <label for="title" class="control-label">Title</label>
                    <input type="text"
                           class="form-control"
                           id="title"
                           placeholder="Enter role name here"
                           name="title"
                           value="{{ $news->title }}">
                </div>

                <div class="form-group">

                    <label for="excerpt" class="control-label">Excerpt</label>
                    <textarea type="text"
                              class="form-control"
                              id="excerpt"
                              placeholder="Enter excerpt here"
                              name="excerpt"
                    >{{ $news->excerpt }}</textarea>
                </div>
                <div class="form-group">

                    <label for="body" class="control-label">Body</label>
                    <textarea type="text"
                              class="form-control"
                              id="body"
                              placeholder="Enter body here"
                              name="body"
                    >{{ $news->body }}</textarea>
                </div>
                <div class="form-group">
                    <label class="col-md-3 m-t-15">Status</label>
                    <div class="col-md-9">
                        <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="status">
                            <option value="DRAFT" @if($news->status == 'DRAFT') selected @endif>DRAFT</option>
                            <option value="PUBLISHED" @if($news->status == 'PUBLISHED') selected @endif>PUBLISHED</option>
                        </select>
                    </div>
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