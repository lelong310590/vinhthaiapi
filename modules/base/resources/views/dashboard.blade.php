@extends('lito-dashboard::master')

@section('title', 'Bảng điều khiển')

@section('content')

<div class="dashboard-wrapper">
    <h4 class="component-title">Bảng điều khiển</h4>

    <div class="dashboard-content">
        <div class="row">
            @php do_action('lito-register-dashboard-widget') @endphp
        </div>
    </div>
</div>

@endsection