<div class="header-set">
    <h3 class="tab-setting-header">Thông tin header</h3>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="head_title_vps_1">Tiêu đề nhỏ</label>
                <input type="text"
                       class="form-control"
                       name="head_title_vps_1"
                       placeholder="Nhập tiêu đề nhỏ"
                       value="{{$setting->getSettingMeta('head_title_vps_1')}}"
                >
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="head_title_vps_2">Tiêu đề lớn</label>
                <input type="text"
                       class="form-control"
                       name="head_title_vps_2"
                       placeholder="Nhập tiêu đề lớn"
                       value="{{$setting->getSettingMeta('head_title_vps_2')}}"
                >
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="head_title_vps_ani">Tiêu đề chữ chạy</label>
                <input class="form-control" type="text" name="head_title_vps_ani" value="{{$setting->getSettingMeta('head_title_vps_ani')}}" placeholder="Cách nhau bởi dấu ," />
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="head_vps_button_1">Tiêu đề button</label>
                <input type="text"
                       class="form-control"
                       name="head_vps_button_1"
                       placeholder="Tiêu đề nút 1"
                       value="{{$setting->getSettingMeta('head_vps_button_1')}}"
                >
            </div>
        </div>
    </div>
</div>