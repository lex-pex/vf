@extends('index')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9 col-md-11 col-sm-12">
        <div class="row pad-50">
            <div class="col-6">
                <h4>VF Contributors</h4>
            </div>
            <div class="col-6">
                <div class="text-right"> Участники проекта <i class="fa fa-users fa-2x"></i></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 p-0">
                <table class="table">
                    @foreach ($users as $user) @php $urn = 'profile/' . $user->id; $visit = Visit::where('page', $urn)->first(); $visits = $visit ? $visit->amount : 0; @endphp
                    <tr>
                        <td class="text-center p-0">
                            <a href="profile/{{ $user->id }}">
                                <img src="/public/avatars/{{ $user->avatar }}" class="vf-avatar" /><br/>
                                <strong>{{ $user->name }}</strong>
                            </a>
                        </td>
                        <td>
                            {{ str_limit($user->about, 150) }}
                        </td>
                        <td class="text-center" title="Всего Просмотров Профиля">
                            <br/>
                            <i style="color:#ff66ff;" class="fa fa-eye"></i>
                            <br/>
                            <i style="color:#00a594; padding:2px 5px;"> {{ $visits }} </i>
                        </td>
                    </tr>
                    <tr style="background:#fdfdfd"><td colspan="3"> </td> </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection