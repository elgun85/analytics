@extends('Page.layout.master')
@section('title','Xidmətlər üzrə gəlir')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>@yield('title')</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('gelir')}}" method="get" name="formdan">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <select id="abon1" class="form-control" name="month"
                                            aria-label="Default select example">
                                        <option value="" selected>Ay seçin</option>
                                        @if(request()->get('month') !=0)
                                            <option @if(request()->get('month')) selected
                                                    @endif   value="{{request()->get('month')}}">{{request()->get('month')}}</option>
                                        @endif
                                        @foreach($months as $month)
                                            @if(request()->get('month')!=$month->month)
                                                <option value="{{$month->month}}">{{$month->month}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-2">
                                    <select id="abon1" class="form-control" name="year"
                                            aria-label="Default select example">
                                        <option value="" selected>İl seçin</option>
                                        @if(request()->get('month') !=0)
                                            <option @if(request()->get('year')) selected
                                                    @endif   value="{{request()->get('year')}}">{{request()->get('year')}}</option>
                                        @endif
                                        @foreach($years as $year)
                                            @if(request()->get('year')!=$year->year)
                                                <option value="{{$year->year}}">{{$year->year}}</option>
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
                                    <h4 class="card-title">@yield('title')</h4>
                                </div>
                                <div class="col-md-4 text-right">
                                    <button id="exporttable" class="btn btn-primary">Excel</button>
                                </div>
                            </div>
                            {{--                cedvel evvel --}}
                            <div class="table-responsive ">
                                <table id="htmltable" class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                    <tr>
                                        <td class="text-left"> {{request()->get('month')}}
                                            -{{ request()->get('year')}}</td>
                                        <td colspan="1" class="text-center"></td>
                                        <td colspan="4" class="text-center">Fiziki</td>
                                        <td colspan="4" class="text-center">Hüquqi</td>
                                        <td colspan="4" class="text-center">Ümumi</td>
                                    </tr>
                                    <tr class="text-center">
                                        <th>Kod</th>
                                        <th class="text-left">Tarifin adı</th>

                                        <th>Say</th>
                                        <th>Əsas</th>
                                        <th>Ədv</th>
                                        <th>Cəmi</th>


                                        <th>Say</th>
                                        <th>Əsas</th>
                                        <th>Ədv</th>
                                        <th>Cəmi</th>

                                        <th>Say</th>
                                        <th>Əsas</th>
                                        <th>Ədv</th>
                                        <th>Cəmi</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($resultsData as $data)
                                        <tr class="text-center">
                                            <td>{{$data->KODTARIF}}</td>
                                            <td class="text-left" style="font-family: Arial;">
{{--
                                                 {{ ucfirst(mb_strtolower($data->ADTARIF, 'UTF-8')) }}
                                                 {{ mb_strtoupper($data->ADTARIF, 'UTF-8') }}
--}}


                                                {{ mb_convert_case(mb_strtolower($data->ADTARIF, 'UTF-8'), MB_CASE_TITLE, 'UTF-8') }}


                                            </td>

                                            <td>{{$data->menzil_say}}</td>
                                            <td>{{number_format(round(($menzil_esas= $data->menzil_summa/1.18),2), 2, ',', ' ')}}</td>
                                            <td>{{number_format(round(($menzil_edv= $data->menzil_summa-($data->menzil_summa/1.18)),2), 2, ',', ' ')}}</td>
                                            <td>{{number_format($data->menzil_summa, 2, ',', ' ')}}</td>

                                            <td>{{$data->idere_say}}</td>
                                            <td>{{number_format($esas_idare_mebleg=round((($data->idere_summa-$data->idere_edv)/1.18+$data->idere_edv),2), 2, ',', ' ')}}</td>
                                            <td>{{number_format($qur_edv=round(($data->idere_summa-round((($data->idere_summa-$data->idere_edv)/1.18+$data->idere_edv),2)),2), 2, ',', ' ')}}</td>
                                            <td>{{number_format($qur_meb=round(($data->idere_summa),2), 2, ',', ' ')}}</td>

                                            <td>{{$data->cemi_say}}</td>
                                            <td>{{number_format($esas_umumi=round((($data->cemi_hesab-$data->idere_edv)/1.18+$data->idere_edv),2), 2, ',', ' ')}}</td>
                                            <td>{{number_format($edv_umumi=round(($data->cemi_hesab-round((($data->cemi_hesab-$data->idere_edv)/1.18+$data->idere_edv),2)),2), 2, ',', ' ')}}</td>
                                            <td>{{number_format($data->cemi_hesab, 2, ',', ' ')}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->

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

            @media (max-width: 991.98px) {
                .padding {
                    padding: 1.5rem
                }
            }

            @media (max-width: 767.98px) {
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

        <script type='text/javascript'
                src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
        <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
        <script src=" https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/jquery.table2excel.min.js"></script>

        <script type='text/javascript' src=''></script>
        <script type='text/javascript' src=''></script>
        <script type='text/Javascript'>
            $(function () {
                $("#exporttable").click(function (e) {
                    var table = $("#htmltable");
                    if (table && table.length) {
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


