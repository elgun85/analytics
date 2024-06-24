@extends('Page.layout.master')
@section('title','Telnet İstifadəçilər  ')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Blank Page</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Pages</li>
                <li class="breadcrumb-item active">Blank</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->







    <section class="section dashboard">
        <div class="row mr-3">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Category </h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-ui-radios-grid"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$statistics->categoryTitleCount}}</h6>
{{--
                                        <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>
--}}

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Position Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Position </h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-reception-4"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$statistics->positionTitleCount}}</h6>
{{--
                                        <span class="text-success small pt-1 fw-bold">8</span> <span class="text-muted small pt-2 ps-1">increase</span>
--}}

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Position Card -->

                    <!-- personnel Card -->
                    <div class="col-xxl-4 col-xl-12">

                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Personnels </h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$statistics->loginCount}}</h6>
                                        <span class="text-success small pt-1 fw-bold">{{$statistics->statusCount1}}</span> <span class="text-muted small pt-2 ps-1">aktiv</span>
                                        <span class="text-danger small pt-1 fw-bold">{{$statistics->statusCount0}}</span> <span class="text-muted small pt-2 ps-1">passiv</span>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div><!-- End personnel Card -->





                    <livewire:telnet.category/>
                    <livewire:telnet.position/>
                    <livewire:telnet.personnel/>


                    <!-- Top Position  -->

                    <!-- End Top Position  -->



                </div>
            </div>
            <!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">
                <!-- Website Traffic -->
                <div class="card">
{{--                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>--}}

                    <div class="card-body pb-0">
                        <h5 class="card-title">Website Traffic</h5>

<livewire:telnet.chart/>
                        {{--
                                                <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

                                                <script>
                                                    document.addEventListener("DOMContentLoaded", () => {
                                                        echarts.init(document.querySelector("#trafficChart")).setOption({
                                                            tooltip: {
                                                                trigger: 'item'
                                                            },
                                                            legend: {
                                                                top: '5%',
                                                                left: 'center'
                                                            },
                                                            series: [{
                                                                name: 'Access From',
                                                                type: 'pie',
                                                                radius: ['40%', '70%'],
                                                                avoidLabelOverlap: false,
                                                                label: {
                                                                    show: false,
                                                                    position: 'center'
                                                                },
                                                                emphasis: {
                                                                    label: {
                                                                        show: true,
                                                                        fontSize: '18',
                                                                        fontWeight: 'bold'
                                                                    }
                                                                },
                                                                labelLine: {
                                                                    show: false
                                                                },
                                                                data: [{
                                                                    value: 1048,
                                                                    name: 'Search Engine'
                                                                },
                                                                    {
                                                                        value: 735,
                                                                        name: 'Direct'
                                                                    },
                                                                    {
                                                                        value: 580,
                                                                        name: 'Email'
                                                                    },
                                                                    {
                                                                        value: 484,
                                                                        name: 'Union Ads'
                                                                    },
                                                                    {
                                                                        value: 300,
                                                                        name: 'Video Ads'
                                                                    }
                                                                ]
                                                            }]
                                                        });
                                                    });
                                                </script>
                                                --}}

                    </div>
                </div>
                <!-- End Website Traffic -->
            </div>
            <!-- End Right side columns -->

        </div>
    </section>


</main><!-- End #main -->




@endsection


