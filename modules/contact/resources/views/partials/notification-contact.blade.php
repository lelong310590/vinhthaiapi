@if (!empty($lastcontact))
    <li>
        <div class="notification-icon">
            <i class="fa fa-comment"></i>
        </div>
        <div class="notification-details flex-grow-1">
            <a href="{{route('lito::contactgroup.index.get')}}">
                <p class="m-0 d-flex align-items-center"><span>Liên hệ </span>
                    <span class="badges badge-pill badge-primary ml-1 mr-1" style="margin-left: 15px!important;">{{$contactnotread}}</span>
                    <span class="flex-grow-1"></span>
                    <span class="text-small text-muted ml-auto">{{time_elapsed_string($lastcontact->created_at)}}</span>
                </p>
            </a>
            <p class="text-small text-muted m-0">{{sub($lastcontact->contact_title,35)}} ...</p>
        </div>
    </li>
@endif