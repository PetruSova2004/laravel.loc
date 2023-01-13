@extends('layouts.layout')

@section('title')
    @parent:: {{ $title }}
@endsection

@section('header')
    @parent
@endsection

@section('content')
    <section class="jumbotron text-center">
        <div class="container">
            <h1>{{ $title }}</h1>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row">
                @foreach($posts as $post)
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                                 xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice"
                                 focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>
                                    Placeholder</title>
                                <rect width="100%" height="100%" fill="#55595c"/>
                                <text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                            </svg>
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{{ $post->content }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                    </div>
                                    <small class="text-muted">
                                        {{-- $post->created_at --}}
                                        {{-- \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at)->format('d M Y') --}}
                                        {{ $post->getPostDate() }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="col-md-12">
{{--                    {{$posts->appends(['test' => request()->test])->fragment('foo')->links()}} <!-- Получаем пагинацию; Передаем test как дополнительный параметр в запросе, если он будет то он запишется сюда, если он будет отсутствовать в запросе то мы просто проигнорируем его; fragment() - нужен для того чтобы указать хеш который мы будем прикреплять к запросу -->--}}
{{--                    {{ $posts->onEachSide(2)->links('vendor.pagination.my-pagination') }} <!-- в links мы передаем шаблон для показа -->--}}
                    {{$posts->onEachSide(2)->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
