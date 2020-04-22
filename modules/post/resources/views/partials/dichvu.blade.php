<div class="col-md-12 col-xs-12">
    <div class="" id="dichvu">
        <h3>CẤU HÌNH THÔNG TIN TRANG DỊCH VỤ</h3>
        <h4>Ảnh mô tả</h4>
        <div class="col-lg-12 col-xs-12">
            <div class="form-group">
                @include('lito-dashboard::components.thumbnail',[
                                   'title' => 'Ảnh mô tả',
                                   'name' => 'dichvu_anh_mota',
                                   'holder' => 'dichvu_anh_mota',
                                   'image' => $settingseo->getSeoMetaText('dichvu_anh_mota',$data->id)
                               ])
            </div>
        </div>
        <div class="col-lg-6 col-xs-12"></div>
        <h4>Dịch vụ 1</h4>
        <div class="col-lg-6 col-xs-12">
            <div class="form-group">
                <label>Tên</label>
                <input type="text"
                       class="form-control"
                       name="dichvu_name_1"
                       id="dichvu_name_1"
                       value="{{$settingseo->getSeoMetaText('dichvu_name_1',$data->id)}}"
                >
            </div>
        </div>
        <div class="col-lg-6 col-xs-12">
            <div class="form-group">
                @include('lito-dashboard::components.thumbnail',[
                                   'title' => 'Ảnh',
                                   'name' => 'dichvu_anh1',
                                   'holder' => 'dichvu_anh1',
                                   'image' => $settingseo->getSeoMetaText('dichvu_anh1',$data->id)
                               ])
            </div>
        </div>
        <div class="col-lg-12 col-xs-12">
            <div class="form-group">
                <label class="form-control-label">Mô tả</label>
                <textarea
                        class="form-control"
                        name="dichvu_mota1"
                        id="dichvu_mota1"
                        rows="4"
                >{{$settingseo->getSeoMetaText('dichvu_mota1',$data->id)}}</textarea>
            </div>
        </div>
        <h4>Dịch vụ 2</h4>
        <div class="col-lg-6 col-xs-12">
            <div class="form-group">
                <label>Tên</label>
                <input type="text"
                       class="form-control"
                       name="dichvu_name_2"
                       id="dichvu_name_2"
                       value="{{$settingseo->getSeoMetaText('dichvu_name_2',$data->id)}}"
                >
            </div>
        </div>
        <div class="col-lg-6 col-xs-12">
            <div class="form-group">
                @include('lito-dashboard::components.thumbnail',[
                                   'title' => 'Ảnh',
                                   'name' => 'dichvu_anh2',
                                   'holder' => 'dichvu_anh2',
                                   'image' => $settingseo->getSeoMetaText('dichvu_anh2',$data->id)
                               ])
            </div>
        </div>
        <div class="col-lg-12 col-xs-12">
            <div class="form-group">
                <label class="form-control-label">Mô tả</label>
                <textarea
                        class="form-control"
                        name="dichvu_mota2"
                        id="dichvu_mota2"
                        rows="4"
                >{{$settingseo->getSeoMetaText('dichvu_mota2',$data->id)}}</textarea>
            </div>
        </div>
        <h4>Dịch vụ 3</h4>
        <div class="col-lg-6 col-xs-12">
            <div class="form-group">
                <label>Tên</label>
                <input type="text"
                       class="form-control"
                       name="dichvu_name_3"
                       id="dichvu_name_3"
                       value="{{$settingseo->getSeoMetaText('dichvu_name_3',$data->id)}}"
                >
            </div>
        </div>
        <div class="col-lg-6 col-xs-12">
            <div class="form-group">
                @include('lito-dashboard::components.thumbnail',[
                                   'title' => 'Ảnh',
                                   'name' => 'dichvu_anh3',
                                   'holder' => 'dichvu_anh3',
                                   'image' => $settingseo->getSeoMetaText('dichvu_anh3',$data->id)
                               ])
            </div>
        </div>
        <div class="col-lg-12 col-xs-12">
            <div class="form-group">
                <label class="form-control-label">Mô tả</label>
                <textarea
                        class="form-control"
                        name="dichvu_mota3"
                        id="dichvu_mota3"
                        rows="4"
                >{{$settingseo->getSeoMetaText('dichvu_mota3',$data->id)}}</textarea>
            </div>
        </div>
        <div class="col-lg-12 col-xs-12">
            <div class="form-group">
                <label class="form-control-label">Nội dung</label>
                <textarea
                        class="form-control ckeditor"
                        name="dichvu_noidung"
                        parsley-trigger="change"
                >{{$settingseo->getSeoMetaText('dichvu_noidung',$data->id)}}</textarea>
            </div>
        </div>
    </div>
</div>