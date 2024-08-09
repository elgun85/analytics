@extends('Page.layout.master')
@section('title','Data Montly Cari')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>@yield('title')</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <form  action="{{route('dmc')}}" method="get" name="formdan">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <select id="abon1" class="form-control" name="month"
                                            aria-label="Default select example">
                                        <option value="" selected>Ay seçin  </option>
                                        @if(request()->get('month') !=0)
                                            <option  @if(request()->get('month')) selected @endif   value="{{request()->get('month')}}">{{request()->get('month')}}</option>
                                        @endif
                                        @foreach($months as $month)
                                            @if(request()->get('month')!=$month->month)
                                                <option    value="{{$month->month}}">{{$month->month}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-2">
                                    <select id="abon1" class="form-control" name="year"
                                            aria-label="Default select example">
                                        <option value="" selected>year seçin  </option>
                                        @if(request()->get('month') !=0)
                                            <option  @if(request()->get('year')) selected @endif   value="{{request()->get('year')}}">{{request()->get('year')}}</option>
                                        @endif
                                        @foreach($years as $year)
                                            @if(request()->get('year')!=$year->year)
                                                <option    value="{{$year->year}}">{{$year->year}}</option>
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
                        @if (request()->get('month') and request()->get('year'))
                            <div class="row">
                                <div class="col-md-8">
                                    <h4 class="card-title">Basic Table</h4>
                                </div>
                                <div class="col-md-4 text-right"> <button id="exporttable" class="btn btn-primary">Excel</button> </div>
                            </div>
                            {{--                cedvel evvel --}}
                            <div class="table-responsive ">
                                <table id="htmltable" class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                    <tr >
                                        <td class="text-left"> {{request()->get('month')}}-{{ request()->get('year')}}</td>
                                        <td colspan="4" class="text-center">Cəmi</td>
                                    </tr>
                                    <tr>
                                        <th>Rabitə xidmətləri</th>
                                        <th>Say</th>
                                        <th>Ədv məbləğ</th>
                                        <th>Əsas məbləğ</th>
                                        <th>Məbləğ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($resultsPhone as $itemPhone)
                                        <tr class="text-left
                                    @if($itemPhone->xidmetin_novu===' ')
                                        text-danger text-bold
                                    @endif
                                        " >
                                            {{--<tr class="text-left">--}}

                                            <td>{{$itemPhone->xidmetin_novu}}

                                                @if($itemPhone->xidmetin_novu===' ' and  $itemPhone->Başlıq === '1.0 Telefon xidmətləri'  )
                                                    <b>  {{$itemPhone->Başlıq}}  üzrə  </b>
                                                @endif
                                                @if($itemPhone->xidmetin_novu===' ' and  $itemPhone->Başlıq === '4.1 İcarə haqqı (Portların  icarəsi)')
                                                    <b>  {{$itemPhone->Başlıq}}  üzrə </b>
                                                @endif
                                                @if($itemPhone->xidmetin_novu===' ' and  $itemPhone->Başlıq === '4.2 İcarə haqqı (Avadanlıqların icarəsi)')
                                                    <b>  {{$itemPhone->Başlıq}}  üzrə </b>
                                                @endif

                                                @if($itemPhone->xidmetin_novu===' ' and  $itemPhone->Başlıq === '4.3 İcarə haqqı (Kabellərin  icarəsi)')
                                                    <b>  {{$itemPhone->Başlıq}}  üzrə </b>
                                                @endif

                                                @if($itemPhone->xidmetin_novu===' ' and  $itemPhone->Başlıq === '5. Servis (ƏDX)')
                                                    <b>  {{$itemPhone->Başlıq}}  üzrə </b>
                                                @endif

                                                @if($itemPhone->xidmetin_novu===' ' and  $itemPhone->Başlıq === '6. Digər')
                                                    <b>  {{$itemPhone->Başlıq}}  üzrə </b>
                                                @endif


                                                @if($itemPhone->xidmetin_novu===' ')
                                                    <b>  {{$itemPhone->xidmetin_novu}} Cəmi  </b>
                                                @endif

                                            </td>
                                            <td>{{$itemPhone->cemi_say}}</td>
                                            <td>{{number_format($edv_umumi=round(($itemPhone->cemi_hesab-round((($itemPhone->cemi_hesab-$itemPhone->idere_edv)/1.18+$itemPhone->idere_edv),2)),2), 2, ',', ' ')}}</td>
                                            <td>{{number_format($esas_umumi=round((($itemPhone->cemi_hesab-$itemPhone->idere_edv)/1.18+$itemPhone->idere_edv),2), 2, ',', ' ')}}</td>
                                            <td>{{number_format($itemPhone->cemi_hesab, 2, ',', ' ')}}</td>

                                        </tr>
                                    @endforeach
                                    </tbody>

                                    {{--senedlesme--}}
                                    @if($resultsPay != Null)
                                        <tr>
                                            <td></td>
                                        </tr>
                                    @endif

                                    <tbody>
                                    @foreach($resultsPay as $itemPay)
                                        <tr class="text-left">
                                            <td >{{$itemPay->xidmetin_novu}}</td>
                                            <td>{{$itemPay->cemi_say}}</td>
                                            <td>{{number_format($cemi_edv=round(($itemPay->cemi_hesab-round((($itemPay->cemi_hesab-$itemPay->idere_edv)/1.18+$itemPay->idere_edv),2)),2), 2, ',', ' ')}}</td>
                                            <td>{{number_format($cemi_esas=( round((($itemPay->cemi_hesab-$itemPay->idere_edv)/1.18+$itemPay->idere_edv),2)), 2, ',', ' ') }}</td>
                                            <td>{{number_format($cemi_mebleg=round(($itemPay->cemi_hesab),2), 2, ',', ' ')}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{--                cedvel son--}}

                            {{--        {{ $cemi_hesab_sum }}--}}

                        @endif
                    </div>




                </div>



            </div>
        </section>

    </main>

    @section('data_table_excell_ccs')

        <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
        <style>
            body {
                background-color: #f9f9fa
            }

            .flex {
                -webkit-box-flex: 1;
                -ms-flex: 1 1 auto;
                flex: 1 1 auto
            }

            @media (max-width:991.98px) {
                .padding {
                    padding: 1.5rem
                }
            }

            @media (max-width:767.98px) {
                .padding {
                    padding: 1rem
                }
            }

            .padding {
                padding: 5rem
            }

            .card {
                box-shadow: none;
                -webkit-box-shadow: none;
                -moz-box-shadow: none;
                -ms-box-shadow: none
            }

            .pl-3,
            .px-3 {
                padding-left: 1rem !important
            }

            .card {
                position: relative;
                display: flex;
                flex-direction: column;
                min-width: 0;
                word-wrap: break-word;
                background-color: #fff;
                background-clip: border-box;
                border: 1px solid #d2d2dc;
                border-radius: 0
            }

            .card .card-title {
                color: #000000;
                margin-bottom: 0.625rem;
                text-transform: capitalize;
                font-size: 0.875rem;
                font-weight: 500
            }

            .card .card-description {
                margin-bottom: .875rem;
                font-weight: 400;
                color: #76838f
            }

            p {
                font-size: 0.875rem;
                margin-bottom: .5rem;
                line-height: .2rem
            }

            .table-responsive {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                -ms-overflow-style: -ms-autohiding-scrollbar
            }

            .table,
            .jsgrid .jsgrid-table {
                width: 100%;
                max-width: 100%;
                margin-bottom: 1rem;
                background-color: transparent
            }

            .table thead th,
            .jsgrid .jsgrid-table thead th {
                border-top: 0;
                border-bottom-width: 1px;
                font-weight: 500;
                font-size: .875rem;
                text-transform: uppercase
            }

            .table td,
            .jsgrid .jsgrid-table td {
                font-size: 0.875rem;
                padding: .875rem 0.9375rem
            }

            .badge {
                border-radius: 0;
                font-size: 12px;
                line-height: 1;
                padding: .375rem .5625rem;
                font-weight: normal
            }

            .btn {
                border-radius: 0
            }</style>
    @endsection

    @section('data_table_excell_js')


        <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
        <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
        <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/jquery.table2excel.min.js"></script>

        <script type='text/javascript' src=''></script>
        <script type='text/javascript' src=''></script>
        <script type='text/Javascript'>
            $(function() {
                $("#exporttable").click(function(e){
                    var table = $("#htmltable");
                    if(table && table.length){
                        $(table).table2excel({
                            exclude: ".noExl",
                            name: "Excel Document Name",
                            filename: "Gelir_Sair_" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
                            fileext: ".xls",
                            exclude_img: true,
                            exclude_links: true,
                            exclude_inputs: true,
                            preserveColors: false
                        });
                    }
                });

            });
        </script>
    @endsection
@endsection

