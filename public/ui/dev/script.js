jQuery(document).ready(function($) {

    $('body').on('click', '.delete-record', (e) => {

        let _this = $(e.currentTarget);
        let url = _this.attr('data-href');

        swal({
            title: "Xóa dữ liệu?",
            text: "Khi bị xóa, Dữ liệu này sẽ không thể được hồi phục!",
            icon: "warning",
            buttons: ["Quay lại!", "Xóa!"],
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Bản ghi đã được xóa thành công!", {
                        icon: "success",
                    });

                    setTimeout(function () {
                        window.location.href = url;
                    }, 1500)

                } else {
                    return false;
                }
            });
    })

    $('#user-panel .user img').on('click', (e) => {
        $('.user-panel-menu').toggleClass('hidden');
    });

    $("html, body").click(function(e) {

        let elem = $(e.target).parent();

        if (elem.hasClass('user-panel-menu') || elem.hasClass('user')) {
            return false;
        }

        $('.user-panel-menu').addClass('hidden');

    })


    $('#workshopType').on('change', (e) => {
        let _this = $(e.currentTarget);
        let status = _this.val();

        if (status === 'in') {
            $('#outWorkshopInfomation').addClass('hidden')
        }

        if (status === 'out') {
            $('#outWorkshopInfomation').removeClass('hidden');
        }
    })

    $('.has-child .has-child-arrow').on('click', (e) => {
        let _this = $(e.currentTarget);
        let child = _this.next();
        let parent = _this.parent();

        if (parent.hasClass('active')) {
            return false;
        }

        child.slideToggle();
    });

})

// convert text to slug
function ChangeToSlug() {
    var title, slug, seo_title;

    //Lấy text từ thẻ input title
    title = $("#input_name").value;
    //Đổi chữ hoa thành chữ thường
    slug = title.toLowerCase();

    //Đổi ký tự có dấu thành không dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    //Xóa các ký tự đặt biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    //Đổi khoảng trắng thành ký tự gạch ngang
    slug = slug.replace(/ /gi, "-");
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    //Xóa các ký tự gạch ngang ở đầu và cuối
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    //In slug ra textbox có id “slug”

    if ($('#input-seo-title').length > 0) {
        seo_title = $('#input-seo-title');
        seo_title.val(title);
    }

    $('#input_slug').value = slug;
    $('#seo_slug').value = slug;
    $('#seo_title').value = title;
    $('#seo_title_value').innerHTML = title;
    $('#slug_value').innerHTML = slug;
    $('#facebook_title').value = title;

    //$("#sortable").sortable();
}

// convert text to slug
function SlugTitle() {
    var title, slug, seo_title;

    //Lấy text từ thẻ input title
    title = $("#input_name").value;
    //Đổi chữ hoa thành chữ thường
    slug = title.toLowerCase();

    //Đổi ký tự có dấu thành không dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    //Xóa các ký tự đặt biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    //Đổi khoảng trắng thành ký tự gạch ngang
    slug = slug.replace(/ /gi, "-");
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    //Xóa các ký tự gạch ngang ở đầu và cuối
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    //In slug ra textbox có id “slug”

    if ($('#input-seo-title').length > 0) {
        seo_title = $('#input-seo-title');
        seo_title.val(title);
    }

    $('#input_slug').value = slug;
    $('#seo_slug').value = slug;
    $('#seo_title').value = title;
    $('#seo_title_value').innerHTML = title;
    $('#slug_value').innerHTML = slug;
    $('#facebook_title').value = title;

    //$("#sortable").sortable();
}