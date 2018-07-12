@extends('admin.layouts.app')
@section('content')
    <div class="form-group ">
        <h1>News</h1>
        <a class="btn btn-primary" href="{{route('news.create')}}">{{__('buttons.add_new')}}</a>
    </div>
    @if($message = Session::get('success'))
        <div class="alert alert-success">
            {{$message}}
        </div>
    @endif

    <div class="card">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col">Status</th>
                <th scope="col">Created At</th>
                <th scope="col">
                    @foreach($languages as $lang)
                        @if(!$lang->default)
                        <span class="badge badge-light">{{$lang->key}}</span>
                        @endif
                        @endforeach
                </th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($news_articles as $news_article)

                <tr>
                    <th scope="col">{{$news_article->parent->id}}</th>
                    <td> {{$news_article->title}}</td>
                    <td>{{$news_article->parent->status}}</td>
                    <td>{{ date('F d, Y', strtotime($news_article->created_at)) }}</td>
                    <td>

                    </td>
                    <td>
                        <a class="btn btn-info" href="{{route('news.show', $news_article->parent->id)}}">{{ __('buttons.show') }}</a>
                        <a class="btn btn-primary" href="{{route('news.edit', $news_article->parent->id)}}">{{ __('buttons.edit') }}</a>

                        <form action="{{route('news.destroy', $news_article->parent->id)}}" method="POST"
                              style="display: inline-block">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-danger">
                                {{ __('buttons.delete') }}
                            </button>

                        </form>


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

    </div>{{$news_articles->links()}}
@endsection