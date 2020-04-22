<li>
    <div class="notification-icon">
        <i class="fa fa-ticket"></i>
    </div>
    <div class="notification-details flex-grow-1">
        <a href="{{route('lito::ticket.index.get')}}"><p class="m-0 d-flex align-items-center"><span>Ticket mới</span>
            <span class="badges badge-pill badge-primary ml-1 mr-1" style="margin-left: 15px!important"> {{$ticketnumber}} </span>
            <span class="flex-grow-1"></span>
            <span class="text-small text-muted ml-auto"></span>
        </p>
        </a>
        <p class="text-small text-muted m-0"> ...</p>
    </div>
</li>
