@extends('index')
@section('content')
<div class="row justify-content-center pad-top-50">
    <div class="col-lg-8 col-md-10 col-sm-12">
        <div class="col-6">
            <a href="/admin"><i class="fa fa-backward"></i> Admin Pane</a>
        </div>
        <div class="col-6 text-right">
            <i class="fa fa-shield"></i> Сообщения
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table" width="100%">
                    @foreach($items as $item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td width="10px">
                                <a href="/admin/feedback/read/{{$item->id}}">
                                    <i style="color:{{$item->status ? 'silver' : 'tomato' }}; text-shadow: 0 0 2px black" class="fa fa-circle fa-2x"></i>
                                </a>
                            </td>
                            <td class="text-center"><small class="cyphers">{{ date('d/m/y | H:i', strtotime($item->created_at)) }}</small></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection