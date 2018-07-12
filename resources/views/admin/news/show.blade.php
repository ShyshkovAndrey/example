@extends('admin.layouts.app')
@section('content')

    <div class="form-group ">
        <h1> Viewing News</h1>
        <a class="btn btn-primary" href="{{route('news.edit', $news_meta->id)}}">{{ __('buttons.edit') }}</a>
        <form action="{{route('news.destroy', $news_meta->id)}}" method="POST" class="d-inline-block">
            {{csrf_field()}}
            {{method_field('DELETE')}}
            <button type="submit" class="btn btn-danger">
                {{ __('buttons.delete') }}
            </button>
        </form>
        <a class="btn btn-warning" href="{{route('news.index')}}">{{ __('buttons.back') }}</a>
    </div>
    <div class="card">
        <div class="card-header">Title</div>
        <div class="card-body">{{ $news_article->title}}</div>
    </div>
    <div class="card">
        <div class="card-header">Body</div>
        <div class="card-body">{{ $news_article->body }}</div>
    </div>
    <div class="card">
        <div class="card-header">Status</div>
        <div class="card-body">{{ $news_meta->status }}</div>
    </div>
    <div class="card">
        <div class="card-header">Created At</div>
        <div class="card-body">{{ date('F d, Y', strtotime($news_meta->created_at)) }}</div>
    </div>

@endsection