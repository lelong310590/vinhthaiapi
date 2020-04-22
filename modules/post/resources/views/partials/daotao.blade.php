<div class="col-md-12 col-xs-12">
    <div class="" id="daotao">
        <h3>CẤU HÌNH THÔNG TIN TRANG ĐÀO TẠO</h3>
        <h4>Hình thức 1</h4>
        <div class="col-lg-6 col-xs-12">
            <div class="form-group">
                <label>Tên</label>
                <input type="text"
                       class="form-control"
                       name="daotao_name_1"
                       id="daotao_name_1"
                       value="{{$settingseo->getSeoMetaText('daotao_name_1',$data->id)}}"
                >
            </div>
        </div>
        <div class="col-lg-6 col-xs-12">
            <div class="form-group">
                @include('lito-dashboard::components.thumbnail',[
                                   'title' => 'Ảnh',
                                   'name' => 'daotao_anh1',
                                   'holder' => 'daotao_anh1',
                                   'image' => $settingseo->getSeoMetaText('daotao_anh1',$data->id)
                               ])
            </div>
        </div>
        <div class="col-lg-12 col-xs-12">
            <div class="form-group">
                <label class="form-control-label">Mô tả</label>
                <textarea
                        class="form-control"
                        name="daotao_mota1"
                        id="daotao_mota1"
                        rows="4"
                >{{$settingseo->getSeoMetaText('daotao_mota1',$data->id)}}</textarea>
            </div>
        </div>
        <h4>Hình thức 2</h4>
        <div class="col-lg-6 col-xs-12">
            <div class="form-group">
                <label>Tên</label>
                <input type="text"
                       class="form-control"
                       name="daotao_name_2"
                       id="daotao_name_2"
                       value="{{$settingseo->getSeoMetaText('daotao_name_2',$data->id)}}"
                >
            </div>
        </div>
        <div class="col-lg-6 col-xs-12">
            <div class="form-group">
                @include('lito-dashboard::components.thumbnail',[
                                   'title' => 'Ảnh',
                                   'name' => 'daotao_anh2',
                                   'holder' => 'daotao_anh2',
                                   'image' => $settingseo->getSeoMetaText('daotao_anh2',$data->id)
                               ])
            </div>
        </div>
        <div class="col-lg-12 col-xs-12">
            <div class="form-group">
                <label class="form-control-label">Mô tả</label>
                <textarea
                        class="form-control"
                        name="daotao_mota2"
                        id="daotao_mota2"
                        rows="4"
                >{{$settingseo->getSeoMetaText('daotao_mota2',$data->id)}}</textarea>
            </div>
        </div>
        <h4>Hình thức 3</h4>
        <div class="col-lg-6 col-xs-12">
            <div class="form-group">
                <label>Tên</label>
                <input type="text"
                       class="form-control"
                       name="daotao_name_3"
                       id="daotao_name_3"
                       value="{{$settingseo->getSeoMetaText('daotao_name_3',$data->id)}}"
                >
            </div>
        </div>
        <div class="col-lg-6 col-xs-12">
            <div class="form-group">
                @include('lito-dashboard::components.thumbnail',[
                                   'title' => 'Ảnh',
                                   'name' => 'daotao_anh3',
                                   'holder' => 'daotao_anh3',
                                   'image' => $settingseo->getSeoMetaText('daotao_anh3',$data->id)
                               ])
            </div>
        </div>
        <div class="col-lg-12 col-xs-12">
            <div class="form-group">
                <label class="form-control-label">Mô tả</label>
                <textarea
                        class="form-control"
                        name="daotao_mota3"
                        id="daotao_mota3"
                        rows="4"
                >{{$settingseo->getSeoMetaText('daotao_mota3',$data->id)}}</textarea>
            </div>
        </div>
        <div class="col-lg-12 col-xs-12">
            <div class="form-group">
                <label class="form-control-label">Nội dung</label>
                <textarea
                        class="form-control ckeditor"
                        name="daotao_noidung"
                        parsley-trigger="change"
                >{{$settingseo->getSeoMetaText('daotao_noidung',$data->id)}}</textarea>
            </div>
        </div>
    </div>
</div>