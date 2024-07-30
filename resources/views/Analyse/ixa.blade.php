@extends('Page.layout.master')
@section('title','İnternet xidməti analizi')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>@yield('title')</h1>
        </div>

            <!-- End Page Title -->

            <section class="section mt-3">
                <div class="row">
                    <div class="col-lg-6">

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Xidmətlər</h5>
                                <form method="GET" action="{{route('ixa')}}">
                                    @csrf

                                    <div class="row mb-3">
                                        <label for="tecnology" class="col-sm-3 col-form-label">Texnologiya</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="category" aria-label="Default select example" id="tecnology">
                                                <option value="" selected>Seç </option>
                                                <option @if (request()->get('category')=='Adsl') selected  @endif value="Adsl">Adsl</option>
                                                <option @if (request()->get('category')=='Gpon') selected  @endif value="Gpon">Gpon</option>
                                                <option @if (request()->get('category')=='Gpon Kampaniya') selected  @endif value="Gpon Kampaniya">Gpon Kampaniya</option>
                                                <option @if (request()->get('category')=='Ip Tv') selected  @endif value="Ip Tv">Ip Tv</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="category" class="col-sm-3 col-form-label">Kateqoriya {{old('novu')}}</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="novu" aria-label="Default select example" id="category">
                                                <option  value="" selected>Seç</option>
                                                <option  @if(request()->get('novu')=='Hamısı') selected @endif value="Hamısı" >Hamısı</option>
                                                <option @if(request()->get('novu')=='Mənzil') selected @endif value="Mənzil">Əhali</option>
                                                <option @if(request()->get('novu')=='Qeyri Əhali') selected @endif value="Qeyri Əhali">Qeyri Əhali</option>
                                            </select>
                                            @error('novu') <p class="text-danger">{{$message}}</p> @enderror
                                        </div>
                                    </div>


                                    <div class="card-title">
                                        <button type="submit" class="btn btn-primary float-end">Gonder</button>
                                    </div>
                                </form>
                            </div>


                        </div>
                    </div>



                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <!-- Horizontal Form -->
                                <form method="GET" action="{{route('ixa')}}">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="esas" class="col-sm-3 col-form-label">Əsas xidmət</label>
                                        <div class="col-sm-9">
                                            <input id="esas" type="text" name="esas" class="form-control" placeholder="Əsas xidmət axtarışı üçün tarif kodu yazin" value="{{old('esas')}}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="elave" class="col-sm-3 col-form-label">Əlavə xidmət {{old('novu')}}</label>
                                        <div class="col-sm-9">
                                            <input id="elave" type="text" name="elave" class="form-control" placeholder="Tarifin axtarışı üçün kodunu yazin..." value="{{old('elave')}}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="abon1" class="col-sm-3 col-form-label">Abonent</label>
                                        <div class="col-sm-9">
                                            <select id="abon1" class="form-control" name="abonent" aria-label="Default select example" >
                                                <option  value="" selected >Seçin</option>
                                                <option  value="1">1 </option>
                                                <option  value="2">2 </option>
                                                <option  value="8">8 </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="abonent2" class="col-sm-3 col-form-label">Abonent 2</label>
                                        <div class="col-sm-9">
                                            <select id="abonent2" class="form-control" name="abonent2" aria-label="Default select example" >
                                                <option  value="" selected >Seçin</option>
                                                <option  value="0">0</option>
                                                <option  value="2">2 </option>
                                            </select>
                                        </div>
                                    </div>

                                    @if(request()->get('category')||request()->get('novu'))

                                        <div class="card-header">
                                            <h3 class="card-title">{{$category}}</h3>
                                        </div>

                                        <table class="table table-hover ">
                                            <thead>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="col"> <input type="checkbox" id="checkAll">  Seç kod</th>

                                                <th>Ad</th>
                                                <th>Mənzil</th>
                                                <th>Qurum</th>
                                                <th>Status</th>
                                            </tr>
                                            @foreach($inter_tarif as $internet)
                                                <tr>
                                                    <td>
                                                        <input name='internet[]' type="checkbox" id="checkItem"  value="{{$internet->kod}}">
                                                        {{$internet->kod}}
                                                    </td>
                                                    <td>{{substr($internet->name,0,40)}} </td>
                                                    <td>{{$internet->mebleg}} </td>
                                                    <td>{{$internet->mebleg_q}} </td>
                                                    <td> {{$internet->novu}}</td>
                                                    <td> </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                @endif
                            </div>
                            <div class="card-footer">
                                @if(request()->get('category')||request()->get('abonent')||request()->get('abonent2')||request()->get('esas')||request()->get('internet[]'))
                                    <a href="{{route('ixa')}}" class="btn btn-outline-secondary">Sıfırla</a>
                                @endif
                                    <button type="submit" class="btn btn-primary float-end">Gonder</button>
                                    </form>
                                <!-- End Horizontal Form -->
                            </div>
                        </div>

                    </div>
                </div>
            </section>

        @if(request()->get('esas')||request()->get('elave')||request()->get('abonent')||request()->get('abonent2')||request()->get('internet'))

            {{--                cedvel evvel --}}
            <table id="example1" class="table table-bordered table-striped ">
                <thead class="text-center text-bold">
                <tr >
                    <td class="text-left"> {{request()->get('ay')}}-{{ request()->get('il')}}</td>
                    <td colspan="6" class="text-center">Cəmi</td>
                </tr>
                <tr >
                    <td class="text-left" >#</td>
                    <td class="text-left" >Telefon</td>
                    <td>Kateqoriya</td>
                    <td>Əsas xidmət</td>
                    <td>Əlavə xidmət</td>
                </tr>
                </thead>
                <tbody>
                    <?php
                    $bul = ['Ў','?','ў','Ё','ё','·','√','№','¤', 'Ї','ї', '°','∙','Є','є'];
                    $dey=  ['Ə','Ə','ə','Ö','ö','I','ı','Ü','ü', 'Ş','ş', 'Ğ','ğ','Ç','ç'];
                {{-- {{str_replace( $bul,$dey,$item->ADQURUM)}}--}}
                ?>
                @foreach($search as $item)
                    <tr class="text-center">
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->notel}}</td>
                        <td>
                            @if($item->ABONENT == 1 and $item->ABONENT2 == 0)
                                Mənzil
                            @endif
                            @if($item->ABONENT==1 and $item->ABONENT2 == 2)
                                Mənzidə qurum

                            @endif
                            @if($item->ABONENT == 2 and $item->ABONENT2 == 0)
                                Qurum

                            @endif
                        </td>
                        <td>{{$item->main_tariff}} ( {{$item->main_adtarif}})</td>
                        <td>{{$item->extra_tariff}}
                            {{substr(str_replace( $bul,$dey,$item->extra_adtarif),0,40)}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot >
                </tfoot>
            </table>
            {{--                cedvel son--}}
        @endif

    </main><!-- End #main -->

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

