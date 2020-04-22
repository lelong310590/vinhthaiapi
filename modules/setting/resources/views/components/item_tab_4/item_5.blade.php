<div class="section-center-set">
    <h3 class="tab-setting-header">Thông tin Box bottom</h3>

    <div class="row">

        <div class="col-md-12">
            <div class="form-group">
                <label for="box_title_bottom_index_1">Tiêu đề box bottom 1</label>
                <input type="text"
                       class="form-control"
                       name="box_title_bottom_index_1"
                       placeholder="Nhập tiêu đề box 1"
                       value="{{$setting->getSettingMeta('box_title_bottom_index_1')}}"
                >
            </div>
            <div class="form-group">
                <label for="box_bottom_content_index_1">Nội dung box bottom 1</label>
                <textarea class="form-control ckeditor" name="box_bottom_content_index_1" rows="4">{{$setting->getSettingMeta('box_bottom_content_index_1')}}</textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="box_title_bottom_index_2">Tiêu đề box bottom 2</label>
                <input type="text"
                       class="form-control"
                       name="box_title_bottom_index_2"
                       placeholder="Nhập tiêu đề box 2"
                       value="{{$setting->getSettingMeta('box_title_bottom_index_2')}}"
                >
            </div>
            <div class="form-group">
                <label for="box_bottom_content_index_2">Nội dung box bottom 2</label>
                <textarea class="form-control ckeditor" name="box_bottom_content_index_2" rows="4">{{$setting->getSettingMeta('box_bottom_content_index_2')}}</textarea>
            </div>
        </div>


    </div>
</div>