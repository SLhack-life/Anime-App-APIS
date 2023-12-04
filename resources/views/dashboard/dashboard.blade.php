@extends('include.master')
@section('content')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">



  
<div class="row">

<!-- orders Analytics-->
<!-- <div class="col-lg-9 col-md-9 col-sm-12 mb-4">
  <div class="card">
    <div class="card-header d-flex justify-content-between">
      <div>
        <h5 class="card-title mb-0">Orders</h5>
        <small class="text-muted">Commercial networks</small>
      </div>
      <div class="dropdown">
        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Current Month
        </button>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
          <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
          <a class="dropdown-item" href="javascript:void(0);">September</a>
          <a class="dropdown-item" href="javascript:void(0);">July</a>
          <a class="dropdown-item" href="javascript:void(0);">June</a>
          <a class="dropdown-item" href="javascript:void(0);">May</a>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div id="lineAreaChart"></div>
    </div>
  </div>
          
</div> -->
  <!-- / Content -->

    <!-- orders sales -->
  <!-- <div class="col-md-3 col-lg-3 col-sm-12  mb-4">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title mb-0">Orders</h5>
      </div>
      <div class="card-body ">
        <ul class="p-0 m-0">
          <li class="d-flex mb-4 pb-1">
            <div class="avatar avatar-lg flex-shrink-0 me-3 ">
              <span class="avatar-initial rounded-circle bg-label-primary orders_icon_font"><i class='bx bx-cube'></i></span>
            </div>
            <div class="d-flex flex-column w-100">
              <div class="d-flex justify-content-between mb-2">
                <span>Total Orders</span>
                <span class="text-muted"></span>
              </div>
              <div class="progress" style="height:10px;">
                <div class="progress-bar bg-primary" style="width: 40%" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </li>
          <li class="d-flex mb-4 pb-1">
            <div class="avatar avatar-lg flex-shrink-0 me-3">
              <span class="avatar-initial rounded-circle bg-label-success orders_icon_font"><i class='bx bx-check'></i></span>
            </div>
            <div class="d-flex flex-column w-100">
              <div class="d-flex justify-content-between mb-2">
                <span>Completed Orders</span>
                <span class="text-muted"></span>
              </div>
              <div class="progress" style="height:10px;">
                <div class="progress-bar bg-success" style="width: 80%" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </li>
          <li class="d-flex mb-4 pb-1">
            <div class="avatar avatar-lg flex-shrink-0 me-3">
              <span class="avatar-initial rounded-circle bg-label-warning orders_icon_font"><i class='bx bx-trending-up'></i></span>
            </div>
            <div class="d-flex flex-column w-100">
              <div class="d-flex justify-content-between mb-2">
                <span>Running orders</span>
                <span class="text-muted">12,490</span>
              </div>
              <div class="progress" style="height:10px;">
                <div class="progress-bar bg-warning" style="width: 80%" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </li>
          <li class="d-flex mb-0 pb-3">
            <div class="avatar avatar-lg flex-shrink-0 me-3">
              <span class="avatar-initial rounded-circle bg-label-danger orders_icon_font"><i class='bx bx-x'></i></span>
            </div>
            <div class="d-flex flex-column w-100">
              <div class="d-flex justify-content-between mb-2">
                <span>Rejected Orders</span>
                <span class="text-muted"></span>
              </div>
              <div class="progress" style="height:10px;">
                <div class="progress-bar bg-danger" style="width: 25%" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div> -->
  <!--/ orders sales -->

    <!-- users start -->
<div class="col-lg-6 col-md-6 col-sm-12 mb-4">
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="card-title mb-0">Users</h5>
      <div class="dropdown">
        <button class="btn p-0" type="button" id="analyticsOptions" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="bx bx-dots-vertical-rounded"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="analyticsOptions">
          <a class="dropdown-item" href="javascript:void(0);">Select All</a>
          <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
          <a class="dropdown-item" href="javascript:void(0);">Share</a>
        </div>
      </div>
    </div>
    <div class="card-body pb-2">
      <div class="d-flex justify-content-around align-items-center flex-wrap mb-4">
        <div class="user-analytics text-center me-2">
          <i class="bx bx-user-plus me-1"></i>
          <span>Total Users</span>
          <div class="d-flex align-items-center mt-2">
            <div class="chart-report" data-color="success" data-series="35"></div>
            <h4 class="mb-0">{{$total_users}}</h4>
          </div>
        </div>
        <div class="sessions-analytics text-center me-2">
          <i class="bx bx-user-check me-1"></i>
          <span>Active Users</span>
          <div class="d-flex align-items-center mt-2">
            <div class="chart-report" data-color="warning" data-series="76"></div>
            <h4 class="mb-0">{{$users_active}}</h4>
          </div>
        </div>
        <div class="bounce-rate-analytics text-center">
          <i class="bx bx-user-x me-1"></i>
          <span>Inactive Users</span>
          <div class="d-flex align-items-center mt-2">
            <div class="chart-report" data-color="danger" data-series="65"></div>
            <h4 class="mb-0">{{$users_inactive}}</h4>
          </div>
        </div>
      </div>
      <div id="analyticsBarChart"></div>
    </div>
  </div>

</div>
<!-- users end -->

<!-- Sales -->
<!-- <div class="col-md-3 col-lg-3 col-sm-12  mb-4">
  <div class="card">
    <div class="card-header d-flex align-items-start justify-content-between">
      <div class="card-title mb-0">
        <h5 class="m-0 me-2">Sales</h5>
        <small class="card-subtitle text-muted">Calculated in last 7 days</small>
      </div>
      <div class="dropdown">
        <button class="btn p-0" type="button" id="salesReport" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="bx bx-dots-vertical-rounded"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="salesReport">
          <a class="dropdown-item" href="javascript:void(0);">Select All</a>
          <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
          <a class="dropdown-item" href="javascript:void(0);">Share</a>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div id="salesChart"></div>
      <ul class="p-0 m-0">
        <li class="d-flex mb-3">
          <span class="text-primary me-2"><i class='bx bx-up-arrow-alt bx-sm'></i></span>
          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
            <div class="me-2">
              <h6 class="mb-0 lh-1">Best Selling</h6>
              <small class="text-muted">Saturday</small>
            </div>
            <div class="item-progress">28.6k</div>
          </div>
        </li>
        <li class="d-flex">
          <span class="text-secondary me-2"><i class='bx bx-down-arrow-alt bx-sm'></i></span>
          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
            <div class="me-2">
              <h6 class="mb-0 lh-1">Lowest Selling</h6>
              <small class="text-muted">Thursday</small>
            </div>
            <div class="item-progress">7.9k</div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div> -->
<!--/ Sales -->

  <!--  sales price-->
  <!-- <div class="col-md-3 col-lg-3 col-sm-12  mb-4">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title mb-0">Orders Sales</h5>
      </div>
      <div class="card-body ">
        <ul class="p-0 m-0">
          <li class="d-flex mb-4 pb-1">
            <div class="avatar avatar-lg flex-shrink-0 me-3 ">
              <span class="avatar-initial rounded-circle bg-label-primary orders_icon_font"><i class='bx bx-cube'></i></span>
            </div>
            <div class="d-flex flex-column w-100">
              <div class="d-flex justify-content-between mb-2">
                <span>Total Sales</span>
                <span class="text-muted">$22,459</span>
              </div>
              <div class="progress" style="height:10px;">
                <div class="progress-bar bg-primary" style="width: 40%" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </li>
          <li class="d-flex mb-4 pb-1">
            <div class="avatar avatar-lg flex-shrink-0 me-3">
              <span class="avatar-initial rounded-circle bg-label-success orders_icon_font"><i class='bx bx-check'></i></span>
            </div>
            <div class="d-flex flex-column w-100">
              <div class="d-flex justify-content-between mb-2">
                <span>Completed Orders</span>
                <span class="text-muted">$1,478</span>
              </div>
              <div class="progress" style="height:10px;">
                <div class="progress-bar bg-success" style="width: 80%" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </li>
          <li class="d-flex mb-4 pb-1">
            <div class="avatar avatar-lg flex-shrink-0 me-3">
              <span class="avatar-initial rounded-circle bg-label-warning orders_icon_font"><i class='bx bx-trending-up'></i></span>
            </div>
            <div class="d-flex flex-column w-100">
              <div class="d-flex justify-content-between mb-2">
                <span>Running orders</span>
                <span class="text-muted">$12,490</span>
              </div>
              <div class="progress" style="height:10px;">
                <div class="progress-bar bg-warning" style="width: 80%" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </li>
          <li class="d-flex mb-0 pb-3">
            <div class="avatar avatar-lg flex-shrink-0 me-3">
              <span class="avatar-initial rounded-circle bg-label-danger orders_icon_font"><i class='bx bx-x'></i></span>
            </div>
            <div class="d-flex flex-column w-100">
              <div class="d-flex justify-content-between mb-2">
                <span>Rejected Orders</span>
                <span class="text-muted">$184</span>
              </div>
              <div class="progress" style="height:10px;">
                <div class="progress-bar bg-danger" style="width: 25%" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div> -->
  <!--/  sales price-->



</div>



</div>


<!-- / Content -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    // alert("ok");
 
  ! function() {
      
      // console.log(i,"dkashaskhdaskdhaskd");
      // console.log("hiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii");
    let o, e, r, a, t;
    
      var i = document.querySelector("#analyticsBarChart"),
      // alert(i);
      n = {
                chart: {
                    height: 245,
                    type: "bar",
                    toolbar: {
                        show: !1
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: !1,
                        columnWidth: "20%",
                        borderRadius: 3,
                        startingShape: "rounded"
                    }
                },
                dataLabels: {
                    enabled: !1
                },
                colors: [config.colors.primary, config.colors_label.primary],
                series: [{
                    name: "2020",
                    data: [

                      {{$jan_arr}},
                {{$feb_arr}},
                {{$mar_arr}},
                {{$apr_arr}},
                {{$may_arr}},
                {{$june_arr}},
                {{$july_arr}},
                {{$aug_arr}},
                {{$sept_arr}},
                {{$oct_arr}},
                {{$nov_arr}},
                {{$dec_arr}},
                    ]
                }],
                grid: {
                    borderColor: a,
                    padding: {
                        bottom: -8
                    }
                },
                xaxis: {
                    categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep","oct","nov","dec"],
                    axisBorder: {
                        show: !1
                    },
                    axisTicks: {
                        show: !1
                    },
                    labels: {
                        style: {
                            colors: r
                        }
                    }
                },
                yaxis: {
                    min: 0,
                    max: 30,
                    tickAmount: 3,
                    labels: {
                        style: {
                            colors: r
                        }
                    }
                },
                legend: {
                    show: !1
                },
                tooltip: {
                    y: {
                        formatter: function(o) {
                            return "$ " + o + " thousands"
                        }
                    }
                }
            };
        if (null !== i) {
            const l = new ApexCharts(i, n);
            l.render()
        }
      }();
      

  
</script>

@endsection


