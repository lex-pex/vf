@extends('index')
@section('content')
<div class="row justify-content-center pad-top-50">
    <div class="col-lg-8 col-md-10 col-sm-12">
        <div class="row">
            <div class="col-12 text-right">
                <strong>Рубрики</strong><br/>
                <i class="fa fa-shield"></i> Админ-панель
            </div>
        </div>
        <div class="row p-2">
            <div class="col-6">
                <a href="{{ route('admin') }}"><i class="fa fa-backward"></i> Назад в ПАНЕЛЬ</a>
            </div>
            <div class="col-6 text-right">
                <a class="vf-btn-right" href="{{ route('rubricAdd') }}"><i class="fa fa-plus"></i> Добавить рубрику </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <tr style="color: gray">
                        <th>Name</th>
                        <th>Sort</th>
                        <th><i class="fa fa-eye"></i></th>
                        <th><i class="fa fa-edit"></i></th>
                    </tr>
                    <tr>
                        <td>Главная</td>
                        <td>X</td>
                        @php
                            $visit = Visit::where('page', '/')->first();
                            $visits = $visit ? $visit->amount : 0;
                        @endphp
                        <td><b class="visits">{{ $visits }}</b></td>
                        <td>X</td>
                    </tr>
                    @foreach ($adminCategories as $cat)
                    @php
                        $urn = $cat->alias;
                        $visit = Visit::where('page', $urn)->first();
                        $visits = $visit ? $visit->amount : 0;
                    @endphp
                    <tr {!! $cat->status ? '' : 'style="background-color: silver"' !!}>
                        <td>{{ $cat->name }}</td>
                        <td>{{ $cat->sort_order }}</td>

                        <td><b style="color:darkred;background:yellow;padding:3px">{{ $visits }}</b></td>
                        <td>
                            <a href="{{ route('rubricEdit', ['category' => $cat]) }}"
                               title="Редактировать">
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="row">
            <div class="con-12 p-3">
                <a href="/admin"><i class="fa fa-backward"></i> Назад в ПАНЕЛЬ</a>
            </div>
        </div>
    </div>
</div>
@endsection