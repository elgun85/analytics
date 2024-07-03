@extends('Page.layout.master')
@section('title','Digər provayderlər üzrə statistika')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>@yield('title')</h1>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            {{--                cedvel evvel --}}
                            <table id="example1" class="table table-bordered table-striped ">
                                <thead class="text-center text-bold">
                                <tr>
                                    <td class="text-left">Provayder adı</td>
                                    <td>İstafəçi sayı</td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $bul = ['Ў', '?', 'ў', 'Ё', 'ё', '·', '√', '№', '¤', 'Ї', 'ї', '°', '∙', 'Є', 'є'];
                                $dey = ['Ə', 'Ə', 'ə', 'Ö', 'ö', 'I', 'ı', 'Ü', 'ü', 'Ş', 'ş', 'Ğ', 'ğ', 'Ç', 'ç'];
                                {{-- {{str_replace( $bul,$dey,$item->ADQURUM)}}--}}
                                ?>
                                @foreach($data as $ItemDP)
                                    <tr>
                                        <td>
                                            @if($ItemDP->cem == 'cemi')
                                                Cəmi
                                            @else
                                                {{substr(str_replace( $bul,$dey,$ItemDP->ADQURUM),0,50)}}
                                            @endif
                                        </td>
                                        <td>{{$ItemDP->say}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                            {{--                cedvel son--}}

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->

    @section('data_table_ccs')
        <link rel="stylesheet" type="text/css"
              href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css"
              href="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.11.3/b-2.2.1/b-colvis-2.2.1/b-html5-2.2.1/b-print-2.2.1/kt-2.6.4/sb-1.3.0/sp-1.4.0/sl-1.3.4/datatables.min.css"/>
    @endsection

    @section('data_table_js')
        <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript"
                src="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.11.3/b-2.2.1/b-colvis-2.2.1/b-html5-2.2.1/b-print-2.2.1/kt-2.6.4/sb-1.3.0/sp-1.4.0/sl-1.3.4/datatables.min.js"></script>

        <script>
            $(function () {
                $("#example1").DataTable({
                    "pageLength": 15,
                    "lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "All"]],
                    "responsive": true,
                    // "lengthChange": false,
                    // "autoWidth": false,
                    "buttons": ["copy", "excel", "print", "colvis"]
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

