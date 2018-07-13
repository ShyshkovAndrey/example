@extends('admin.layouts.app')
@section('content')
    <div class="form-group ">
        <h1>Update News</h1>
        <form action="{{route('news.destroy', ['id' => $news_meta->id, 'lang_id' => $lang_id])}}" method="POST"
              class="d-inline-block">
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
        <form action="{{route('news.update', $news_meta->id)}}" method="POST" class="d-inline-block">
            {{csrf_field()}}
            {{method_field('PATCH')}}
            <input type="hidden" name="lang_id" value="{{$lang_id}}">
            <div class="card-body">
                <div class="form-group">

                    <label for="title" class="control-label">Title</label>
                    <input type="text"
                           class="form-control"
                           id="title"
                           placeholder="Enter role name here"
                           name="title"
                           value="{{ $news_article->title }}">
                </div>
                <div class="form-group">
                    <label for="body" class="control-label">Body</label>
                    <textarea type="text"
                              class="form-control"
                              id="body"
                              placeholder="Enter body here"
                              name="body"
                    >{{ $news_article->body }}</textarea>
                </div>
                @if($lang_id == $default_language->id)
                    <div class="form-group">
                        <label class="col-md-3 m-t-15">Status</label>
                        <div class="col-md-9">
                            <select class="select2 form-control custom-select" style="width: 100%; height:36px;"
                                    name="status">
                                <option value="DRAFT" @if($news_meta->status == 'DRAFT') selected @endif>DRAFT</option>
                                <option value="PUBLISHED" @if($news_meta->status == 'PUBLISHED') selected @endif>
                                    PUBLISHED
                                </option>
                            </select>
                        </div>
                    </div>
                @endif
                <div class="border-top">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary">{{ __('buttons.update') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection