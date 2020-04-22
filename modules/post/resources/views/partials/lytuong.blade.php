<div class="col-md-12 col-xs-12">
    <div class="" id="lytuong">
        <h3>CẤU HÌNH THÔNG TIN TRANG LÝ TƯỞNG</h3>
        <div class="col-lg-12 col-xs-12">
            <div class="form-group">
                <label class="form-control-label">SỨ MỆNH</label>
                <textarea
                        class="form-control ckeditor"
                        name="lytuong_sumenh"
                        id="lytuong_sumenh"
                        rows="4"
                >{{$settingseo->getSeoMetaText('lytuong_sumenh',$data->id)}}</textarea>
            </div>
        </div>
        <div class="col-lg-12 col-xs-12">
            <div class="form-group">
                <label class="form-control-label">GIÁ TRỊ</label>
                <textarea
                        class="form-control ckeditor"
                        name="lytuong_giatri"
                        id="lytuong_giatri"
                        rows="4"
                >{{$settingseo->getSeoMetaText('lytuong_giatri',$data->id)}}</textarea>
            </div>
        </div>
        <div class="col-lg-12 col-xs-12">
            <div class="form-group">
                <label class="form-control-label">Ý NGHĨA LOGO</label>
                <textarea
                        class="form-control ckeditor"
                        name="lytuong_ynghialogo"
                        id="lytuong_ynghialogo"
                        rows="4"
                >{{$settingseo->getSeoMetaText('lytuong_ynghialogo',$data->id)}}</textarea>
            </div>
        </div>
        <div class="col-lg-12 col-xs-12">
            <div class="form-group">
                <label class="form-control-label">Ý NGHĨA LOGO ĐOẠN 2</label>
                <textarea
                        class="form-control ckeditor"
                        name="lytuong_ynghialogo2"
                        id="lytuong_ynghialogo2"
                        rows="4"
                >{{$settingseo->getSeoMetaText('lytuong_ynghialogo2',$data->id)}}</textarea>
            </div>
        </div>
    </div>
</div>