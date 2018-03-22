$(document).ready(function () {
    $(":input").inputmask();
    $(".btn-next-1").click(function(event){
    event.preventDefault();

      var name          = $("[name='name']")[0].checkValidity();
      var email         = $("[name='email']")[0].checkValidity();
      var owner_name    = $("[name='owner_name']")[0].checkValidity();
      var type          = $("[name='type']")[0].checkValidity();
      var cnic          = $("[name='cnic']")[0].checkValidity();
      var mobile        = $("[name='mobile']")[0].checkValidity(); 
      var landline      = $("[name='landline']")[0].checkValidity();
      var team_slot     = $("[name='team_slot']")[0].checkValidity();
      var open_time     = $("[name='open_time']")[0].checkValidity();
      var close_time    = $("[name='close_time']")[0].checkValidity(); 
    //  var cnic_image    = $("[name='cnic_image']")[0].checkValidity();

      if((name && email && owner_name && type && cnic  && mobile && landline && team_slot && open_time && close_time  ) == false )
        {
            $('.cn-section-1').show();
            $('.cn-section-2').hide();
            $('.cn-section-3').hide();
            $(".cn-section-1 :input").focus();
        }
      else
        {
            $('.cn-section-1').hide();
            $('.cn-section-2').show();
            $('.cn-section-3').hide();
        } 

        }); 

    $(".btn-next-2").click(function(event){  
      var shop          = $("[name='shop']")[0].checkValidity();
      var building      = $("[name='building']")[0].checkValidity();
      var owner_name    = $("[name='owner_name']")[0].checkValidity();
      var street        = $("[name='street']")[0].checkValidity();
      var block         = $("[name='block']")[0].checkValidity();
      var town          = $("[name='town']")[0].checkValidity();
      var city          = $("[name='city']")[0].checkValidity();

      if(shop && building && owner_name && street && block && town && city == false)
      {
        event.preventDefault();
        $('.cn-section-1').hide();
        $('.cn-section-2').show();
        $('.cn-section-3').hide();
        $(".cn-section-2 :input").focus();
      }
      else
      {
        event.preventDefault();
        $('.cn-section-1').hide();
        $('.cn-section-2').hide();
        $('.cn-section-3').show();
      }

    });

    });