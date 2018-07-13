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
                @foreach($languages as $lang)
                    <th scope="col">
                        <span class="badge badge-primary">{{$lang->key}}</span>
                    </th>
                @endforeach
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($news_metas as $news_meta)
                <tr>
                    <th scope="col">{{$news_meta->id}}</th>
                    <td>
                        @foreach($news_meta->newsArticles as $newsArticle)
                            @if($newsArticle->lang_id == $default_language->id)
                                {{$newsArticle->title}}
                            @endif
                        @endforeach
                    </td>
                    <td>{{$news_meta->status}}</td>
                    <td>{{ date('F d, Y', strtotime($news_meta->created_at)) }}</td>
                    @foreach($languages as $lang)
                        @if($newsArticle->lang_id == $lang->id)
                            <td>
                                <a class="badge btn-info"
                                   href="{{route('news.show', ['id' => $news_meta->id, 'lang_id' => $lang->id])}}">Show</a>
                                <a class="badge btn-info"
                                   href="{{route('news.edit', ['id' => $news_meta->id, 'lang_id' => $lang->id])}}">Edit</a>
                            </td>
                        @else
                            <td>
                                <a class="badge badge-danger"
                                   href="{{route('news.create', ['id' => $news_meta->id, 'lang_id' => $lang->id])}}">Add</a>
                            </td>
                        @endif
                    @endforeach
                    <td>
                        <a class="btn btn-info"
                           href="{{route('news.show', ['id' => $news_meta->id, 'lang_id' => 1])}}">{{ __('buttons.show') }}</a>
                        <a class="btn btn-primary"
                           href="{{route('news.edit', $news_meta->id)}}">{{ __('buttons.edit') }}</a>
                        <form action="{{route('news.destroy', $news_meta->id)}}" method="POST"
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
    </div>{{$news_metas->links()}}
@endsection