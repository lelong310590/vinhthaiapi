
<div id="email" class="tab-pane fade in">
    <div class="component">
        <h4 class="component-title">Cấu hình Email SMTP</h4>

        <form action="" method="post" role="form">

            {{csrf_field()}}

            @include('lito-dashboard::components.alert')

            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <div class="">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="email_system_name">Địa chỉ Email hệ thống</label>
                                    <input type="text"
                                           class="form-control"
                                           name="email_system_name"
                                           placeholder="Nhập địa chỉ email"
                                           value="{{$setting->getSettingMeta('email_system_name')}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="email_system_driver">Email Driver </label>
                                    <input type="text"
                                           class="form-control"
                                           name="email_system_driver"
                                           placeholder="smtp..."
                                           value="{{$setting->getSettingMeta('email_system_driver')}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Mail Host </label>
                                    <input type="text"
                                           class="form-control"
                                           name="email_system_host"
                                           placeholder="smtp.gmail.com"
                                           value="{{$setting->getSettingMeta('email_system_host')}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="email_system_post">Email Port</label>
                                    <input type="text"
                                           class="form-control"
                                           name="email_system_post"
                                           value="{{$setting->getSettingMeta('email_system_post')}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="email_system_user">Email Username</label>
                                    <input type="text"
                                           class="form-control"
                                           name="email_system_user"
                                           value="{{$setting->getSettingMeta('email_system_user')}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Email Password</label>
                                    <input type="password"
                                           class="form-control"
                                           name="email_system_pass"
                                           value="{{$setting->getSettingMeta('email_system_pass')}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Email Encrypt</label>
                                    <select name="email_system_encrypt" class="form-control">
                                        <option value="tls" {{ ($setting->getSettingMeta('email_system_encrypt')=='tls') ? 'selected' : '' }} >tls</option>
                                        <option value="ssl" {{ ($setting->getSettingMeta('email_system_encrypt')=='ssl') ? 'selected' : '' }} >ssl</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success btn-full">Lưu cấu hình</button>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </form>

        <div class="row" style="margin-top: 30px">
            <div class="col-md-12">
                <form method="" action="{{route('lito:setting.test.post')}}">
            <div class="form-group">
                <label class="form-control-label">Test mail sended</label>
                <input type="text"
                       class="form-control"
                       name="email_system_test"
                       value=""
                       placeholder="Nhập email muốn nhận tin nhắn"
                >
            </div>
            <button type="submit" class="btn btn-success btn-full">Test mail</button>
                </form>
            </div>
        </div>

    </div>

</div>