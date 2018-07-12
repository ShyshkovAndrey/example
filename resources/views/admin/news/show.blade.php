@extends('admin.layouts.app')
@section('content')
    <div class="form-group ">
        <h1> Viewing News</h1>
        <a class="btn btn-primary" href="{{route('news.edit', $news->id)}}">{{ __('buttons.edit') }}</a>
        <form action="{{route('news.destroy', $news->id)}}" method="POST" class="d-inline-block">

            {{csrf_field()}}
            {{method_field('DELETE')}}
            <button type="submit" class="btn btn-danger">
                {{ __('buttons.delete') }}
            </button>
        </form>
        <a class="btn btn-warning" href="{{route('news.index')}}">{{ __('buttons.back') }}</a>
    </div>

        <ul class="nav nav-tabs">
            @foreach($locales as $index => $locale)
                <li class="nav-item">
                    <a class="nav-link @if($index == 0) active @endif" data-toggle="tab" href="#{{$locale}}">{{$locale}}</a>
                </li>
            @endforeach

        </ul>

    <div class="tab-content">
        @foreach($locales as $index => $locale)
            @if($locale == 'en')
            <div class="tab-pane container @if($index == 0) active @endif" id="{{$locale}}">

                <div class="card">
                    <div class="card-header">Title</div>
                    <div class="card-body">{{ $news->title }}</div>
                </div>
                <div class="card">
                    <div class="card-header">Excerpt</div>
                    <div class="card-body">{{ $news->excerpt }}</div>
                </div>
                <div class="card">
                    <div class="card-header">Body</div>
                    <div class="card-body">{{ $news->body }}</div>
                </div>

            </div>
            @else
                @foreach($news->newsTranslated as $news)


                    <div class="tab-pane container @if($index == 0) active @endif" id="{{$locale}}">

                        <div class="card">
                            <div class="card-header">Title</div>
                            <div class="card-body">{{ $news->title }}</div>
                        </div>
                        <div class="card">
                            <div class="card-header">Excerpt</div>
                            <div class="card-body">{{ $news->excerpt }}</div>
                        </div>
                        <div class="card">
                            <div class="card-header">Body</div>
                            <div class="card-body">{{ $news->body }}</div>
                        </div>

                    </div>
                @endforeach

                @endif
        @endforeach
    </div>

    <div class="card">
        <div class="card-header">Status</div>
        <div class="card-body">{{ $news->status }}</div>
    </div>
    <div class="card">
        <div class="card-header">Created At</div>
        <div class="card-body">{{ date('F d, Y', strtotime($news->created_at)) }}</div>
    </div>

@endsection