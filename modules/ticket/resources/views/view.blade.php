@extends('lito-dashboard::master')

@section('title', 'Chi tiết Ticket')

@section('content')

    @php
        $user = Auth::user();
        $roles = $user->load('roles.perms');
        $permissions = $roles->roles->first()->perms;
    @endphp

    <div class="component">
        <h4 class="component-title">Chi tiết Ticket</h4>

        <form action="" method="post" role="form">

            {{csrf_field()}}
            <input type="hidden" name="parent" value="{{$data->id}}" />
            <input type="hidden" name="domain" value="{{$data->domain}}" />
            <input type="hidden" name="owner" value="{{Auth::id()}}" />
            <input type="hidden" name="name" value="{{$user->full_name}}" />
            <input type="hidden" name="email" value="{{$user->email}}" />
            <input type="hidden" name="type" value="{{$type}}" />
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <div class="component-wrapper">

                        @include('lito-dashboard::components.alert')
                        <div class="row">
                            <ul class="ul_ticket">

                                <li class="li_ticket_cm_admin">
                                    <div class="name_sender">
                                        <p class="p_info_sender_name">{{$data->name}}</p>
                                        <p class="p_info_sender_email">{{$data->email}}</p>
                                        <p class="p_info_sender_time">{{datetoformat_full($data->created_at)}}</p>
                                    </div>
                                    <div class="ticket_ct_admin">
                                        <div>{{$data->content}}</div>
                                    </div>
                                </li>


                                @if(!empty($reply) && count($reply)>0)
                                    @foreach($reply as $row)
                                <li class="li_ticket_cm_{{$row->type}}">
                                    <div class="name_sender">
                                        <p class="p_info_sender_name">{{$row->name}}</p>
                                        <p class="p_info_sender_email">{{$row->email}}</p>
                                        <p class="p_info_sender_time">{{datetoformat_full($row->created_at)}}</p>
                                    </div>
                                    <div class="ticket_ct_{{$row->type}}">
                                        <div>{{$row->content}}</div>
                                    </div>
                                </li>
                                    @endforeach
                                @endif

                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="content">Nội dung phản hồi</label>
                                    <textarea type="text"
                                              class="form-control"
                                              autocomplete="off"
                                              name="content"
                                              value="{{old('content')}}"
                                              rows="5"
                                              placeholder="Nhập nội dung phản hồi"
                                              required
                                    >{{old('content')}}</textarea>
                                </div>
                                <button type="submit" class="btn btn-default btn-full">Gửi phản hồi</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>


    </div>

@endsection