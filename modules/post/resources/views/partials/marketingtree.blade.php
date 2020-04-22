<div class="col-md-12 col-xs-12">
    <div class="" id="marketingtree">
        <h3>CẤU HÌNH THÔNG TIN TRANG MARKETING TREE</h3>
        <h4>Tổng quan</h4>
        <div class="col-lg-6 col-xs-12">
            <div class="form-group">
                <label>Tiêu đề lớn</label>
                <input type="text"
                       class="form-control"
                       name="marketingtree_title"
                       id="marketingtree_title"
                       value="{{$settingseo->getSeoMetaText('marketingtree_title',$data->id)}}"
                >
            </div>
        </div>
        <div class="col-lg-6 col-xs-12">
            <div class="form-group">
                <label>Mô tả</label>
                <input type="text"
                       class="form-control"
                       name="marketingtree_des"
                       id="marketingtree_des"
                       value="{{$settingseo->getSeoMetaText('marketingtree_des',$data->id)}}"
                >
            </div>
        </div>
        <div class="col-lg-12 col-xs-12">
            <div class="form-group">
                <label class="form-control-label">Nội dung</label>
                <textarea
                        class="form-control"
                        name="marketingtree_content"
                        id="marketingtree_content"
                        rows="4"
                >{{$settingseo->getSeoMetaText('marketingtree_content',$data->id)}}</textarea>
            </div>
        </div>
        <h4>Lịch khai giảng</h4>
        <div class="col-lg-6 col-xs-12">
            <div class="form-group">
                <label>Tên</label>
                <input type="text"
                       class="form-control"
                       name="marketingtree_khaigiang_name"
                       id="marketingtree_khaigiang_name"
                       value="{{$settingseo->getSeoMetaText('marketingtree_khaigiang_name',$data->id)}}"
                >
            </div>
        </div>
        <div class="col-lg-6 col-xs-12">
            <div class="form-group">
                <label>Số buổi</label>
                <input type="text"
                       class="form-control"
                       name="marketingtree_khaigiang_num"
                       id="marketingtree_khaigiang_num"
                       value="{{$settingseo->getSeoMetaText('marketingtree_khaigiang_num',$data->id)}}"
                >
            </div>
        </div>
        <div class="col-lg-6 col-xs-12">
            <div class="form-group">
                <label>Giá</label>
                <input type="text"
                       class="form-control"
                       name="marketingtree_khaigiang_price"
                       id="marketingtree_khaigiang_price"
                       value="{{$settingseo->getSeoMetaText('marketingtree_khaigiang_price',$data->id)}}"
                >
            </div>
        </div>
        <div class="col-lg-6 col-xs-12">
            <div class="form-group">
                <label>Giá khuyến mại</label>
                <input type="text"
                       class="form-control"
                       name="marketingtree_khaigiang_price_km"
                       id="marketingtree_khaigiang_price_km"
                       value="{{$settingseo->getSeoMetaText('marketingtree_khaigiang_price_km',$data->id)}}"
                >
            </div>
        </div>
        <div class="col-lg-6 col-xs-12">
            <div class="form-group">
                <label>Địa điểm</label>
                <input type="text"
                       class="form-control"
                       name="marketingtree_khaigiang_location"
                       id="marketingtree_khaigiang_location"
                       value="{{$settingseo->getSeoMetaText('marketingtree_khaigiang_location',$data->id)}}"
                >
            </div>
        </div>
        <div class="col-lg-6 col-xs-12">
            <div class="form-group">
                <label>Ngày khai giảng</label>
                <input type="text"
                       class="form-control"
                       name="marketingtree_khaigiang_date"
                       id="marketingtree_khaigiang_date"
                       value="{{$settingseo->getSeoMetaText('marketingtree_khaigiang_date',$data->id)}}"
                >
            </div>
        </div>
        <div class="col-lg-12 col-xs-12">
            <div class="form-group">
                <label class="form-control-label">Khóa học marketing cho người mới bắt đầu</label>
                <textarea
                        class="form-control ckeditor"
                        name="marketingtree_newbie"
                        id="marketingtree_newbie"
                        rows="4"
                >{{$settingseo->getSeoMetaText('marketingtree_newbie',$data->id)}}</textarea>
            </div>
        </div>
        <div class="col-lg-12 col-xs-12">
            <div class="form-group">
                <label class="form-control-label">Ai phù hợp với khóa học</label>
                <textarea
                        class="form-control ckeditor"
                        name="marketingtree_fit"
                        id="marketingtree_fit"
                        rows="4"
                >{{$settingseo->getSeoMetaText('marketingtree_fit',$data->id)}}</textarea>
            </div>
        </div>
        <div class="col-lg-12 col-xs-12">
            <h4>Giảng viên 1</h4>
        </div>
        <div class="row">
            <div class="col-lg-4 col-xs-12">
                <div class="form-group">
                    <label>Tên</label>
                    <input type="text"
                           class="form-control"
                           name="marketingtree_giangvien_name1"
                           id="marketingtree_giangvien_name1"
                           value="{{$settingseo->getSeoMetaText('marketingtree_giangvien_name1',$data->id)}}"
                    >
                </div>
                <div class="form-group">
                    <label>Facebook</label>
                    <input type="text"
                           class="form-control"
                           name="marketingtree_giangvien_fb1"
                           id="marketingtree_giangvien_fb1"
                           value="{{$settingseo->getSeoMetaText('marketingtree_giangvien_fb1',$data->id)}}"
                    >
                </div>
            </div>
            <div class="col-lg-4 col-xs-12">
                <div class="form-group">
                    <label>Mô tả</label>
                    <input type="text"
                           class="form-control"
                           name="marketingtree_giangvien_des1"
                           id="marketingtree_giangvien_des1"
                           value="{{$settingseo->getSeoMetaText('marketingtree_giangvien_des1',$data->id)}}"
                    >
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text"
                           class="form-control"
                           name="marketingtree_giangvien_email1"
                           id="marketingtree_giangvien_email1"
                           value="{{$settingseo->getSeoMetaText('marketingtree_giangvien_email1',$data->id)}}"
                    >
                </div>
            </div>
            <div class="col-lg-4 col-xs-12">
                <div class="form-group">
                    @include('lito-dashboard::components.thumbnail',[
                                       'title' => 'Ảnh',
                                       'name' => 'marketingtree_giangvien_anh1',
                                       'holder' => 'marketingtree_giangvien_anh1',
                                       'image' => $settingseo->getSeoMetaText('marketingtree_giangvien_anh1',$data->id)
                                   ])
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-xs-12">
                <div class="form-group">
                    <label>Giới thiệu ngắn</label>
                    <input type="text"
                           class="form-control"
                           name="marketingtree_giangvien_gt1"
                           id="marketingtree_giangvien_gt1"
                           value="{{$settingseo->getSeoMetaText('marketingtree_giangvien_gt1',$data->id)}}"
                    >
                </div>
            </div>
            <div class="col-lg-6 col-xs-12">
                <div class="form-group">
                    <label>Link youtube</label>
                    <input type="text"
                           class="form-control"
                           name="marketingtree_giangvien_you1"
                           id="marketingtree_giangvien_you1"
                           value="{{$settingseo->getSeoMetaText('marketingtree_giangvien_you1',$data->id)}}"
                    >
                </div>
            </div>
        </div>
        <h4>Giảng viên 2</h4>
        <div class="row">
            <div class="col-lg-4 col-xs-12">
                <div class="form-group">
                    <label>Tên</label>
                    <input type="text"
                           class="form-control"
                           name="marketingtree_giangvien_name2"
                           id="marketingtree_giangvien_name2"
                           value="{{$settingseo->getSeoMetaText('marketingtree_giangvien_name2',$data->id)}}"
                    >
                </div>
                <div class="form-group">
                    <label>Facebook</label>
                    <input type="text"
                           class="form-control"
                           name="marketingtree_giangvien_fb2"
                           id="marketingtree_giangvien_fb2"
                           value="{{$settingseo->getSeoMetaText('marketingtree_giangvien_fb2',$data->id)}}"
                    >
                </div>
            </div>
            <div class="col-lg-4 col-xs-12">
                <div class="form-group">
                    <label>Mô tả</label>
                    <input type="text"
                           class="form-control"
                           name="marketingtree_giangvien_des2"
                           id="marketingtree_giangvien_des2"
                           value="{{$settingseo->getSeoMetaText('marketingtree_giangvien_des2',$data->id)}}"
                    >
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text"
                           class="form-control"
                           name="marketingtree_giangvien_email2"
                           id="marketingtree_giangvien_email2"
                           value="{{$settingseo->getSeoMetaText('marketingtree_giangvien_email2',$data->id)}}"
                    >
                </div>
            </div>
            <div class="col-lg-4 col-xs-12">
                <div class="form-group">
                    @include('lito-dashboard::components.thumbnail',[
                                       'title' => 'Ảnh',
                                       'name' => 'marketingtree_giangvien_anh2',
                                       'holder' => 'marketingtree_giangvien_anh2',
                                       'image' => $settingseo->getSeoMetaText('marketingtree_giangvien_anh2',$data->id)
                                   ])
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-xs-12">
                <div class="form-group">
                    <label>Giới thiệu ngắn</label>
                    <input type="text"
                           class="form-control"
                           name="marketingtree_giangvien_gt2"
                           id="marketingtree_giangvien_gt2"
                           value="{{$settingseo->getSeoMetaText('marketingtree_giangvien_gt2',$data->id)}}"
                    >
                </div>
            </div>
            <div class="col-lg-6 col-xs-12">
                <div class="form-group">
                    <label>Link youtube</label>
                    <input type="text"
                           class="form-control"
                           name="marketingtree_giangvien_you2"
                           id="marketingtree_giangvien_you2"
                           value="{{$settingseo->getSeoMetaText('marketingtree_giangvien_you2',$data->id)}}"
                    >
                </div>
            </div>
        </div>

        <h4>Giảng viên 3</h4>
        <div class="row">
            <div class="col-lg-4 col-xs-12">
                <div class="form-group">
                    <label>Tên</label>
                    <input type="text"
                           class="form-control"
                           name="marketingtree_giangvien_name3"
                           id="marketingtree_giangvien_name3"
                           value="{{$settingseo->getSeoMetaText('marketingtree_giangvien_name3',$data->id)}}"
                    >
                </div>
                <div class="form-group">
                    <label>Facebook</label>
                    <input type="text"
                           class="form-control"
                           name="marketingtree_giangvien_fb3"
                           id="marketingtree_giangvien_fb3"
                           value="{{$settingseo->getSeoMetaText('marketingtree_giangvien_fb3',$data->id)}}"
                    >
                </div>
            </div>
            <div class="col-lg-4 col-xs-12">
                <div class="form-group">
                    <label>Mô tả</label>
                    <input type="text"
                           class="form-control"
                           name="marketingtree_giangvien_des3"
                           id="marketingtree_giangvien_des3"
                           value="{{$settingseo->getSeoMetaText('marketingtree_giangvien_des3',$data->id)}}"
                    >
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text"
                           class="form-control"
                           name="marketingtree_giangvien_email3"
                           id="marketingtree_giangvien_email3"
                           value="{{$settingseo->getSeoMetaText('marketingtree_giangvien_email3',$data->id)}}"
                    >
                </div>
            </div>
            <div class="col-lg-4 col-xs-12">
                <div class="form-group">
                    @include('lito-dashboard::components.thumbnail',[
                                       'title' => 'Ảnh',
                                       'name' => 'marketingtree_giangvien_anh3',
                                       'holder' => 'marketingtree_giangvien_anh3',
                                       'image' => $settingseo->getSeoMetaText('marketingtree_giangvien_anh3',$data->id)
                                   ])
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-xs-12">
                <div class="form-group">
                    <label>Giới thiệu ngắn</label>
                    <input type="text"
                           class="form-control"
                           name="marketingtree_giangvien_gt3"
                           id="marketingtree_giangvien_gt3"
                           value="{{$settingseo->getSeoMetaText('marketingtree_giangvien_gt3',$data->id)}}"
                    >
                </div>
            </div>
            <div class="col-lg-6 col-xs-12">
                <div class="form-group">
                    <label>Link youtube</label>
                    <input type="text"
                           class="form-control"
                           name="marketingtree_giangvien_you3"
                           id="marketingtree_giangvien_you3"
                           value="{{$settingseo->getSeoMetaText('marketingtree_giangvien_you3',$data->id)}}"
                    >
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-xs-12">
            <div class="form-group">
                <label class="form-control-label">Nội dung khóa học</label>
                <textarea
                        class="form-control ckeditor"
                        name="marketingtree_course_content"
                        id="marketingtree_course_content"
                        rows="4"
                >{{$settingseo->getSeoMetaText('marketingtree_course_content',$data->id)}}</textarea>
            </div>
        </div>
    </div>
</div>