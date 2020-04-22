@php
    $defaultName = 'facebook_image';
    $defaultTitle = 'Ảnh đại diện';
    if (isset($name)) {
        $defaultName = $name;
    }
    if (isset($title)) {
        $defaultTitle = $title;
    }

    if (isset($image)) {
        $defaultData = $image;
    }
@endphp


<div class="form-group">
    <div class="bao-om">
        <label for="seo_description" style="width: 100%">Facebook image</label>
        <div class="img-fb">
            @if(isset($defaultData))
                <input id="{{$defaultName}}" type="text" class="form-control" name="{{$defaultName}}" value="{{asset($defaultData)}}" placeholder="">
            @else
                <input id="{{$defaultName}}" type="text" class="form-control" name="{{$defaultName}}" placeholder="">
            @endif
        </div>
        <div class="btn-upload">
            <a class="fblfm" href="javascript:;" data-preview="localimg" data-input="{{$defaultName}}" ><i class="fa fa-upload"></i> Chọn file</a>
        </div>

        <div class="facebook-img">
            <img id="localimg"
                 style="margin-bottom:10px; width: 100%; border: 1px solid #eee"
                 class="img-fluid"
                 @if (isset($defaultData))
                 src="{{ (!empty($defaultData)) ? asset($defaultData) : asset('ui/images/no-image.jpg') }}"
                 @else
                 src="{{ (!empty(old($defaultName))) ? asset(old($defaultName)) : asset('ui/images/no-image.jpg') }}"
                    @endif
            >
        </div>

    </div>
</div>


@push('js')
    <script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
    <script>
        $('.fblfm').filemanager('image');
    </script>
@endpush