<div class="col-md-12 col-xs-12">
    <div class="" id="googleads">
        <h3>CẤU HÌNH THÔNG TIN TRANG GOOGLE ADS</h3>
        <div class="col-lg-12 col-xs-12">
            <div class="form-group">
                <label>Tiêu đề lớn</label>
                <input type="text"
                       class="form-control"
                       name="ggads_title"
                       id="ggads_title"
                       value="{{$settingseo->getSeoMetaText('ggads_title',$data->id)}}"
                >
            </div>
        </div>
        <div class="col-lg-12 col-xs-12">
            <div class="form-group">
                <label class="form-control-label">Mô tả ngắn</label>
                <textarea
                        class="form-control"
                        name="ggads_mota"
                        id="ggads_mota"
                        rows="4"
                >{{$settingseo->getSeoMetaText('ggads_mota',$data->id)}}</textarea>
            </div>
        </div>
        <h4>TẠI SAO DỊCH VỤ CỦA VĨNH THÁI KHÁC BIỆT ?</h4>
        <div class="row">
            <div class="col-lg-4 col-xs-12">

                <div class="form-group">
                    @include('lito-dashboard::components.thumbnail',[
                                       'title' => 'Ảnh',
                                       'name' => 'ggads_anh1',
                                       'holder' => 'ggads_anh1',
                                       'image' => $settingseo->getSeoMetaText('ggads_anh1',$data->id)
                                   ])
                </div>

            </div>
            <div class="col-lg-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label">Nội dung</label>
                    <textarea
                            class="form-control ckeditor"
                            name="ggads_noidung1"
                            parsley-trigger="change"
                    >{{$settingseo->getSeoMetaText('ggads_noidung1',$data->id)}}</textarea>
                </div>
            </div>
        </div>

        <h4>KHÁCH HÀNG CỦA VĨNH THÁI</h4>
        <div class="row">
            <div class="col-lg-4 col-xs-12">
                <div class="form-group">
                    @include('lito-dashboard::components.thumbnail',[
                                       'title' => 'Ảnh',
                                       'name' => 'ggads_anh2',
                                       'holder' => 'ggads_anh2',
                                       'image' => $settingseo->getSeoMetaText('ggads_anh2',$data->id)
                                   ])
                </div>
            </div>
            <div class="col-lg-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label">Nội dung</label>
                    <textarea
                            class="form-control ckeditor"
                            name="ggads_noidung2"
                            parsley-trigger="change"
                    >{{$settingseo->getSeoMetaText('ggads_noidung2',$data->id)}}</textarea>
                </div>
            </div>
        </div>
        <h4>QUY TRÌNH</h4>
        <div class="row">
            <div class="col-lg-6 col-xs-12">
                <div class="form-group">
                    <label>Bước 1</label>
                    <input type="text"
                           class="form-control"
                           name="ggads_buoc1_title"
                           id="ggads_buoc1_title"
                           value="{{$settingseo->getSeoMetaText('ggads_buoc1_title',$data->id)}}"
                    >
                </div>
            </div>
            <div class="col-lg-6 col-xs-12">
                <div class="form-group">
                    <label>Bước 1: mô tả</label>
                    <input type="text"
                           class="form-control"
                           name="ggads_buoc1_des"
                           id="ggads_buoc1_des"
                           value="{{$settingseo->getSeoMetaText('ggads_buoc1_des',$data->id)}}"
                    >
                </div>
            </div>
            <div class="col-lg-6 col-xs-12">
                <div class="form-group">
                    <label>Bước 2</label>
                    <input type="text"
                           class="form-control"
                           name="ggads_buoc2_title"
                           id="ggads_buoc2_title"
                           value="{{$settingseo->getSeoMetaText('ggads_buoc2_title',$data->id)}}"
                    >
                </div>
            </div>
            <div class="col-lg-6 col-xs-12">
                <div class="form-group">
                    <label>Bước 2: mô tả</label>
                    <input type="text"
                           class="form-control"
                           name="ggads_buoc2_des"
                           id="ggads_buoc2_des"
                           value="{{$settingseo->getSeoMetaText('ggads_buoc2_des',$data->id)}}"
                    >
                </div>
            </div>
            <div class="col-lg-6 col-xs-12">
                <div class="form-group">
                    <label>Bước 3</label>
                    <input type="text"
                           class="form-control"
                           name="ggads_buoc3_title"
                           id="ggads_buoc3_title"
                           value="{{$settingseo->getSeoMetaText('ggads_buoc3_title',$data->id)}}"
                    >
                </div>
            </div>
            <div class="col-lg-6 col-xs-12">
                <div class="form-group">
                    <label>Bước 3: mô tả</label>
                    <input type="text"
                           class="form-control"
                           name="ggads_buoc3_des"
                           id="ggads_buoc3_des"
                           value="{{$settingseo->getSeoMetaText('ggads_buoc3_des',$data->id)}}"
                    >
                </div>
            </div>
            <div class="col-lg-6 col-xs-12">
                <div class="form-group">
                    <label>Bước 4</label>
                    <input type="text"
                           class="form-control"
                           name="ggads_buoc4_title"
                           id="ggads_buoc4_title"
                           value="{{$settingseo->getSeoMetaText('ggads_buoc4_title',$data->id)}}"
                    >
                </div>
            </div>
            <div class="col-lg-6 col-xs-12">
                <div class="form-group">
                    <label>Bước 4: mô tả</label>
                    <input type="text"
                           class="form-control"
                           name="ggads_buoc4_des"
                           id="ggads_buoc4_des"
                           value="{{$settingseo->getSeoMetaText('ggads_buoc4_des',$data->id)}}"
                    >
                </div>
            </div>
        </div>
        <h4>PHÍ DỊCH VỤ</h4>
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label">Nội dung</label>
                    <textarea
                            class="form-control ckeditor"
                            name="ggads_phidichvu"
                            parsley-trigger="change"
                    >{{$settingseo->getSeoMetaText('ggads_phidichvu',$data->id)}}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>