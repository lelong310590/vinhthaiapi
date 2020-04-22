@extends('lito-dashboard::master')

@section('title', 'Thêm menu')

@section('js')
    <script type="text/javascript" src="{{asset('ui/vendor/select2/dist/js/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('ui/vendor/select2/dist/js/i18n/vi.js')}}"></script>
@endsection

@section('js-init')
    <script type="text/javascript" src="{{asset('ui/vendor/select2/dist/js/init.js')}}"></script>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('ui/vendor/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('ui/vendor/select2/dist/css/select2-bootstrap.min.css')}}">
@endsection


@section('content')

    <div class="component">
        <h4 class="component-title">Thêm mới menu</h4>

        <form action="" method="post" role="form">
            {{csrf_field()}}

            @include('lito-dashboard::components.alert')

            <input type="hidden" name="menu_id" value="{{$menu_id}}">
            <input type="hidden" name="created_by" value="{{Auth::id()}}">

            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <div class="component-wrapper">
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="name">Tiêu đề menu</label>
                                    <input type="text"
                                           required
                                           autocomplete="off"
                                           class="form-control"
                                           name="name"
                                           id="input_name"
                                           parsley-trigger="change"
                                           value="{{old('name')}}"
                                    >
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="parent">Menu cha</label>
                                    <select name="parent" id="" class="form-control">
                                        <option value="0"> -- Là menu cha -- </option>
                                        @php
                                            MultiMenu($data);
                                        @endphp
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="type">Menu dành cho ?</label>
                                    <select name="menu_type" id="type" class="form-control">
                                        <option value=""> -- Chọn -- </option>
                                        <option value="taxonomy"> Danh mục </option>
                                        <option value="page"> Trang tĩnh </option>
                                        <option value="link"> Đường dẫn tùy chỉnh </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-12 node-news" id="news">
                                <div class="form-group">
                                    <label for="taxonomy_id">Trỏ vào danh mục tin</label>
                                    <select name="type_id" id="taxonomyid" class="form-control">
                                        <option value="0">---Chọn danh mục tin---</option>
                                        @foreach($taxonomy as $t)
                                        <option value="{{$t->id}}"> {{$t->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-12 node-page" id="page">
                                <div class="form-group">
                                    <label for="type_id">Trỏ vào trang tĩnh</label>
                                    <select name="type_id" id="pageid" class="form-control">
                                        <option value="0">---Chọn trang tĩnh---</option>
                                        @foreach($page as $row)
                                            <option value="{{$row->id}}"> {{$row->post_title}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="slug">Đường dẫn tĩnh</label>
                                    <input type="text"
                                           autocomplete="off"
                                           class="form-control"
                                           name="slug"
                                           id="input_slug"
                                           parsley-trigger="change"
                                           value="{{old('slug')}}"
                                    >
                                </div>
                            </div>



                            <div class="col-xs-12 col-md-12 node-link" id="link">
                                <div class="form-group">
                                    <label for="url">Đường dẫn</label>
                                    <input type="text"
                                           autocomplete="off"
                                           class="form-control"
                                           name="url"
                                           value="{{old('url')}}"
                                    >
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="index">Thứ tự</label>
                                    <input type="number"
                                           min="1"
                                           autocomplete="off"
                                           class="form-control"
                                           name="index"
                                           value="1"
                                    >
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="index">Target</label>
                                    <select name="target" id="target" class="form-control">
                                        <option value="_self">_self</option>
                                        <option value="_blank">_blank</option>
                                        <option value="_parent">_parent</option>
                                        <option value="_top">_top</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="follow_link" style="width: 100%">Chọn làm trang chủ</label>
                                    <label class="checkbox-inline">
                                        <input type="radio" name="is_home" value="1" data-parsley-multiple="is_home" data-parsley-id="27">Có
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="radio" name="is_home" value="0" checked="checked" data-parsley-multiple="is_home">Không
                                    </label>
                                </div>
                            </div>

                        </div>
                            <button type="submit" class="btn btn-default btn-full">Tạo mới</button>
                    </div>
                </div>

                <div class="col-xs-12 col-md-8">
                    <div class="component-table-content" style="margin-top: 40px">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tiêu đề menu</th>
                                    <th width="100">Thứ tự</th>
                                    <th width="150">Trạng thái</th>
                                    <th width="150"><b>Thao tác</b></th>
                                </tr>
                            </thead>
                        <tbody>
                        @forelse($data as $d)
                            @if(!empty($d['sub']))
                                <tr style="font-weight: bold">
                                    <td>{{$d['name']}}</td>
                                    <td width="80">{{$d['index']}}</td>
                                    <td width="150">{!! conver_status($d['status'], route('lito::node.status.get', ['status' =>$d['status'], 'id' => $d['id']])) !!}</td>
                                    <td width="150" class="action">

                                        <a href="{{route('lito::node.edit.get',['id'=>$d['id'],'menu_id'=>$d['menu_id']])}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                        <a href="javascript:;" class="delete-record" data-href="{{route('lito::node.delete.get',$d['id'])}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                @foreach($d['sub'] as $sub)
                                    <tr style="padding-left: 10px">
                                        <td>--- {{$sub['name']}}</td>
                                        <td width="80">{{$sub['index']}}</td>
                                        <td width="150">{!! conver_status($sub['status'], route('lito::node.status.get', ['status' => $sub['status'], 'id' => $sub['id']])) !!}</td>
                                        <td width="150" class="action">

                                            <a href="{{route('lito::node.edit.get',['id'=>$sub['id'],'menu_id'=>$sub['menu_id']])}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                            <a href="javascript:;" class="delete-record" data-href="{{route('lito::node.delete.get',$sub['id'])}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr style="font-weight: bold">
                                    <td>{{$d['name']}}</td>
                                    <td width="80">{{$d['index']}}</td>
                                    <td width="150">{!! conver_status($d['status'], route('lito::node.status.get', ['status' =>$d['status'], 'id' => $d['id']])) !!}</td>
                                    <td width="150" class="action">

                                        <a href="{{route('lito::node.edit.get',['id'=>$d['id'],'menu_id'=>$d['menu_id']])}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                        <a href="javascript:;" class="delete-record" data-href="{{route('lito::node.delete.get',$d['id'])}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="7">
                                    Chưa có bản ghi nào !
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="100%" class="table-footer">
                                    <div class="table-count"></div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    </div>
                </div>

            </div>
        </form>


    </div>

@endsection

@push('js')
    <script type="text/javascript">
        var nodeType = $('select[name="menu_type"]');
        var nodePage = $('.node-page');
        nodePage.hide();
        var nodeNews = $('.node-news');
        nodeNews.hide();
        var nodeLink = $('.node-link');
        nodeLink.hide();
        $('#pageid').attr('disabled',true);
        $('#taxonomyid').attr('disabled',true);
        nodeType.on('change', function (e) {
            var _this = $(e.currentTarget);
            var value = _this.val();
            if (value == 'taxonomy') {
                nodeNews.show();
                nodePage.hide();
                nodeLink.hide();
                $('#taxonomyid').attr('disabled',false);
                $('input[name="url"]').attr('readonly', true);
                $('#pageid').attr('disabled',true);
            }else if(value == 'page'){
                nodePage.show();
                nodeLink.hide();
                nodeNews.hide();
                $('input[name="url"]').attr('readonly', true);
                $('#pageid').attr('disabled',false);
                $('#taxonomyid').attr('disabled',true);
            }
            else if(value == 'link'){
                nodeLink.show();
                nodePage.hide();
                nodeNews.hide();
                $('input[name="url"]').attr('readonly', false)
                $('input[name="slug"]').attr('disabled',true)
                $('input[name="slug"]').val('')
            }
            else {
                nodePage.hide();
                nodeNews.hide();
                nodePage.hide();
                $('#pageid').attr('disabled',true);
                $('#taxonomyid').attr('disabled',true);
                $('input[name="url"]').removeAttr('readonly')
                $('input[name="url"]').val('');
                $('input[name="name"]').val('');
            }
        })

        $('select[id="taxonomyid"]').on('change', function (e) {
           // var data = $('#taxonomyid').val();
            var selectedData = $(this).children("option:selected").text();
            var slug = menuSlug(selectedData);
            $('input[name="slug"]').val(slug);
        });

        $('select[id="pageid"]').on('change', function (e) {
            // var data = $('#taxonomyid').val();
            var selectedData = $(this).children("option:selected").text();
            var slug = menuSlug(selectedData);
            $('input[name="slug"]').val(slug);
        });

    </script>
@endpush