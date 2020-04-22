<div class="box-1-set">
    <h3 class="tab-setting-header">Thông tin box 1</h3>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="box_small_title_1">Tiêu đề nhỏ</label>
                <input type="text"
                       class="form-control"
                       name="box_small_title_1"
                       placeholder="Nhập tiêu đề nhỏ"
                       value="{{$setting->getSettingMeta('box_small_title_1')}}"
                >
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="box_larger_title_1">Tiêu đề lớn</label>
                <input type="text"
                       class="form-control"
                       name="box_larger_title_1"
                       placeholder="Nhập tiêu đề lớn"
                       value="{{$setting->getSettingMeta('box_larger_title_1')}}"
                >
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="box_title_1">Tiêu đề box 1</label>
                <input type="text"
                       class="form-control"
                       name="box_title_1"
                       placeholder="Nhập tiêu đề nhỏ"
                       value="{{$setting->getSettingMeta('box_title_1')}}"
                >
            </div>
            <div class="form-group">
                <label for="box_content_1">Nội dung box 1</label>
                <textarea class="form-control ckeditor" name="box_content_1" rows="4">{{$setting->getSettingMeta('box_content_1')}}</textarea>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="box_title_2">Tiêu đề box 2</label>
                <input type="text"
                       class="form-control"
                       name="box_title_2"
                       placeholder="Nhập tiêu đề lớn"
                       value="{{$setting->getSettingMeta('box_title_2')}}"
                >
            </div>
            <div class="form-group">
                <label for="box_content_2">Nội dung box 2</label>
                <textarea class="form-control ckeditor" name="box_content_2" rows="4">{{$setting->getSettingMeta('box_content_2')}}</textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="box_title_3">Tiêu đề box 3</label>
                <input type="text"
                       class="form-control"
                       name="box_title_3"
                       placeholder="Nhập tiêu đề lớn"
                       value="{{$setting->getSettingMeta('box_title_3')}}"
                >
            </div>
            <div class="form-group">
                <label for="box_content_3">Nội dung box 3</label>
                <textarea class="form-control ckeditor" name="box_content_3" rows="4">{{$setting->getSettingMeta('box_content_3')}}</textarea>
            </div>
        </div>

    </div>

</div>