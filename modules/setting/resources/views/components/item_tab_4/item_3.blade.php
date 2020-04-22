<div class="box-2-set">

    <h3 class="tab-setting-header">Thông tin section 2</h3>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="section_2_small_title_index">Tiêu đề nhỏ</label>
                <input type="text"
                       class="form-control"
                       name="section_2_small_title_index"
                       placeholder="Nhập tiêu đề nhỏ"
                       value="{{$setting->getSettingMeta('section_2_small_title_index')}}"
                >
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="section_2_larger_title_index">Tiêu đề lớn</label>
                <input type="text"
                       class="form-control"
                       name="section_2_larger_title_index"
                       placeholder="Nhập tiêu đề lớn"
                       value="{{$setting->getSettingMeta('section_2_larger_title_index')}}"
                >
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="section_2_desc_index">Mô tả section 2</label>
                <textarea class="form-control ckeditor" name="section_2_desc_index" rows="4">{{$setting->getSettingMeta('section_2_desc_index')}}</textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="section_2_title_index_1">Tiêu đề box 1</label>
                <input type="text"
                       class="form-control"
                       name="section_2_title_index_1"
                       placeholder="Nhập tiêu đề cho box 1"
                       value="{{$setting->getSettingMeta('section_2_title_index_1')}}"
                >
            </div>
            <div class="form-group">
                <label for="section_2_content_index_1">Nội dung box 1</label>
                <textarea class="form-control ckeditor" name="section_2_content_index_1" rows="4">{{$setting->getSettingMeta('section_2_content_index_1')}}</textarea>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="section_2_title_index_2">Tiêu đề box 2</label>
                <input type="text"
                       class="form-control"
                       name="section_2_title_index_2"
                       placeholder="Nhập tiêu đề cho box 2"
                       value="{{$setting->getSettingMeta('section_2_title_index_2')}}"
                >
            </div>
            <div class="form-group">
                <label for="section_2_content_index_2">Nội dung box 2</label>
                <textarea class="form-control ckeditor" name="section_2_content_index_2" rows="4">{{$setting->getSettingMeta('section_2_content_index_2')}}</textarea>
            </div>
        </div>

    </div>

</div>