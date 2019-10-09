@extends('index')
@section('content')
<div class="row justify-content-center pad-top-50">
    <div class="col-lg-8 col-md-10 col-sm-12">
        <div class="row">
            <div class="col-6">
                <a href="{{ route('admin') }}"><i class="fa fa-backward"></i> Назад в ПАНЕЛЬ</a>
            </div>
            <div class="col-6 text-right">
                Публикации<br/>
                <i class="fa fa-shield"></i> Админ-панель
            </div>
        </div>
        <div class="row pad-bot-25">
            <div class="col-12">
                <table class="table">
                    <tr>
                        <th>Name</th>
                        <th><i class="fa fa-edit"></i></th>
                    </tr>
                    @foreach ($blogPosts as $post)
                        @php
                            $category = Category::getAliasById($post->category_id);
                            $alias = $post->alias;
                            $urn = $category . '/' . $alias;
                            $visit = Visit::where('page', $urn)->first();
                            $visits = $visit ? $visit->amount : 0;
                        @endphp
                        <tr class="w3-border" {!! $post->status ? '' : 'style="background-color: silver"' !!}>
                            <td>
                            <p>
                                <a href="{{ URL::asset($urn) }}"><b>{{ $post->title }}</b></a>
                                <b style="color:darkred;float: right">{{ $category }}</b>
                            </p>
                                {{ str_limit($post->text, 130) }}
                            </td>
                            <td>
                                <a href="{{ route('postEdit', ['id' => $post->id]) }}"
                                   title="Редактировать">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <br/>
                                <a><i class="fa fa-eye"></i></a>
                                <br/>
                                <b class="visits"> {{ $visits }} </b>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="col-12 p-3">
                <a href="/admin"> <i class="fa fa-backward"></i> Назад в ПАНЕЛЬ</a>
            </div>
        </div>
    </div>
</div>
@endsection
