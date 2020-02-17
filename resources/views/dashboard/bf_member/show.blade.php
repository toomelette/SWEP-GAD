<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">{{ $bf_member->lastname }}, {{ $bf_member->firstname }}</h4>
  </div>
  <div class="modal-body">
  	<div class="nav-tabs-custom">
  		<ul class="nav nav-tabs">
  			<li class="active"><a href="#tab_31" data-toggle="tab">Farmer information</a></li>
  			<li><a href="#tab_32" data-toggle="tab">Family Members</a></li>
  		</ul>
  		<div class="tab-content">
  			<div class="tab-pane active" id="tab_31">
  				<b>How to use:</b>

  				<p>Exactly like the original bootstrap tabs except you should use
  					the custom wrapper <code>.nav-tabs-custom</code> to achieve this style.</p>
  					A wonderful serenity has taken possession of my entire soul,
  					like these sweet mornings of spring which I enjoy with my whole heart.
  					I am alone, and feel the charm of existence in this spot,
  					which was created for the bliss of souls like mine. I am so happy,
  					my dear friend, so absorbed in the exquisite sense of mere tranquil existence,
  					that I neglect my talents. I should be incapable of drawing a single stroke
  					at the present moment; and yet I feel that I never was a greater artist than now.
  				</div>
  				<!-- /.tab-pane -->
  				<div class="tab-pane" id="tab_32">
  					The European languages are members of the same family. Their separate existence is a myth.
  					For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
  					in their grammar, their pronunciation and their most common words. Everyone realizes why a
  					new common language would be desirable: one could refuse to pay expensive translators. To
  					achieve this, it would be necessary to have uniform grammar, pronunciation and more common
  					words. If several languages coalesce, the grammar of the resulting language is more simple
  					and regular than that of the individual languages.
  				</div>
  				<!-- /.tab-pane -->
  			</div>
  			<!-- /.tab-content -->
  		</div>
   
	


  </div>
  <div class="modal-footer">
  	<div class="row">
		{!! __html::timestamps(
			$bf_member->creator['firstname'] ." ".$bf_member->creator['lastname'],
			$bf_member->created_at,
			$bf_member->updater['firstname'] ." ". $bf_member->updater['lastname'],
			$bf_member->updated_at,"4"
		) !!}	
		<div class="col-md-4">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
    
  </div>
</div>