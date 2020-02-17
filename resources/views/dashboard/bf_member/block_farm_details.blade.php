<div class="well well-sm">
  <div class="box box-solid" style="margin-bottom: 5px">
    <div class="box-header with-border">
      <i class="fa icon-farm"></i>
      <h4 class="box-title">Block Farm Details</h4>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <dl>
        <div class="row">
          <div class="col-md-5">
             <dt>Block Farm Name:</dt>
             <dd>{{$block_farm->block_farm_name}}</dd>
          </div>
          <div class="col-md-3">
            <dt>Mill District</dt>
            <dd>{{$block_farm->millDistrict->mill_district}}</dd>
          </div>
          <div class="col-md-4">
            <dt>Enrolee</dt>
            <dd>{{$block_farm->enrolee_name}}</dd>
          </div>
        </div>
      </dl>
    </div>
    <!-- /.box-body -->
  </div>
</div>