

// LOADER
$('#loader')
    .hide() 
    .ajaxStart(function() {
        $(this).show();
    })
    .ajaxStop(function() {
        $(this).hide();
    })
;



// SELECT2 Caller
$('.select2').select2();



// SELECT2 Multiple
$('select[multiple]').select2({
    closeOnSelect: false,
});


// Filter Form Submit Rule
$(document).ready(function($){
   $("#filter_form").submit(function() {
        $(this).find(":input").filter(function(){ return !this.value; }).attr("disabled", "disabled");
        return true;
    });
    $("form").find( ":input" ).prop( "disabled", false );

    $('.datepicker').each(function(){
        $(this).datepicker({
            autoclose: true,
            dateFormat: "mm/dd/yy",
            orientation: "bottom"
        });
    });

    //Tooltip Initialization
    $('[data-toggle="tooltip"]').tooltip();

});



// Price Format
$(".priceformat").priceFormat({
    prefix: "",
    thousandsSeparator: ",",
    clearOnEmpty: true,
    allowNegative: true
});



// Input to Uppercase
$(document).on('blur', "input[data-transform=uppercase]", function () {
    $(this).val(function (_, val) {
        return val.toUpperCase();
    });
});



// iCheck for checkbox and radio inputs
// $('input[type="checkbox"], input[type="radio"]').iCheck({
//   checkboxClass: 'icheckbox_minimal-blue',
//   radioClass   : 'iradio_minimal-blue'
// });



// Date Picker
$('.datepicker').each(function(){
    $(this).datepicker({
        autoclose: true,
        dateFormat: "mm/dd/yy",
        orientation: "bottom"
    });
});



// Time Picker
$('.timepicker').timepicker({
  showInputs: false,
  minuteStep: 1,
  showMeridian: true,
});



// Table Rule
$(document).on('change', 'select[id="action"]', function () {
  var element = $(this).children('option:selected');
  if(element.data('type') == '1' ){ 
    location = element.data('url');
  }
});


// Delete row in Dynamic Table
$(document).on("click","#delete_row" ,function(e) {
    $(this).closest('tr').remove();
});



// PJAX Form Caller
$(document).on('submit', 'form[data-pjax]', function(event) {
    $.pjax.submit(event, '#pjax-container');
});



// PJAX Link Caller
$(document).pjax('a[data-pjax]', '#pjax-container');




// PJAX INITIALIZATIONS
$(document).on('ready pjax:success', function() {
    

    // Filter Form Submit Rule
    $(document).ready(function($){
       $("#filter_form").submit(function() {
            $(this).find(":input").filter(function(){ return !this.value; }).attr("disabled", "disabled");
            return true;
        });
        $("form").find( ":input" ).prop( "disabled", false );
    });


    // Price Format
    $(".priceformat").priceFormat({
        prefix: "",
        thousandsSeparator: ",",
        clearOnEmpty: true,
        allowNegative: true
    });


    // Text to Upper Case
    $(document).on('blur', "input[data-transform=uppercase]", function () {
        $(this).val(function (_, val) {
            return val.toUpperCase();
        });
    });


    // Select2
    $('.select2').select2();


    // Datepicker
    $('.datepicker').each(function(){
        $(this).datepicker({
            autoclose: true,
            dateFormat: "mm/dd/yy",
            orientation: "bottom"
        });
    });


});

//Notify
function notify(message, type){
    $.notify({
              // options
      message: message 
    },{
      // settings
      type: type,
      z_index: 5000,
      delay: 3500,
      placement: {
        from: "top"
        },
      animate:{
            enter: "animated bounceInDown",
            exit: "animated zoomOutRight"
        }
    });
}



function unmark_required(target_form){
    $(target_form + " .has-error").each(function(){
      $(this).removeClass('has-error');
      $(this).children("span").remove();
    });
}

function mark_required(target_form, response){
    $.each(response.responseJSON.errors, function(i, item){
      $(target_form+" ."+i).addClass('has-error');

      $(target_form+" ."+i).append("<span class='help-block'> "+item+" </span>");
    });
}


function wait_button(target_form){
    button = $(target_form+" button[type='submit']");
    button_html = button.html();

    button.html("<i class='fa fa-spinner fa-spin'> </i> Please wait");
    button.attr("disabled","disabled");
    Pace.restart();
}
function unwait_button(target_form , type){
    text = '';
    switch(type){
      case 'save' :
        text = "<i class='fa fa-save'> </i> Save";
        break;
    }
    button = $(target_form+" button[type='submit']");
    button.html(text);
    button.removeAttr('disabled');
}

function succeed(target_form, type,reset){
    if(reset == true){
        $(target_form).get(0).reset();
    }
    unmark_required(target_form);
    unwait_button(target_form, type);
}

function errored(target_form, type, response){
    unwait_button(target_form,type);
    unmark_required(target_form);
    mark_required(target_form,response);
}


function populate_modal(target_modal, response){
    $(target_modal +" #modal_loader").fadeOut(function() {
      $(target_modal +" .modal-content").html(response);

      $('.datepicker').each(function(){
        $(this).datepicker({
              autoclose: true,
              dateFormat: "mm/dd/yy",
              orientation: "bottom"
          });
        });

      $("ol.sortable").sortable();



    });
  }

  function style_datatable(target_table){
    //Search Bar Styling
    $(target_table+'_filter input').css("width","300px");
    $(target_table+"_filter input").attr("placeholder","Press enter to search");
    $(target_table+"_wrapper .dt-buttons").addClass('col-md-4');
    $(target_table+"_wrapper .dataTables_length ").addClass('col-md-3');
    $(".buttons-html5").each(function(index, el) {
      $(this).addClass('btn-sm');
    });
  }

function load_modal(target_modal){
    $(target_modal+" .modal-content").html(modal_loader);
}




function confirm(target_route, slug){
  $.confirm({
          title: 'Confirm!',
          content: 'Are you sure you want to delete this item?',
          type: 'red',
          typeAnimated: true,
          buttons: {
              confirm:{
                  btnClass: 'btn-danger',
                 action: function(){
                  $.ajaxSetup({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                  })
                  $(".jconfirm-holder .btn-danger").attr("disabled","disabled");
                  $(".jconfirm-holder .btn-danger").html("<i class='fa fa-spin fa-spinner'></i> PLEASE WAIT");

                  uri = target_route;
                  uri = uri.replace('slug', slug);
                  Pace.restart();
                  $.ajax({
                      url : uri,
                      type: 'DELETE',
                      success: function(response){
                        
                        notify("Item successfully deleted.", "success");
                        $("tbody #"+response.slug).addClass('danger animated bounceOut');

                        $(".jconfirm-holder .btn-danger").removeAttr("disabled");
                        $(".jconfirm-holder .btn-danger").html("CONFIRM");

                        setTimeout(function(){dt_draw();},1000)
                      },
                      error: function(response){
                        notify("An error occured while deteling the item.", "danger");
                        console.log(response);
                        $(".jconfirm-holder .btn-danger").removeAttr("disabled");
                        $(".jconfirm-holder .btn-danger").html("CONFIRM");
                      }

                  })
                   
                 }

              },
              cancel: function () {
                  
              }
          }
      }); 
  }





