<div class="section-center-set">
    <h3 class="tab-setting-header">Thông tin Why Lito</h3>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="why_title">Tiêu đề Why Main</label>
                <input type="text"
                       class="form-control"
                       name="why_title"
                       placeholder="Nhập tiêu đề cho why"
                       value="{{$setting->getSettingMeta('why_title')}}"
                >
            </div>
            <div class="form-group">
                <label for="why_description">Mô tả Why Main</label>
                <textarea class="form-control ckeditor" name="why_description" rows="4">{{$setting->getSettingMeta('why_description')}}</textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="why_title_1">Tiêu đề why 1</label>
                <input type="text"
                       class="form-control"
                       name="why_title_1"
                       placeholder="Nhập tiêu đề why"
                       value="{{$setting->getSettingMeta('why_title_1')}}"
                >
            </div>
            <div class="form-group">
                <label for="why_content_1">Nội dung why 1</label>
                <textarea class="form-control ckeditor" name="why_content_1" rows="4">{{$setting->getSettingMeta('why_content_1')}}</textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="why_title_2">Tiêu đề why 2</label>
                <input type="text"
                       class="form-control"
                       name="why_title_2"
                       placeholder="Nhập tiêu đề why 2"
                       value="{{$setting->getSettingMeta('why_title_2')}}"
                >
            </div>
            <div class="form-group">
                <label for="why_content_2">Nội dung why 2</label>
                <textarea class="form-control ckeditor" name="why_content_2" rows="4">{{$setting->getSettingMeta('why_content_2')}}</textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="why_title_3">Tiêu đề why 3</label>
                <input type="text"
                       class="form-control"
                       name="why_title_3"
                       placeholder="Nhập tiêu đề why 3"
                       value="{{$setting->getSettingMeta('why_title_3')}}"
                >
            </div>
            <div class="form-group">
                <label for="why_content_3">Nội dung why 3</label>
                <textarea class="form-control ckeditor" name="why_content_3" rows="4">{{$setting->getSettingMeta('why_content_3')}}</textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="why_title_4">Tiêu đề why 4</label>
                <input type="text"
                       class="form-control"
                       name="why_title_4"
                       placeholder="Nhập tiêu đề why 4"
                       value="{{$setting->getSettingMeta('why_title_4')}}"
                >
            </div>
            <div class="form-group">
                <label for="why_content_4">Nội dung why 4</label>
                <textarea class="form-control ckeditor" name="why_content_4" rows="4">{{$setting->getSettingMeta('why_content_4')}}</textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="why_title_4">Tiêu đề block dự án</label>
                <input type="text"
                       class="form-control"
                       name="porfolio_title"
                       placeholder="Nhập tiêu đề"
                       value="{{$setting->getSettingMeta('porfolio_title')}}"
                >
            </div>
            <div class="form-group">
                <label for="why_content_4">Nội dung block dự án</label>
                <textarea class="form-control" name="porfolio_content" rows="4">{{$setting->getSettingMeta('porfolio_content')}}</textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="why_title_4">Tiêu đề block liên hệ</label>
                <input type="text"
                       class="form-control"
                       name="contact_headtitle"
                       placeholder="Nhập tiêu đề"
                       value="{{$setting->getSettingMeta('contact_headtitle')}}"
                >
            </div>
        </div>

    </div>
</div>