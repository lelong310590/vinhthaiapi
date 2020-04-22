@extends('lito-dashboard::master')

@section('title', 'Sửa loại menu')

@section('content')

    <div class="component">
        <h4 class="component-title">Sửa menu</h4>

        <form action="" method="post" role="form">

            {{csrf_field()}}

            @include('lito-dashboard::components.alert')

            <input type="hidden" name="menu_id" value="{{$menu_id}}">
            <input type="hidden" name="edited_by" value="{{Auth::id()}}">

            <div class="row">
                <div class="col-xs-12 col-md-9">
                    <div class="component-wrapper">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="name">Tiêu đề menu</label>
                                    <input type="text"
                                           class="form-control"
                                           required
                                           name="name"
                                           id="input_name"
                                           value="{{$data->name}}"
                                    >
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="parent">Menu cha</label>
                                    <select name="parent" id="" class="form-control">
                                        <option value="0"> -- Là menu cha -- </option>
                                        @php
                                            optionCategory($all,0,$data->parent)
                                        @endphp
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="type">Menu dành cho ?</label>
                                    <select name="menu_type" id="type" class="form-control">
                                        <option value=""> -- Chọn -- </option>
                                        <option value="taxonomy" {{ ($data->menu_type=='taxonomy') ? 'selected' : '' }} > Danh mục tin tức </option>
                                        <option value="page" {{ ($data->menu_type=='page') ? 'selected' : '' }} > Trang tĩnh </option>
                                        <option value="link" {{ ($data->menu_type=='link') ? 'selected' : '' }} > Đường dẫn khác </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-12 node-news">
                                <div class="form-group">
                                    <label for="type">Danh mục tin tức</label>
                                    <select name="type_id" id="taxonomyid" class="form-control">
                                        <option value=""> -- Chọn -- </option>
                                        @foreach($taxonomy as $t)
                                        <option value="{{$t->id}}"
                                        {{ ($t->id == $data->type_id) ? 'selected' : ''  }}
                                        > {{$t->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-12 node-page" id="page">
                                <div class="form-group">
                                    <label for="type_id">Trỏ vào trang tin tức</label>
                                    <select name="type_id" id="pageid" class="form-control">
                                        @foreach($page as $row)
                                        <option value="{{$row->id}}"
                                        {{($row->id == $data->type_id) ? 'selected' : ''}}
                                        > {{$row->post_title}} </option>
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
                                           value="{{$data->slug}}"
                                    >
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-12 node-link">
                                <div class="form-group">
                                    <label for="type">Đường dẫn khác</label>
                                    <input type="text"
                                           class="form-control"
                                           name="url"
                                           value="{{$data->url}}"
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
                                           value="{{$data->index}}"
                                    >
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="index">Target</label>
                                    <select name="target" id="target" class="form-control">
                                        <option value="_self" {{$data->target == '_self' ? 'selected' : ''}}>_self</option>
                                        <option value="_blank" {{$data->target == '_blank' ? 'selected' : ''}}>_blank</option>
                                        <option value="_parent" {{$data->target == '_parent' ? 'selected' : ''}}>_parent</option>
                                        <option value="_top" {{$data->target == '_top' ? 'selected' : ''}}>_top</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="follow_link" style="width: 100%">Chọn làm trang chủ</label>
                                    <label class="checkbox-inline">
                                        <input type="radio" name="is_home" value="1" {{($data->is_home == 1) ? 'checked="checked"' : ''}} data-parsley-multiple="is_home" data-parsley-id="27">Có
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="radio" name="is_home" value="0" {{($data->is_home == 0) ? 'checked="checked"' : ''}} data-parsley-multiple="is_home">Không
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-3">
                    <div class="component-wrapper">
                        <div class="form-group">
                            <label for="status">Trạng thái</label>
                            <select name="status" class="form-control">
                                <option value="active" {{ ($data->status == 'active') ? 'selected' : '' }}>Kích hoạt</option>
                                <option value="disable" {{ ($data->status == 'disable') ? 'selected' : '' }}>Tạm khóa</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-default btn-full">Xác nhận sửa</button>
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
        if(nodeType.val() === 'taxonomy'){
            nodeNews.show();
        }else if (nodeType.val() === 'page'){
            nodePage.show();
        }else if(nodeType.val() === 'link'){
            nodeLink.show();
        }
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
                $('input[name="slug"]').attr('disabled', true)
                $('input[name="slug"]').val('')
            }
            else {
                nodePage.hide();
                nodeNews.hide();
                nodePage.hide();
                $('input[name="url"]').removeAttr('readonly')
                $('input[name="url"]').val('');
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