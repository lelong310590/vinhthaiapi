<div class="section-center-set">
    <h3 class="tab-setting-header">Thông tin section center</h3>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="section_center_title">Tiêu đề section</label>
                <input type="text"
                       class="form-control"
                       name="section_center_title"
                       placeholder="Nhập tiêu đề cho section"
                       value="{{$setting->getSettingMeta('section_center_title')}}"
                >
            </div>
            <div class="form-group">
                <label for="section_center_desc">Mô tả section</label>
                <textarea class="form-control ckeditor" name="section_center_desc" rows="4">{{$setting->getSettingMeta('section_center_desc')}}</textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="section_center_button">Tiêu đề Button</label>
                <input type="text"
                       class="form-control"
                       name="section_center_button"
                       placeholder="Nhập tiêu đề nút"
                       value="{{$setting->getSettingMeta('section_center_button')}}"
                >
            </div>
            <div class="form-group">
                <label for="section_content_center">Nội dung section</label>
                <textarea class="form-control ckeditor" name="section_content_center" rows="4">{{$setting->getSettingMeta('section_content_center')}}</textarea>
            </div>
        </div>

    </div>
</div>