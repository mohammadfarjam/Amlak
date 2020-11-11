<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>مبین اتصال آسمان</title>

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/dropzone_new.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css">

    <script src="{{asset('js/jquery-3.5.1.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/dropzone.min.js')}}"></script>
    <script src="{{asset('js/sweetalert.min.js')}}"></script>
    <script src="{{asset('js/dropzone_new.min.js')}}"></script>
    <script src="{{asset('js/jquery.elevateZoom-3.0.8.min.js')}}" type="text/javascript"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="font">
<div class="error container col-8 d-flex justify-content-start mt-2">
    <div class="alert alert-danger w-75 mx-auto" style="display: none">
        <ul class="append_error">
        </ul>
    </div><!--alert-danger-->
</div><!--erorr-->
<div class="container-fluid" style="border: 1px solid #a5df98;border-radius: 7px;">
    <div class="row">
        <div class="col-lg-3 p-0 remove_zoom" style="height: 630px;overflow-y: auto">
            <div class="mt-3 mb-3 d-flex justify-content-between">
                <button data-toggle="modal" data-target="#modal_delete_date" type="button" class="btn btn-primary mr-3">
                    پاکسازی تاریخچه


                </button>
                <button href="{{route('logout')}}" class="btn btn-danger mr-1"
                        style="text-align: center;height: 40px!important;cursor: pointer;"
                        onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">خروج
                </button>
                <form id="logout-form" action="{{ route('logout') }}" method="post"
                      style="display: none;">
                    @csrf
                </form>

            </div>
            <div class="form-group col-lg-12">
                <label for="name"> تصویر اصلی :</label>
                <div id="photo" class="dropzone style_dropzone"></div>
                <input type=text class='form-control' name=fake_photo id=fake_photo style="display: none"
                       placeholder='لطفا عملیات پاک سازی تاریخچه را انجام دهید' readonly>
            </div><!--form-group-->


            <div class="form-group col-lg-12">
                <label for="date_evidence"><p style="color:#ccc;margin:0;padding:0;"> تعداد تصاویر آپلود شده پرونده
                        :</p></label>
                <input class="form-control " style="direction: ltr;text-align: right" type="text"
                       name="total_img" value="" readonly>
            </div><!--form-group-->


            <div class="form-group col-lg-12 mt-3">
                <label for="date_evidence"><p style="color:#ccc;margin:0;padding:0;"> تعداد تصاویر تغیر نام داده
                        شده:</p></label>
                <input class="form-control " style="direction: ltr;text-align: right" type="text"
                       name="rename_img" value="" readonly>
            </div><!--form-group-->


            <div class="form-group col-lg-12">
                <label for="date_evidence"> تاریخ مدرک:</label>
                <input class="form-control date_evidence" id="date_evidence" style="direction: ltr;text-align: right"
                       type="text" name="date_evidence" value="" maxlength="8"
                       placeholder="13990422">{{ old('date_evidence') }}
            </div><!--form-group-->


            <div class="form-group col-lg-12">
                <label for="Number_evidence"> شماره مدرک:</label>
                <input class="form-control Number_evidence" id="Number_evidence" type="text"
                       name="Number_evidence" value="" placeholder="شماره مدرک">{{ old('Number_evidence') }}
            </div><!--form-group-->


            <div class="form-group col-lg-12">
                <label for="code_original"> عنوان نوع اصلی :</label>
                <select class="form-control code_original" id="code_original" name="code_original">
                    <option value="">عنوان اصلی را انتخاب نمایید</option>
                    <option value="10">احکام و آراء مراجع قانونی و دستورات آنها</option>
                    <option value="11">استعلامات و مکاتبات</option>
                    <option value="12">اعتراضات</option>
                    <option value="13">فیش های حسابداری</option>
                    <option value="14">انواع اسناد رسمی</option>
                    <option value="15">کپی مدارکی</option>
                    <option value="16">آگهی ها</option>
                    <option value="17">استشهادیه</option>
                    <option value="18"> اظهار نامه ثبتی</option>
                    <option value="19">اخطار و ابلاغ و بخشنامه</option>
                    <option value="20">مجوز مراجع ذیصلاح</option>
                    <option value="21">انواع درخواست</option>
                    <option value="22">صدور سند مالکیت،تجدیدی و المثنی</option>
                    <option value="23">نقشه ثبتی</option>
                    <option value="24">صورت جلسه و صورت مجلس ثبتی</option>
                    <option value="25">گزارشات ثبتی</option>
                    <option value="26">سایر</option>
                </select>
            </div><!--form-group-->


            <div class="form-group col-lg-12">
                <label for="secondary">عنوان نوع فرعی :</label>
                <select class="form-control secondary_type secondary" id="secondary"
                        name="evidence_type">
                </select>
            </div><!--form-group-->

            <div class="form-group col-lg-12 address">
                <input class="form-control" type="text" id="image" name="image" value="" placeholder="ادرس تصویر">
                <input class="form-control" type="text" id="ext" name="ext" value="" placeholder="پسوند تصویر">
            </div><!--form-group-->

            <div class="form-group col-lg-12">
                <label for="page_number"> شماره صفحه:</label>
                <input class="form-control page_number" id=page_number type="text" name="page_number"
                       value="1">{{ old('page_number') }}
                <p style='color:red;font-size:9.9pt'>لطفا پس از هر تغیر روی فیلد شماره صفحه کلیک نمایید.</p>
            </div><!--form-group-->

            <div class="col-lg-12">
                <button id="save" disabled class="btn btn-success mt-3 savee" type="submit"
                        onclick="sub();"> ثبت اطلاعات
                </button>
            </div>

            <button data-toggle="modal" data-target="#exampleModalCenter" type="button" id="modal" class="d-none">ssss
            </button>

        </div>{{--col-lg-3--}}


        <div class="col-lg-9">

            <div id="carouselExampleIndicators" class="carousel mt-2 mb-2 slide " data-ride="carousel">
                <div class="carousel-inner sc" style="height: 630px;">
                </div>


                <a class="carousel-control-prev" onclick="prev()" style="display: none;"
                   href="#carouselExampleIndicators" role="button"
                   data-slide="prev">
                    <!-- <span class="carousel-control-prev-icon" aria-hidden="true"></span> -->
                    <!-- <span class="sr-only">Previous</span> -->
                </a>
            <!-- {{--                <a class="carousel-control-next" onclick="next()" href="#carouselExampleIndicators" role="button"--}}
            {{--                   data-slide="next">--}}
            {{--                    <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
            {{--                    <span class="sr-only">Next</span>--}}
            {{--                </a>--}} -->
            </div>
        </div>{{--col-lg-9--}}


    </div>{{--row--}}
</div>{{--container-fluid--}}










<!-- modal for access delete all image-->
<div class="modal fade" id="modal_delete_date" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " style="width: 480px!important; " role="document">
        <div class="modal-content" style="border-radius: 8px">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="w-100">
                    <div>
                    </div>
                </div>

            </div>


            <div class="modal-body" style="border-top: none!important;">
                <p style="" class="p-1 text-center">آیا میخواهید تمام تصاویر آپلود شده را حذف نمایید؟</p>
            </div>

            <div class="modal-footer" style="border: none!important;">
                <div class="col-8 mx-auto d-flex justify-content-between">
                    <button type="button" class="btn btn-danger" style="width: 80px" data-dismiss="modal"
                            aria-label="Close">لغو
                    </button>
                    <button type="button" class="btn btn-primary" style="width: 80px" data-dismiss="modal"
                            onclick="delete_upload_photos()" id="Operation">تایید
                    </button>

                </div>

            </div>
        </div>
    </div>
</div>


<script>
    window.access_submit = false;


    //for delete final image after click on new renaming(coding)
    function delete_upload_photos() {
        $('.close').click();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '{{route('delete.upload.photos')}}',
            dataType: 'json',
            data: {},
            success: function (deleteStorage) {
                if (deleteStorage == 'ok') {
                    location.reload();
                }

            }, error: function (deleteStorage) {
                alert("در حذف کردن فایل ها خطایی به وجود آمده است");
            }
        });
    }


    //for if page refresh
    let length_carousel_item = $('.carousel-item').length;
    if (length_carousel_item == 0) {
        $('input[name=image]').val('');
        $('input[name=ext]').val('');
        $('input[name=date_evidence]').val('');
        $('input[name=Number_evidence]').val('');
        $('input[name=page_number]').val(1);
        $('input[name=rename_img]').val('');
        $('input[name=total_img]').val('');

    }


    //for upload picture by dropzone
    $("#photo").dropzone({
        url: '{{route('upload.image')}}',
        uploadMultiple: true,
        parallelUploads: 1,
        timeout: 1000000,
        maxRequestSize: 800000, //Mb
        autoProcessQueue: true,
        autoDiscover: false,
        dictDefaultMessage: "آپلود تصویر",
        acceptedFiles: ".jpeg,.jpg,.png,.tif,.tiff",
        sending: function (file, xhr, formData) {
            formData.append("_token", "{{csrf_token()}}")
        },
        success: function (file, response) {
            $('.carousel-item.active img').attr('id', '');
            $('.zoomContainer').fadeOut();
            $('.carousel-inner .carousel-item').removeClass('active');
            $('input[name=total_img]').val('');

            var content_img = '<div class="carousel-item" data_img="' + response.preview_name + '"><img  id="" class="d-block img w-100"' +
                ' data-src=" ' + response.photo_name + '"' +
                ' src="storage/photos/{{\Illuminate\Support\Facades\Auth::user()->id}}/' + response.preview_name + '" alt="' +
                response.preview_name +
                '" data-zoom-image="storage/photos/{{\Illuminate\Support\Facades\Auth::user()->id}}/' +
                response.preview_name + '"></div>';

            $(content_img).appendTo('.carousel-inner');
            $(".carousel-item").sort(sort_img).appendTo('.carousel-inner');


            function sort_img(a, b) {
                return $(a).attr('data_img') < $(b).attr('data_img') ? 1 : -1;
            }


            $('.carousel-inner .carousel-item:last-child').addClass('active');
            let insert_src_image = $('.carousel-inner .carousel-item.active img').attr('data-src');
            var ext = insert_src_image.split('.').pop();
            var only_name = insert_src_image.split('.').slice(0, -1).join('.');
            $('input[name=image]').val(only_name);
            $('input[name=ext]').val(ext);
            $('.carousel-item.active img').attr('id', 'zoom_01');


            var length_carousel_item_active = $('.carousel-item.active').length;
            if (length_carousel_item_active > 0) {
                $('#save').prop("disabled", false);
            }
            //for total img
            const total_img = $('.carousel-item').length;
            $('input[name=total_img]').val(total_img);
        }
    });


    //for get code secondary
    $('.code_original').click(function () {
        var id_code_original = $(this).val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '{{route('get.code.secondary')}}',
            dataType: 'json',
            data: {id_code_original: id_code_original},
            success: function (get_id_code_original) {
                if (get_id_code_original.length > 0) {
                    $('.secondary_type').html('');
                    $.each(get_id_code_original, function (index, element) {
                        var data_ajax = '<option value="' + element.value + '">' + element.title + '</option>';
                        $('.secondary_type').append(data_ajax);
                    });
                } else {
                    $('.secondary_type').html('');
                }
            },
            error: function (get_id_code_original) {
                alert("خطا در دریافت اطلاعات نوع کد فرعی");
            }
        });
    });


    //for change code original to put value 1
    $(document).on('change', '#code_original', function () {
        $('input[name=page_number]').val(1);
        access_submit = false;
    });


    //for change code original to put value 1
    $(document).on('change', '#secondary', function () {
        $('input[name=page_number]').val(1);
        access_submit = false;
    });

    //for click on date_evidence to false access_submit
    $(document).on('click', '#date_evidence', function () {
        access_submit = false;
    });

    //for click on Number_evidence to false access_submit
    $(document).on('click', '#Number_evidence', function () {
        access_submit = false;
    });


    //for read storage and sum count file if exist
    $(document).on('click', '#page_number', function () {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '{{route('read.storage')}}',
            dataType: 'json',
            data: {},
            success: function (ReadStorage) {
                window.arr = [];
                access_submit = true;

                $.each(ReadStorage, function (index, value) {
                    let storage_full_name = value.replace(/^.*\//, "");
                    let edit_storage_full_name = storage_full_name.split('.').slice(0, -1).join('.');
                    let data_file = edit_storage_full_name.split('-').slice(0, -1).join('-');
                    arr.push(data_file);
                });


                let code_original = $('#code_original :selected').val();
                let secondary = $('#secondary :selected').val();
                let date_evidence = $('input[name=date_evidence]').val();
                let number_evidence = $('input[name=Number_evidence]').val();
                let array_get_code_user = date_evidence + '-' + number_evidence + '-' + code_original.concat(secondary);

                if ($.inArray(array_get_code_user, arr) !== -1) {

                    var counter = 0;
                    for (var i = 0; i < arr.length; i++) {
                        if (array_get_code_user == arr[i]) {
                            counter++;
                        }
                    }


                    $('input[name=page_number]').val(counter);
                    let val_page_number = $('input[name=page_number]').val();
                    var sum_page_number = 1;
                    sum_page_number += val_page_number * 1;
                    $('input[name=page_number]').val(sum_page_number);
                } else {
                    $('input[name=page_number]').val(1);
                }
            },
            error: function (ReadStorage) {
                alert("خطا در خواندن Storage");
            }
        });

    });


    //replace bad characters for date_evidence
    $('#date_evidence').keyup(function () {
        let get_val_date_evidence = $(this).val();
        get_val_date_evidence = get_val_date_evidence.replace(/[^\w\s]/gi, '');
        $('#date_evidence').val(get_val_date_evidence);
        access_submit = false;
    });

    // trim for input number_evidence
    $('#Number_evidence').keyup(function () {
        let get_val_Number_evidence = $(this).val();
        get_val_Number_evidence = $.trim(get_val_Number_evidence).replace('/', '.');
        $('#Number_evidence').val(get_val_Number_evidence);
        access_submit = false;
    });


    //for send info form to controller
    function sub() {
        if (access_submit == true) {
            let date_evidence = $('input[name=date_evidence]').val();
            let Number_evidence = $('input[name=Number_evidence]').val();
            let code_original = $('#code_original :selected').val();
            let secondary = $('#secondary :selected').val();
            let page_number = $('input[name=page_number]').val();
            let image = $('input[name=image]').val();
            let ext = $('input[name=ext]').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                type: 'POST',
                url: '{{route('store')}}',
                dataType: 'json',
                data: {
                    date_evidence,
                    Number_evidence,
                    code_original,
                    secondary,
                    page_number,
                    image,
                    ext,

                },
                success: function (return_data_image) {
                    if (return_data_image === 'success') {
                        sweetalert();
                        $('.carousel-item.active').addClass('del');
                        $('.alert-danger').css('display', 'none');
                        $(".carousel-control-prev").click();
                        $('.row_evidence').val(1);
                        $('#photo').css('display', 'none');
                        $('#fake_photo').css('display', 'block');

                        // for sum rename img
                        let val_rename_img = $('input[name=rename_img]').val();
                        let rename_file = 1;
                        rename_file += val_rename_img * 1;
                        $('input[name=rename_img]').val(rename_file)
                    }
                },
                error: function (return_data_image) {
                    if (!return_data_image.responseJSON) {
                        $('.alert-danger').css('display', 'none');
                    } else {
                        sweetalertError();
                        $('.error .append_error').html(' ');
                        $('.alert-danger').css('display', 'block');
                        $("html, body").animate({scrollTop: 0}, "slow");
                        $.each(return_data_image.responseJSON, function (index, value) {
                            $('.error .append_error').append('<li>' + value + '</li>');
                        });
                    }
                }
            });

        } else if (access_submit == false) {
            clickOnPageNumber();
        }
    }


    //for view prev image
    function prev() {
        access_submit = false;
        $('.carousel-item img').attr('id', '');
        $('.zoomContainer').fadeOut();
        // $('input[name=date_evidence]').val('');
        // $('input[name=Number_evidence]').val('');
        $('input[name=page_number]').val(1);

        setTimeout(function () {
            $('.carousel-item.del').remove();
            var length_carousel = $('.carousel-item.active').length;
            if (length_carousel < 1) {
                $('#save').prop("disabled", "disabled");
            }
            $('.carousel-item.active img').attr('id', 'zoom_01');
            let insert_src_image = $('.carousel-inner .carousel-item.active img').attr('data-src');
            var ext = insert_src_image.split('.').pop();
            var only_name = insert_src_image.split('.').slice(0, -1).join('.');
            $('input[name=image]').val(only_name);
            $('input[name=ext]').val(ext);


            //for value page counter
            let recive_name_img = $('input[name=image]').val()
            let value_page_counter = recive_name_img.slice(0, -1);
            $('input[name=page_counter]').val(value_page_counter);
            let save_value_page_counter = recive_name_img.slice(0, -1);
        }, 700);
    }


    //for press enter key to submit form
    $(document).keypress(function (event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        // if (keycode == '13') {
        //     sub();
        // }
    });

    //for remove elevatezoom
    $('.remove_zoom').hover(function () {
        $('.zoomLens').remove();
        $('.zoomContainer').remove();
        $('.zoomWindowContainer').remove();
    });

    //for stop scroll slider
    $('.carousel').carousel({
        interval: 0,
        wrap: false,
    });

    function sweetalert() {
        swal({
            animation: true,
            icon: 'success',
            toast: true,
            allowEscapeKey: true,
            background: '#8fdf85',
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            title: 'تصویر ثبت شد',
        });
    }


    function clickOnPageNumber() {

        swal({
            text: "لطفا بر روی فیلد شماره صفحه کلیک نمایید",
            icon: "warning",
            timer: 3000,
            button: false,
        })
    }


    function sweetalertError() {
        swal({
            animation: true,
            icon: 'danger',
            toast: true,
            allowEscapeKey: true,
            background: '#ff5252',
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            title: 'خطا در ثبت تصویر!',
        });
    }


    // for elevatezoom and dom jquery
    $(document).on('click', '.carousel-item.active', function () {
        $("#zoom_01").elevateZoom({
            zoomType: "lens",
            lensShape: "round",
            lensSize: 400,
        });
    });

</script>


</body>
</html>
