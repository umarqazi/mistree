$(document).ready(function () {
    $('#password, #confirm_password').on('keyup', function () {
        if ($('#password').val() == $('#confirm_password').val()) {
            $('#message').html('Matching').css('color', 'green');
        } else
            $('#message').html('Not Matching').css('color', 'red');
    });

    //on select/deselect create/destroy service-rates and service-times element blocks

    $('#services').on("change", function (e, params) {
        if(params.selected != undefined)
        {
            $('#services-container').append(
                '<div class="row ' + $('#services option[value="' + params.selected + '"]').text().toLowerCase().replace(' ', '-') + '">' +
                    '<div class="col-md-12">' + '<h5>' + $('#services option[value="' + params.selected + '"]').text() + '</h5>' +
                        '<div class="row">' +
                            '<div class="col-md-6">' +
                                '<div class="form-group">' +
                                    '<label class="control-label">Service Rate <span class="manadatory">*</span></label>' +
                                    '<input type="text" class="form-control border-input" name="service-rates[' + params.selected +']">' +
                                '</div>' +
                            '</div>' +
                            '<div class="col-md-6">' +
                                '<div class="form-group">' +
                                    '<label class="control-label">Service Time <span class="manadatory">*</span></label>' +
                                    '<select name ="service-times[' + params.selected +']" class="form-control chosen-select  border-input"><option value="1.0">1.0 hr</option><option value="1.5">1.5 hr</option><option value="2.0">2.0 hr</option><option value="2.5">2.5 hr</option><option value="3.0">3.0 hr</option><option value="3.5">3.5 hr</option><option value="4.0">4.0 hr</option><option value="4.5">4.5 hr</option><option value="5.0">5.0 hr</option><option value="5.5">5.5 hr</option><option value="6.0">6.0 hr</option><option value="6.5">6.5 hr</option><option value="7.0">7.0 hr</option><option value="7.5">7.5 hr</option><option value="8.0">8.0 hr</option><option value="8.5">8.5 hr</option><option value="9.0">9.0 hr</option><option value="9.5">9.5 hr</option><option value="10">10 hr</option></select> ' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                '</div>'
            );
        }
        else if(params.deselected != undefined)
        {
            $('div.' + $('#services option[value="' + params.deselected + '"]').text().toLowerCase().replace(' ', '-')).remove();
        }
    });

    //old input re-populate Service Name and Class names

    $('input[name*="service-rates"]').each(function(){
        var parent_col_div  = $(this).closest('.col-md-12');
        parent_col_div.parent('.row').addClass($('#services option[value="' + $(this).attr('name').substr(14,1) + '"]').text().toLowerCase().replace(' ','-'));
        parent_col_div.children('h5').text($('#services option[value="' + $(this).attr('name').substr(14,1) + '"]').text());
    });

    
});

function myCustomValidation (obj)
{
   if (!obj.checkValidity()) 
   {
     $(obj).siblings('p').addClass('red');  
     $(obj).siblings('p').text(obj.validationMessage);
    } 
    else 
    {
        $(obj).siblings('p').addClass('green');
        $(obj).siblings('p').text("Input OK");
    } 
}

