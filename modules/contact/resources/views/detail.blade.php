@extends('lito-dashboard::master')

@section('title', 'Chi tiết tin nhắn')

@section('content')

    @php
        $user = Auth::user();
        $roles = $user->load('roles.perms');
        $permissions = $roles->roles->first()->perms;
    @endphp

    <div class="component">
        <h4 class="component-title">Chi tiết tin nhắn</h4>
        <div class="component-table">
            <div class="component-table-content">
                <ul class="list-group">
                    <li class="list-group-item">Ngày gửi : <span>{{datetoformat($data->created_at)}}</span></li>
                    <li class="list-group-item">Tên người gửi : <span>{{$data->contact_name}}</span></li>
                    <li class="list-group-item">Số điện thoại : <span> {{$data->phone}} </span></li>
                    <li class="list-group-item">Email : <span> {{$data->email}} </span></li>
                    <li class="list-group-item">Tiêu đề : <span> {{$data->contact_title}} </span></li>
                    <li class="list-group-item">Nội dung : <span> {{$data->content}} </span></li>
                    @if($data->group==2)
                    <li class="list-group-item">
                        <form method="post" action="{{ route('lito::contact.answer.post') }}">
                            @csrf
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Trả lời" name="contentt">{{ isset($data->getAnswer)?$data->getAnswer->content:'' }}</textarea>
                            </div>
                            <input type="hidden" value="{{ $data->id }}" name="contact_id">
                            <button type="submit" class="btn btn-primary">Gửi</button>
                        </form>

                    </li>
                    @endif
                    <li class="list-group-item"><a href="{{route('lito::contactgroup.index.get')}}"> <i class="fa fa-backward"></i> Quay lại danh sách</a></li>
                </ul>
            </div>
        </div>

    </div>

@endsection
