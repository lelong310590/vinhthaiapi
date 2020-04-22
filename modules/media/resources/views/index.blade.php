@extends('lito-dashboard::master')

@section('title', 'Nội dung đa phương tiện')

@section('content')

    <div class="component">
        <h4 class="component-title">Nội dung đa phương tiện</h4>
        <div class="component-table">
            <div class="component-table-content">
                <iframe src="/cdn-filemanager" style="width: 100%; height: 750px; overflow: hidden; border: none;"></iframe>
            </div>
        </div>
    </div>

@endsection