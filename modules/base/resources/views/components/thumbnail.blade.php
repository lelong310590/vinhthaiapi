@php
    $defaultName = 'thumbnail';
    $defaultTitle = 'Ảnh đại diện';
    if (isset($name)) {
        $defaultName = $name;
    }

    if (isset($title)) {
        $defaultTitle = $title;
    }

    if (isset($image)) {
        $defaultData = $image;
    } else {
        if (isset($data)) {
            $defaultData = $data->thumbnail;
        }
    }
@endphp

<div class="form-group">
    <label for="role">{{$defaultTitle}}</label>

    <br/>

    <img id="holder-{{$defaultName}}"
         style="margin-bottom:10px; width: 100%; border: 1px solid #eee"
         class="img-fluid"
         @if (isset($defaultData))
         src="{{ (!empty($defaultData)) ? asset($defaultData) : asset('ui/images/no-image.jpg') }}"
         @else
         src="{{ (!empty(old($defaultName))) ? asset(old($defaultName)) : asset('ui/images/no-image.jpg') }}"
            @endif
    >
    <div class="input-group">
        <a data-input="{{$defaultName}}" data-preview="holder" class="lfm btn btn-default" href="javascript:;" style="margin-right: 10px">
            <i class="fa fa-picture-o"></i> Chọn
        </a>

        <a id="delete-lfm" data-input="{{$defaultName}}" data-preview="holder" class="btn btn-outline" href="javascript:;">
            <i class="fa fa-trash-o"></i> Xóa
        </a>
        @if (isset($defaultData))
            <input id="{{$defaultName}}" class="form-control" type="hidden" name="{{$defaultName}}" value="{{$defaultData}}">
        @else
            <input id="{{$defaultName}}" class="form-control" type="hidden" name="{{$defaultName}}">
        @endif
    </div>
</div>

@push('js')
    <script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
    <script>
        $('.lfm').filemanager('image');
        $('#delete-lfm').on('click', function () {
            $('#{{$defaultName}}').val('');
            $('#holder-{{$defaultName}}').attr('src', '{{ asset('ui/images/no-image.jpg') }}');
        })

        $('#{{$defaultName}}').on('change', function ()  {
            var val = $(this).val();
            var holder = $(this).parent().prev().attr('src', val);
        })
    </script>
@endpush