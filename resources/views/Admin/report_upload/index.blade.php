@extends('Admin.layout.index')

@section('content')
    <link href="{{asset('css/persian-datepicker.css')}}" rel="stylesheet">

    <script src="{{asset('js/persian-date.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/persian-datepicker.js')}}" type="text/javascript"></script>

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"> گزارش آپلود کاربران</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            @if(\Illuminate\Support\Facades\Session::has('publish_comment'))
                <div class="alert alert-success">
                    <div>{{Session('publish_comment')}}</div>
                </div>
            @endif

            @if(\Illuminate\Support\Facades\Session::has('not_info'))
                <div class="alert alert-danger">
                    <div>{{Session('not_info')}}</div>
                </div>
            @endif


            <div class="table-responsive">
                <form action="{{route('compare.date')}}" method="post">
                    @csrf
                    <div class="form-group col-lg-3">
                        <label for="data_start">تاریخ شروع :</label>
                        <input class="form-control date1 " type="text" name="date_start" value="">
                    </div>

                    <div class="form-group col-lg-3">
                        <label for="data_end"> تاریخ پایان :</label>
                        <input class="form-control date1" type="text" name="date_end" value="">
                    </div>


                    <div class="form-group col-lg-3">
                        <label for="data_end"> انتخاب کاربر :</label>
                        <select name="user_name" class="form-control">
                            @php
                                $users= \App\User::all();
                            @endphp
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-dropbox" type="submit" style="margin-right: 50px;margin-top: 25px">جستجو
                    </button>
                </form>


                <table class="table no-margin">
                    <thead>
                    <tr style="background: #5fff93">
                        <th class="text-center">ردیف</th>
                        <th class="text-center">نام کاربر</th>
                        <th class="text-center">تعداد آپلود</th>
                    </tr>
                    </thead>
                    <tbody>



                    <tr>
                        @if(isset($find_name_user))
                            <td class="text-center">1</td>
                        @else
                            <td class="text-center"></td>
                        @endif
                        @if(isset($find_name_user))
                            <td class="text-center">{{$find_name_user[0]->name}}</td>
                        @endif
                        @if(isset($count))
                            <td class="text-center">{{$count}}</td>
                        @endif
                    </tr>

                    </tbody>
                </table>


                <style>
                    .pagination .page-item.active .page-link {
                        background: #5fff93 !important;
                        color: black;
                        border: 1px solid #cccccc;
                    }
                </style>

                <span class="w-100" style=" display: flex;">
                    <div class="" style="margin-left: 0;margin-right: 0;margin: auto">
{{--                    {{ $info->links() }}--}}
                </div>
</span>

            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->

    </div>

    <script>
        $(".date1").pDatepicker({
            initialValue: true,
            format: 'YYYY/MM/DD',
            persianDigit: false,
        });


    </script>
@endsection
