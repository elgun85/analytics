@extends('Page.layout.master')
@section('title','MHM ilə LKŞ Dovruyye cedveli')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>@yield('title')</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <form  action="{{route('mld')}}" method="get" name="formdan">
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


                    <div class="card-body">
                        @if (request()->get('il') and request()->get('ay'))


                            {{--                cedvel mhm_menzil=>lks evvel --}}
                            <table id="examplemhmlks" class="table table-bordered table-striped mb-6">
                                <thead class="text-center text-bold">
                                <tr >
                                    <td class="text-center" > MHM_menzil => LKŞ </td>
                                    <td>MHM</td>
                                    <td>LKŞ</td>
                                    <td>ferq</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($mhm_m as $mhmValM)
                                    @if(array_key_exists($mhmValM->notel,$lksArray))
                                        @if(($lksArray[$mhmValM->notel]->lks_hesablama -$mhmValM->mhm_hesablama) > 0.1)
                                            <tr class="text-center">
                                                <td>{{$mhmValM->notel }}</td>
                                                <td>{{$mhmValM->mhm_hesablama }}</td>
                                                <td>{{$lksArray[$mhmValM->notel]->lks_hesablama}}</td>
                                                <td>
                                                    {{number_format($lksArray[$mhmValM->notel]->lks_hesablama - $mhmValM->mhm_hesablama, 2, ',', ' ')}}
                                                </td>
                                            </tr>
                                        @elseif(($lksArray[$mhmValM->notel]->lks_hesablama -$mhmValM->mhm_hesablama) < -0.1)
                                            <tr class="text-center">
                                                <td>{{$mhmValM->notel }}</td>
                                                <td>{{$mhmValM->mhm_hesablama }}</td>
                                                <td>{{$lksArray[$mhmValM->notel]->lks_hesablama}}</td>
                                                <td>
                                                    {{number_format($lksArray[$mhmValM->notel]->lks_hesablama - $mhmValM->mhm_hesablama, 2, ',', ' ')}}
                                                </td>
                                            </tr>
                                        @endif
                                    @else
                                        <tr class="text-danger text-center">
                                            <td>{{$mhmValM->notel}}</td>
                                            <td>{{$mhmValM->mhm_hesablama}}</td>
                                            <td>0.00</td>
                                            <td>{{number_format(0 - $mhmValM->mhm_hesablama, 2, ',', ' ')}}</td>
                                        </tr>
                                    @endif
                                    {{--</tr>--}}
                                @endforeach
                                </tbody>
                                <tfoot >
                                </tfoot>
                            </table>
                            {{--              mhm_menzil=>lks  cedvel son--}}

                            <br>
                            <hr style="background: red;"  >
                            <br>
                            {{--                cedvel mhm_qurum=>lks evvel --}}
                            <table id="example3" class="table table-bordered table-striped mb-6">
                                <thead class="text-center text-bold">
                                <tr >
                                    <td class="text-center" > MHM_qurum => LKŞ </td>
                                    <td>MHM</td>
                                    <td>LKŞ</td>
                                    <td>ferq</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($mhm_q as $mhm_qurum)
                                    @if(array_key_exists($mhm_qurum->KODMHM,$lksArrayQ))

                                        @if(($lksArrayQ[$mhm_qurum->KODMHM]->lks_hesablama -$mhm_qurum->mhm_hesablama) > 0.59)
                                            <tr class="text-center">
                                                <td>
                                                    @if($mhm_qurum->KODMHM ==$lksArrayQ[$mhm_qurum->KODMHM]->KODQURUM)
                                                        {{$mhm_qurum->KODMHM }}
                                                    @else
                                                        {{$mhm_qurum->KODMHM }} - ({{    $lksArrayQ[$mhm_qurum->KODMHM]->KODQURUM  }})
                                                    @endif
                                                </td>
                                                <td>{{$mhm_qurum->mhm_hesablama}}</td>
                                                <td>{{$lksArrayQ[$mhm_qurum->KODMHM]->lks_hesablama }}</td>
                                                <td>
                                                    {{number_format($lksArrayQ[$mhm_qurum->KODMHM]->lks_hesablama - $mhm_qurum->mhm_hesablama, 2, ',', ' ')}}
                                                </td>
                                            </tr>
                                        @elseif(($lksArrayQ[$mhm_qurum->KODMHM]->lks_hesablama -$mhm_qurum->mhm_hesablama) < -0.3)
                                            <tr class="text-center ">
                                                <td>
                                                    @if($mhm_qurum->KODMHM ==$lksArrayQ[$mhm_qurum->KODMHM]->KODQURUM)
                                                        {{$mhm_qurum->KODMHM }}
                                                    @else
                                                        {{$mhm_qurum->KODMHM }} - ({{    $lksArrayQ[$mhm_qurum->KODMHM]->KODQURUM  }})
                                                    @endif
                                                </td>
                                                <td>{{$mhm_qurum->mhm_hesablama }}</td>
                                                <td>{{$lksArrayQ[$mhm_qurum->KODMHM]->lks_hesablama}}</td>
                                                <td>
                                                    {{number_format($lksArrayQ[$mhm_qurum->KODMHM]->lks_hesablama - $mhm_qurum->mhm_hesablama, 2, ',', ' ')}}
                                                </td>
                                            </tr>



                                        @endif
                                    @else
                                        <tr class="text-danger text-center">
                                            <td>{{$mhm_qurum->KODMHM }}  </td>
                                            <td>{{$mhm_qurum->mhm_hesablama}}</td>
                                            <td>0.00</td>
                                            <td>{{number_format(0 - $mhm_qurum->mhm_hesablama, 2, ',', ' ')}}</td>
                                        </tr>
                                        @endif
                                        </tr>
                                        @endforeach
                                </tbody>
                                <tfoot >
                                </tfoot>
                            </table>
                            {{--              mhm_qurum=>lks  cedvel son--}}

                        @endif
                    </div>
                </div>



            </div>
        </section>

    </main>

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
                $("#examplemhmlks").DataTable({
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
                    .buttons().container().appendTo('#examplemhmlks_wrapper .col-md-6:eq(0)');


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
        <script>
            $(function () {
                $("#example3").DataTable({
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
                    .buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');


                $('#example4').DataTable({
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

