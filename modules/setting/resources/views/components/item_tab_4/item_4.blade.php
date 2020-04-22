<div class="section-center-set">
    <h3 class="tab-setting-header">Thông tin section 3 trang chủ</h3>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="section_3_title_index">Tiêu đề section</label>
                <input type="text"
                       class="form-control"
                       name="section_3_title_index"
                       placeholder="Nhập tiêu đề cho section"
                       value="{{$setting->getSettingMeta('section_3_title_index')}}"
                >
            </div>
            <div class="form-group">
                <label for="section_3_desc_index">Mô tả section</label>
                <textarea class="form-control ckeditor" name="section_3_desc_index" rows="4">{{$setting->getSettingMeta('section_3_desc_index')}}</textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="section_3_btn_index_1">Tab 1 title button</label>
                <input type="text"
                       class="form-control"
                       name="section_3_btn_index_1"
                       placeholder="Nhập tiêu đề nút"
                       value="{{$setting->getSettingMeta('section_3_btn_index_1')}}"
                >
            </div>
            <div class="form-group">
                <label for="section_3_title_index_1">Tab 1 title box </label>
                <input type="text"
                       class="form-control"
                       name="section_3_title_index_1"
                       placeholder="Nhập tiêu đề "
                       value="{{$setting->getSettingMeta('section_3_title_index_1')}}"
                >
            </div>
            <div class="form-group">
                <label for="section_3_content_index_1">Nội dung tab 1 box</label>
                <textarea class="form-control ckeditor" name="section_3_content_index_1" rows="4">{{$setting->getSettingMeta('section_3_content_index_1')}}</textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="section_3_btn_index_2">Tab 2 title button</label>
                <input type="text"
                       class="form-control"
                       name="section_3_btn_index_2"
                       placeholder="Nhập tiêu đề nút 2"
                       value="{{$setting->getSettingMeta('section_3_btn_index_2')}}"
                >
            </div>
            <div class="form-group">
                <label for="section_3_title_index_2">Tab 2 title box </label>
                <input type="text"
                       class="form-control"
                       name="section_3_title_index_2"
                       placeholder="Nhập tiêu đề tab 2"
                       value="{{$setting->getSettingMeta('section_3_title_index_2')}}"
                >
            </div>
            <div class="form-group">
                <label for="section_3_content_index_2">Nội dung tab 2 box</label>
                <textarea class="form-control ckeditor" name="section_3_content_index_2" rows="4">{{$setting->getSettingMeta('section_3_content_index_2')}}</textarea>
            </div>
        </div>

    </div>
</div>