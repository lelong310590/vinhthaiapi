<div class="header-set">
    <h3 class="tab-setting-header">Thông tin box vps 1</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="box_1_title_vps_main">Tiêu đề box vps Main</label>
                <input type="text"
                       class="form-control"
                       name="box_1_title_vps_main"
                       placeholder="Nhập tiêu đề"
                       value="{{$setting->getSettingMeta('box_1_title_vps_main')}}"
                >
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="box_1_title_vps_1">Tiêu đề box 1 </label>
                <input class="form-control" type="text" name="box_1_title_vps_1" value="{{$setting->getSettingMeta('box_1_title_vps_1')}}" placeholder="Nhập tiêu đề" />
            </div>
            <div class="form-group">
                <label for="box_1_content_vps_1">Nội dung box 1</label>
                <textarea class="form-control ckeditor" name="box_1_content_vps_1" rows="4">{{$setting->getSettingMeta('box_1_content_vps_1')}}</textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="box_1_title_vps_2">Tiêu đề box 2</label>
                <input type="text"
                       class="form-control"
                       name="box_1_title_vps_2"
                       value="{{$setting->getSettingMeta('box_1_title_vps_2')}}"
                >
            </div>
            <div class="form-group">
                <label for="box_1_content_vps_2">Nội dung box 2</label>
                <textarea class="form-control ckeditor" name="box_1_content_vps_2" rows="4">{{$setting->getSettingMeta('box_1_content_vps_2')}}</textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="box_1_title_vps_3">Tiêu đề box 3</label>
                <input type="text"
                       class="form-control"
                       name="box_1_title_vps_3"
                       value="{{$setting->getSettingMeta('box_1_title_vps_3')}}"
                >
            </div>
            <div class="form-group">
                <label for="box_1_content_vps_3">Nội dung box 3</label>
                <textarea class="form-control ckeditor" name="box_1_content_vps_3" rows="4">{{$setting->getSettingMeta('box_1_content_vps_3')}}</textarea>
            </div>
        </div>

    </div>

    <div class="row">

    </div>
</div>