@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Dashboard</h1>
</section>

<section class="content">
	<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>000</h3>

              <p>Sample Data</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>0.1<sup style="font-size: 20px">%</sup></h3>

              <p>Sample Data</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>44</h3>

              <p>Sample Data</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>65</h3>

              <p>Sample Data</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

     <div class="row">
     	<div class="col-md-12">
     		<div class="panel">
     			<div class="panel-body">
     				<canvas id="scholars" width="400" height="100"></canvas>
     			</div>
     		</div>
     	</div>
     </div>
</div>
</section>

@endsection


@section('scripts')

<script type="text/javascript">
	var ctx = $('#scholars');
	var scholars = new Chart(ctx, {
	    type: 'line',
	    data: {
	        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
	        datasets: [
	        	{
		            label: 'Male Scholars',
		            data: [12, 19, 3, 5, 2, 3, 25, 34, 15, 2, 11, 54],
		            backgroundColor: [
		                'rgba(51, 153, 255, 0.2)'
		            ],
		            borderColor: [
		                'rgba(0, 76, 153, 1)'
		            ],
		            borderWidth: 1.2
	        	},
	        	{
		            label: 'Female Scholars',
		            data: [10, 3, 4, 6, 9, 3, 16, 42, 18, 11, 5, 30],
		            backgroundColor: [
		                'rgba(255, 99, 132, 0.2)'
		            ],
		            borderColor: [
		                'rgba(255, 99, 132, 1)'
		            ],
		            borderWidth: 1.2
	        	}
	        ]
	    },
	    options: {
	        scales: {
	            yAxes: [{
	                ticks: {
	                    beginAtZero: true
	                }
	            }]
	        }
	    }
	});
</script>
@endsection