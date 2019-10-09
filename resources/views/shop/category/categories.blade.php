@extends('shop.home')
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
                <a class="vf-btn-right" href="{{ route('categoryAdd') }}"><i class="fa fa-plus"></i> Добавить Категорию </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 p-0">
                <table class="table table-responsive table-striped">
                    <tr style="color:gray">
                        <th>Name</th>
                        <th>Picture</th>
                        <th>Sort</th>
                        <th><i class="fa fa-eye"></i></th>
                        <th><i class="fa fa-edit"></i></th>
                    </tr>
                    <tr>
                        <td>Главная Магазин</td>
                        <td>_</td>
                        <td>_</td>
                        @php
                            $visit = Visit::where('page', 'shop')->first();
                            $visits = $visit ? $visit->amount : 0;
                        @endphp
                        <td><b class="visits">{{ $visits }}</b></td>
                        <td>_</td>
                    </tr>
                    @foreach ($adminCategories as $cat)
                    @php
                        $urn = $cat->alias;
                        $visit = Visit::where('page', 'shop/' . $urn)->first();
                        $visits = $visit ? $visit->amount : 0;
                    @endphp
                    <tr {!! $cat->status ? '' : 'style="background-color: silver"' !!}>
                        <td style="width:30%;font-weight:bold">{{ $cat->name }}</td>
                        <td style="width:30%;padding:0"><img src="{{ $cat->image }}" height="70px"/> </td>
                        <td style="width:10%;">{{ $cat->sort }}</td>
                        <td><b style="width:10%;color:darkred;background:yellow;padding:3px">{{ $visits }}</b></td>
                        <td style="width:10%;">
                            <a href="{{ route('categoryEdit', ['category' => $cat]) }}"
                               title="Редактировать">
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    <tr><td colspan="5">{{ $cat->description }}<hr/></td></tr>
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