<div class="header-set">
    <h3 class="tab-setting-header">Thông tin header</h3>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="head_title_1">Tiêu đề lớn</label>
                <input type="text"
                       class="form-control"
                       name="head_title_1"
                       placeholder="Nhập tiêu đề lớn"
                       value="{{$setting->getSettingMeta('head_title_1')}}"
                >
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="head_title_2">Tiêu đề phụ</label>
                <input type="text"
                       class="form-control"
                       name="head_title_2"
                       placeholder="Nhập tiêu đề phụ"
                       value="{{$setting->getSettingMeta('head_title_2')}}"
                >
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="head_desc_1">Mô tả</label>
                <textarea name="head_desc_1" class="form-control ckeditor" rows="4" placeholder="Mô tả cho header">{{$setting->getSettingMeta('head_desc_1')}}</textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="head_button_1">Button 1</label>
                <input type="text"
                       class="form-control"
                       name="head_button_1"
                       placeholder="Tiêu đề nút 1"
                       value="{{$setting->getSettingMeta('head_button_1')}}"
                >
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="head_button_2">Button 2</label>
                <input type="text"
                       class="form-control"
                       name="head_button_2"
                       placeholder="Tiêu đề nút 2"
                       value="{{$setting->getSettingMeta('head_button_2')}}"
                >
            </div>
        </div>
    </div>
</div>