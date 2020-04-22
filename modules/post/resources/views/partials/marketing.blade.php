<div class="col-md-12 col-xs-12">
    <div class="" id="marketing">
        <h3>CẤU HÌNH THÔNG TIN TRANG MARKETING</h3>
        <h4>Tổng quan</h4>
        <div class="col-lg-6 col-xs-12">
            <div class="form-group">
                <label>Tiêu đề lớn</label>
                <input type="text"
                       class="form-control"
                       name="marketing_title"
                       id="marketing_title"
                       value="{{$settingseo->getSeoMetaText('marketing_title',$data->id)}}"
                >
            </div>
        </div>
        <div class="col-lg-6 col-xs-12">
            <div class="form-group">
                <label>Mô tả</label>
                <input type="text"
                       class="form-control"
                       name="marketing_des"
                       id="marketing_des"
                       value="{{$settingseo->getSeoMetaText('marketing_des',$data->id)}}"
                >
            </div>
        </div>
        <div class="col-lg-12 col-xs-12">
            <div class="form-group">
                <label class="form-control-label">Quy trình làm việc</label>
                <textarea
                        class="form-control ckeditor"
                        name="marketing_quytrinhlamviec"
                        id="marketing_quytrinhlamviec"
                        rows="4"
                >{{$settingseo->getSeoMetaText('marketing_quytrinhlamviec',$data->id)}}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-xs-12">
                <div class="form-group">
                    @include('lito-dashboard::components.thumbnail',[
                                       'title' => 'Chuyên gia tư vấn',
                                       'name' => 'marketing_chuyengiatuvan',
                                       'holder' => 'marketing_chuyengiatuvan',
                                       'image' => $settingseo->getSeoMetaText('marketing_chuyengiatuvan',$data->id)
                                   ])
                </div>
            </div>
        </div>
        <h4>Chi tiết công việc</h4>
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="form-group">
                    <label>Tiêu đề công việc 1</label>
                    <input type="text"
                           class="form-control"
                           name="marketing_title_job1"
                           id="marketing_title_job1"
                           value="{{$settingseo->getSeoMetaText('marketing_title_job1',$data->id)}}"
                    >
                </div>
            </div>
            <div class="col-lg-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label">Nội dung công việc 1</label>
                    <textarea
                            class="form-control ckeditor"
                            name="marketing_content_job1"
                            id="marketing_content_job1"
                            rows="4"
                    >{{$settingseo->getSeoMetaText('marketing_content_job1',$data->id)}}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="form-group">
                    <label>Tiêu đề công việc 2</label>
                    <input type="text"
                           class="form-control"
                           name="marketing_title_job2"
                           id="marketing_title_job2"
                           value="{{$settingseo->getSeoMetaText('marketing_title_job2',$data->id)}}"
                    >
                </div>
            </div>
            <div class="col-lg-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label">Nội dung công việc 2</label>
                    <textarea
                            class="form-control ckeditor"
                            name="marketing_content_job2"
                            id="marketing_content_job2"
                            rows="4"
                    >{{$settingseo->getSeoMetaText('marketing_content_job2',$data->id)}}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="form-group">
                    <label>Tiêu đề công việc 3</label>
                    <input type="text"
                           class="form-control"
                           name="marketing_title_job3"
                           id="marketing_title_job3"
                           value="{{$settingseo->getSeoMetaText('marketing_title_job3',$data->id)}}"
                    >
                </div>
            </div>
            <div class="col-lg-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label">Nội dung công việc 3</label>
                    <textarea
                            class="form-control ckeditor"
                            name="marketing_content_job3"
                            id="marketing_content_job3"
                            rows="4"
                    >{{$settingseo->getSeoMetaText('marketing_content_job3',$data->id)}}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="form-group">
                    <label>Tiêu đề công việc 4</label>
                    <input type="text"
                           class="form-control"
                           name="marketing_title_job4"
                           id="marketing_title_job4"
                           value="{{$settingseo->getSeoMetaText('marketing_title_job4',$data->id)}}"
                    >
                </div>
            </div>
            <div class="col-lg-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label">Nội dung công việc 4</label>
                    <textarea
                            class="form-control ckeditor"
                            name="marketing_content_job4"
                            id="marketing_content_job4"
                            rows="4"
                    >{{$settingseo->getSeoMetaText('marketing_content_job4',$data->id)}}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="form-group">
                    <label>Tiêu đề công việc 5</label>
                    <input type="text"
                           class="form-control"
                           name="marketing_title_job5"
                           id="marketing_title_job5"
                           value="{{$settingseo->getSeoMetaText('marketing_title_job5',$data->id)}}"
                    >
                </div>
            </div>
            <div class="col-lg-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label">Nội dung công việc 5</label>
                    <textarea
                            class="form-control ckeditor"
                            name="marketing_content_job5"
                            id="marketing_content_job5"
                            rows="4"
                    >{{$settingseo->getSeoMetaText('marketing_content_job5',$data->id)}}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="form-group">
                    <label>Tiêu đề công việc 6</label>
                    <input type="text"
                           class="form-control"
                           name="marketing_title_job6"
                           id="marketing_title_job6"
                           value="{{$settingseo->getSeoMetaText('marketing_title_job6',$data->id)}}"
                    >
                </div>
            </div>
            <div class="col-lg-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label">Nội dung công việc 6</label>
                    <textarea
                            class="form-control ckeditor"
                            name="marketing_content_job6"
                            id="marketing_content_job6"
                            rows="4"
                    >{{$settingseo->getSeoMetaText('marketing_content_job6',$data->id)}}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="form-group">
                    <label>Tiêu đề công việc 7</label>
                    <input type="text"
                           class="form-control"
                           name="marketing_title_job7"
                           id="marketing_title_job7"
                           value="{{$settingseo->getSeoMetaText('marketing_title_job7',$data->id)}}"
                    >
                </div>
            </div>
            <div class="col-lg-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label">Nội dung công việc 7</label>
                    <textarea
                            class="form-control ckeditor"
                            name="marketing_content_job7"
                            id="marketing_content_job7"
                            rows="4"
                    >{{$settingseo->getSeoMetaText('marketing_content_job7',$data->id)}}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="form-group">
                    <label>Tiêu đề công việc 8</label>
                    <input type="text"
                           class="form-control"
                           name="marketing_title_job8"
                           id="marketing_title_job8"
                           value="{{$settingseo->getSeoMetaText('marketing_title_job8',$data->id)}}"
                    >
                </div>
            </div>
            <div class="col-lg-12 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label">Nội dung công việc 8</label>
                    <textarea
                            class="form-control ckeditor"
                            name="marketing_content_job8"
                            id="marketing_content_job8"
                            rows="4"
                    >{{$settingseo->getSeoMetaText('marketing_content_job8',$data->id)}}</textarea>
                </div>
            </div>
        </div>
        <h4>Bảng giá dịch vụ</h4>
        <div class="col-lg-4 col-xs-12">
            <div class="form-group">
                <label>Tên dịch vụ 1</label>
                <input type="text"
                       class="form-control"
                       name="marketing_name_dv1"
                       id="marketing_name_dv1"
                       value="{{$settingseo->getSeoMetaText('marketing_name_dv1',$data->id)}}"
                >
            </div>
        </div>
        <div class="col-lg-4 col-xs-12">
            <div class="form-group">
                <label>Tên VN 1</label>
                <input type="text"
                       class="form-control"
                       name="marketing_name_dv1_vn"
                       id="marketing_name_dv1_vn"
                       value="{{$settingseo->getSeoMetaText('marketing_name_dv1_vn',$data->id)}}"
                >
            </div>
        </div>
        <div class="col-lg-4 col-xs-12">
            <div class="form-group">
                <label>Giá dịch vụ 1</label>
                <input type="text"
                       class="form-control"
                       name="marketing_price_dv1"
                       id="marketing_price_dv1"
                       value="{{$settingseo->getSeoMetaText('marketing_price_dv1',$data->id)}}"
                >
            </div>
        </div>
        <div class="col-lg-4 col-xs-12">
            <div class="form-group">
                <label>Hợp đồng tháng</label>
                <input type="text"
                       class="form-control"
                       name="marketing_hd_dv1_vn"
                       id="marketing_hd_dv1_vn"
                       value="{{$settingseo->getSeoMetaText('marketing_hd_dv1_vn',$data->id)}}"
                >
            </div>
        </div>
        <div class="col-lg-4 col-xs-12">
            <div class="form-group">
                <label>Mô tả dịch vụ 1</label>
                <input type="text"
                       class="form-control"
                       name="marketing_des_dv1"
                       id="marketing_des_dv1"
                       value="{{$settingseo->getSeoMetaText('marketing_des_dv1',$data->id)}}"
                >
            </div>
        </div>
        <div class="col-lg-12 col-xs-12">
            <div class="form-group">
                <label class="form-control-label">Nội dung dịch vụ 1</label>
                <textarea
                        class="form-control ckeditor"
                        name="marketing_content_dv1"
                        id="marketing_content_dv1"
                        rows="4"
                >{{$settingseo->getSeoMetaText('marketing_content_dv1',$data->id)}}</textarea>
            </div>
        </div>

        <div class="col-lg-4 col-xs-12">
            <div class="form-group">
                <label>Tên dịch vụ 2</label>
                <input type="text"
                       class="form-control"
                       name="marketing_name_dv2"
                       id="marketing_name_dv2"
                       value="{{$settingseo->getSeoMetaText('marketing_name_dv2',$data->id)}}"
                >
            </div>
        </div>
        <div class="col-lg-4 col-xs-12">
            <div class="form-group">
                <label>Tên VN dv 2</label>
                <input type="text"
                       class="form-control"
                       name="marketing_name_dv2_vn"
                       id="marketing_name_dv2_vn"
                       value="{{$settingseo->getSeoMetaText('marketing_name_dv2_vn',$data->id)}}"
                >
            </div>
        </div>
        <div class="col-lg-4 col-xs-12">
            <div class="form-group">
                <label>Giá dịch vụ 2</label>
                <input type="text"
                       class="form-control"
                       name="marketing_price_dv2"
                       id="marketing_price_dv2"
                       value="{{$settingseo->getSeoMetaText('marketing_price_dv2',$data->id)}}"
                >
            </div>
        </div>
        <div class="col-lg-4 col-xs-12">
            <div class="form-group">
                <label>Hợp đồng tháng</label>
                <input type="text"
                       class="form-control"
                       name="marketing_hd_dv2_vn"
                       id="marketing_hd_dv2_vn"
                       value="{{$settingseo->getSeoMetaText('marketing_hd_dv2_vn',$data->id)}}"
                >
            </div>
        </div>
        <div class="col-lg-4 col-xs-12">
            <div class="form-group">
                <label>Mô tả dịch vụ 2</label>
                <input type="text"
                       class="form-control"
                       name="marketing_des_dv2"
                       id="marketing_des_dv2"
                       value="{{$settingseo->getSeoMetaText('marketing_des_dv2',$data->id)}}"
                >
            </div>
        </div>
        <div class="col-lg-12 col-xs-12">
            <div class="form-group">
                <label class="form-control-label">Nội dung dịch vụ 2</label>
                <textarea
                        class="form-control ckeditor"
                        name="marketing_content_dv2"
                        id="marketing_content_dv2"
                        rows="4"
                >{{$settingseo->getSeoMetaText('marketing_content_dv2',$data->id)}}</textarea>
            </div>
        </div>

        <div class="col-lg-4 col-xs-12">
            <div class="form-group">
                <label>Tên dịch vụ 3</label>
                <input type="text"
                       class="form-control"
                       name="marketing_name_dv3"
                       id="marketing_name_dv3"
                       value="{{$settingseo->getSeoMetaText('marketing_name_dv3',$data->id)}}"
                >
            </div>
        </div>
        <div class="col-lg-4 col-xs-12">
            <div class="form-group">
                <label>Tên VN dv 3</label>
                <input type="text"
                       class="form-control"
                       name="marketing_name_dv3_vn"
                       id="marketing_name_dv3_vn"
                       value="{{$settingseo->getSeoMetaText('marketing_name_dv3_vn',$data->id)}}"
                >
            </div>
        </div>
        <div class="col-lg-4 col-xs-12">
            <div class="form-group">
                <label>Giá dịch vụ 3</label>
                <input type="text"
                       class="form-control"
                       name="marketing_price_dv3"
                       id="marketing_price_dv3"
                       value="{{$settingseo->getSeoMetaText('marketing_price_dv3',$data->id)}}"
                >
            </div>
        </div>
        <div class="col-lg-4 col-xs-12">
            <div class="form-group">
                <label>Hợp đồng tháng</label>
                <input type="text"
                       class="form-control"
                       name="marketing_hd_dv3_vn"
                       id="marketing_hd_dv3_vn"
                       value="{{$settingseo->getSeoMetaText('marketing_hd_dv3_vn',$data->id)}}"
                >
            </div>
        </div>
        <div class="col-lg-4 col-xs-12">
            <div class="form-group">
                <label>Mô tả dịch vụ 3</label>
                <input type="text"
                       class="form-control"
                       name="marketing_des_dv3"
                       id="marketing_des_dv3"
                       value="{{$settingseo->getSeoMetaText('marketing_des_dv3',$data->id)}}"
                >
            </div>
        </div>
        <div class="col-lg-12 col-xs-12">
            <div class="form-group">
                <label class="form-control-label">Nội dung dịch vụ 2</label>
                <textarea
                        class="form-control ckeditor"
                        name="marketing_content_dv3"
                        id="marketing_content_dv3"
                        rows="4"
                >{{$settingseo->getSeoMetaText('marketing_content_dv3',$data->id)}}</textarea>
            </div>
        </div>

        <h4>Triết lý làm việc</h4>
        <div class="col-lg-12 col-xs-12">
            <div class="form-group">
                <label class="form-control-label">Triết lý làm việc</label>
                <textarea
                        class="form-control ckeditor"
                        name="marketing_trietly"
                        id="marketing_trietly"
                        rows="4"
                >{{$settingseo->getSeoMetaText('marketing_trietly',$data->id)}}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-xs-12">
                <div class="form-group">
                    @include('lito-dashboard::components.thumbnail',[
                                       'title' => 'Ảnh triết lý làm việc',
                                       'name' => 'marketing_anhtrietly',
                                       'holder' => 'marketing_anhtrietly',
                                       'image' => $settingseo->getSeoMetaText('marketing_anhtrietly',$data->id)
                                   ])
                </div>
            </div>
        </div>
    </div>
</div>