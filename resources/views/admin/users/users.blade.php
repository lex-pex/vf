@extends('index')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-9 col-md-11 col-sm-12">
            <div class="row pad-50">
                <div class="col-6">
                    <a href="/admin"> <i class="fa fa-backward"></i> Назад в ПАНЕЛЬ</a>
                </div>
                <div class="col-6">
                    <div class="text-right"> <i class="fa fa-shield"></i> Админ | Участники</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 p-0">
                    <table class="table">
                        @foreach ($users as $user)
                            @php
                                $urn = 'profile/' . $user->id;
                                $visit = Visit::where('page', $urn)->first();
                                $visits = $visit ? $visit->amount : 0;
                            @endphp
                            <tr>
                                <td>
                                    <a href="profile/{{ $user->id }}">
                                        <img src="/public/avatars/{{ $user->avatar }}" class="vf-avatar" />
                                    </a>
                                </td>
                                <td class="p-0">
                                    <strong><a href="/profile/{{ $user->id }}">{{ $user->name }}</a></strong><br/>
                                    Регистрация:<br/><small>{{ $user->created_at->format('d / m / Y') }}</small>
                                </td>
                                <td>
                                    {{ str_limit($user->about, 150) }}
                                </td>
                                <td>
                                    <a href="{{ route('profileEdit', ['id' => $user->id]) }}"
                                       title="Редактировать">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <br/>
                                    <i style="color:#dd55dd;" class="fa fa-eye"></i>
                                    <br/>
                                    <b style="color:darkred; background: yellow; padding: 3px;"> {{ $visits }} </b>
                                </td>
                            </tr>
                            <tr style="background:#fdfdfd"><td colspan="4"> </td> </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="col-12 p-3">
                <a href="/admin"> <i class="fa fa-backward"></i> Назад в ПАНЕЛЬ</a>
            </div>
        </div>
    </div>
@endsection