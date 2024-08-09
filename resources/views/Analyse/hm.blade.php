@extends('Page.layout.master')
@section('title','Hesablanmış məbləğ')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>@yield('title')</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <form  action="{{route('hm')}}" method="get" name="formdan">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <select id="abon1" class="form-control" name="ay"
                                            aria-label="Default select example">
                                        <option value="" selected>Ay seçin  </option>
                                        @if(request()->get('ay') !=0)
                                            <option  @if(request()->get('ay')) selected @endif   value="{{request()->get('ay')}}">{{request()->get('ay')}}</option>
                                        @endif
                                        @foreach($aylar as $ay)
                                            @if(request()->get('ay')!=$ay->ay)
                                                <option    value="{{$ay->ay}}">{{$ay->ay}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-2">
                                    <select id="abon1" class="form-control" name="il"
                                            aria-label="Default select example">
                                        <option value="" selected>İl seçin  </option>
                                        @if(request()->get('ay') !=0)
                                            <option  @if(request()->get('il')) selected @endif   value="{{request()->get('il')}}">{{request()->get('il')}}</option>
                                        @endif
                                        @foreach($iller as $il)
                                            @if(request()->get('il')!=$il->il)
                                                <option    value="{{$il->il}}">{{$il->il}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-3">Göndər</button>
                                </div>

                            </div>
                        </form>
                    </div>


@if(request()->get('ay') || request()->get('il') )
                <div class="card-body">
                    {{--                cedvel evvel --}}
                    <table id="example1" class="table table-bordered table-striped ">
                        <thead class="text-center text-bold">
                        <tr>
                            <td class="text-left">Telefon</td>
                            <td>Kateqoriya</td>
                            <td>Məbləğ</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $ItemHM)
                            <tr class="text-center">
                                <td>{{$ItemHM->notel}}</td>
                                <td>{{$ItemHM->ABONENT}}</td>
                                <td>{{$ItemHM->cemi_hesablama}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                    {{--                cedvel son--}}
                </div>
                    @endif
            </div>



        </div>
    </section>

</main>
@section('select_all')
    {{--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>--}}
    <script language="javascript">

        $("#checkAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endsection
@section('data_table_ccs')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.11.3/b-2.2.1/b-colvis-2.2.1/b-html5-2.2.1/b-print-2.2.1/kt-2.6.4/sb-1.3.0/sp-1.4.0/sl-1.3.4/datatables.min.css"/>
@endsection

@section('data_table_js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.11.3/b-2.2.1/b-colvis-2.2.1/b-html5-2.2.1/b-print-2.2.1/kt-2.6.4/sb-1.3.0/sp-1.4.0/sl-1.3.4/datatables.min.js"></script>

    <script>
        $(function () {
            $("#example1").DataTable({
                "pageLength": 15,
                "lengthMenu": [ [15, 25, 50, -1], [15, 25, 50, "All"] ],
                "responsive": true,
                // "lengthChange": false,
                // "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                //         buttons: [
                //             {
                //                 extend: 'excelHtml5',
                //                 text: 'Save current page',
                //                 exportOptions: {
                //                     modifier: {
                //                         page: 'current'
                //                     }
                //                 }
                //             }
                //         ]

            })
                .buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });


    </script>
@endsection
@endsection

