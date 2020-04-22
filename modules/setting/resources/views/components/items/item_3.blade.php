<div class="box-2-set">

    <h3 class="tab-setting-header">Thông tin box 2</h3>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="box_2_small_title">Tiêu đề nhỏ</label>
                <input type="text"
                       class="form-control"
                       name="box_2_small_title"
                       placeholder="Nhập tiêu đề nhỏ"
                       value="{{$setting->getSettingMeta('box_2_small_title')}}"
                >
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="box_2_larger_title">Tiêu đề lớn</label>
                <input type="text"
                       class="form-control"
                       name="box_2_larger_title"
                       placeholder="Nhập tiêu đề lớn"
                       value="{{$setting->getSettingMeta('box_2_larger_title')}}"
                >
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="box_2_title_1">Tiêu đề box 1</label>
                <input type="text"
                       class="form-control"
                       name="box_2_title_1"
                       placeholder="Nhập tiêu đề nhỏ"
                       value="{{$setting->getSettingMeta('box_2_title_1')}}"
                >
            </div>
            <div class="form-group">
                <label for="box_2_content_1">Nội dung box 1</label>
                <textarea class="form-control" id="ckeditor1" name="box_2_content_1" rows="4">{{$setting->getSettingMeta('box_2_content_1')}}</textarea>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="box_2_title_2">Tiêu đề box 2</label>
                <input type="text"
                       class="form-control"
                       name="box_2_title_2"
                       placeholder="Nhập tiêu đề cho box 2"
                       value="{{$setting->getSettingMeta('box_2_title_2')}}"
                >
            </div>
            <div class="form-group">
                <label for="box_2_content_2">Nội dung box 2</label>
                <textarea class="form-control" name="box_2_content_2" id="ckeditor2" rows="4">{{$setting->getSettingMeta('box_2_content_2')}}</textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="box_2_title_3">Tiêu đề box 3</label>
                <input type="text"
                       class="form-control"
                       name="box_2_title_3"
                       placeholder="Nhập tiêu đề lớn"
                       value="{{$setting->getSettingMeta('box_2_title_3')}}"
                >
            </div>
            <div class="form-group">
                <label for="box_2_content_3">Nội dung box 3</label>
                <textarea class="form-control" name="box_2_content_3" id="ckeditor3" rows="4">{{$setting->getSettingMeta('box_2_content_3')}}</textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="box_2_title_4">Tiêu đề box 4</label>
                <input type="text"
                       class="form-control"
                       name="box_2_title_4"
                       placeholder="Nhập tiêu đề lớn"
                       value="{{$setting->getSettingMeta('box_2_title_4')}}"
                >
            </div>
            <div class="form-group">
                <label for="box_2_content_4">Nội dung box 4</label>
                <textarea class="form-control" name="box_2_content_4" id="ckeditor4" rows="4">{{$setting->getSettingMeta('box_2_content_4')}}</textarea>
            </div>
        </div>

    </div>

</div>