@extends('index')
@section('content')
<div class="row justify-content-center pad-top-50">
    <div class="col-lg-8 col-md-10 col-sm-12">
         <div class="row p-3">
             <div class="col-6">
                 <a class="btn btn-outline-info" href="/admin/messages"><i class="fa fa-backward"></i> Сообщения</a>
             </div>
             <div class="col-6 text-right">
                 <a class="btn btn-outline-info" href="/admin"><i class="fa fa-shield"></i> Admin</a>
             </div>
         </div>
         <div class="row">
             <div class="col-12">
                 <table class="table table-responsive-md">
                     <tr>
                         <td>
                             <small class="cyphers">{{ date('d/m/y | H:i', strtotime($item->created_at)) }}</small>
                         </td>
                     </tr>
                     <tr>
                         <td>
                             <small class="label">Имя:</small><br/>
                             {{ $item->name }}
                         </td>
                     </tr>
                     <tr>
                         <td>
                             <small class="label">Почта:</small><br/>
                             {{ $item->email }}
                         </td>
                     </tr>
                     <tr>
                         <td>
                             <small class="label">Сообщение:</small><br/>
                             {{ $item->text }}
                         </td>
                     </tr>
                 </table>
             </div>
         </div>
        <div class="row">
            <div class="col-12 text-right">
                <button class="btn btn-outline-danger" onclick="event.preventDefault();document.getElementById('item-del-form').submit()">Delete</button>
                <form id="item-del-form" action="{{ route('messageDel', ['item' => $item]) }}" method="post" style="display:none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


