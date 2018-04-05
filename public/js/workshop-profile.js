$(document).ready(function () {
    $('#password, #confirm_password').on('keyup', function () {
        if ($('#password').val() == $('#confirm_password').val()) {
            $('#message').html('Matching').css('color', 'green');
        } else
            $('#message').html('Not Matching').css('color', 'red');
    });

    //on select/deselect create/destroy service-rates and service-times element blocks

    $('#hatchback').on("change", function (e, params) {
        if(params.selected != undefined)
        {
            $('.category-hatchback').append(
                '<div class="col-md-12 hatchback-service-'+$('#hatchback option[value="' + params.selected + '"]').val() + '">' +
                    '<div class="heading-service"><h5>' + $('#hatchback option[value="' + params.selected + '"]').text() + '</h5></div>' +
                        '<div class="row">' +
                            '<div class="col-md-6">' +
                                '<div class="form-group">' +
                                    '<label class="control-label">Service Rate <span class="manadatory">*</span></label>' +
                                    '<input type="number" class="form-control border-input"' +
                ' name="hatchback-rates[' + params.selected +']" required max="99999">' +
                                '</div>' +
                            '</div>' +
                            '<div class="col-md-6">' +
                                '<div class="form-group">' +
                                    '<label class="control-label">Service Time <span class="manadatory">*</span></label>' +
                                    '<select name ="hatchback-times[' + params.selected +']" id="hatchback-times-' + params.selected +'" class="form-control' +
                ' chosen-select  border-input"><option value="1.0">1.0 hr</option><option value="1.5">1.5 hr</option><option value="2.0">2.0 hr</option><option value="2.5">2.5 hr</option><option value="3.0">3.0 hr</option><option value="3.5">3.5 hr</option><option value="4.0">4.0 hr</option><option value="4.5">4.5 hr</option><option value="5.0">5.0 hr</option><option value="5.5">5.5 hr</option><option value="6.0">6.0 hr</option><option value="6.5">6.5 hr</option><option value="7.0">7.0 hr</option><option value="7.5">7.5 hr</option><option value="8.0">8.0 hr</option><option value="8.5">8.5 hr</option><option value="9.0">9.0 hr</option><option value="9.5">9.5 hr</option><option value="10">10 hr</option></select> ' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                '</div>'
            );
            $('#hatchback-times-' + params.selected).chosen();
        }
        else if(params.deselected != undefined)
        {
            $('div.hatchback-service-' + $('#hatchback option[value="' + params.deselected + '"]').val()).remove();
        }
    });

    $('#sedan').on("change", function (e, params) {
        if (params.selected != undefined) {
            $('.category-sedan').append(
                '<div class="col-md-12 sedan-service-' + $('#sedan option[value="' + params.selected + '"]').val() + '">' +
                    '<div class="heading-service"><h5>' + $('#sedan option[value="' + params.selected + '"]').text() + '</h5></div>' +
                        '<div class="row">' +
                            '<div class="col-md-6">' +
                                '<div class="form-group">' +
                                    '<label class="control-label">Service Rate <span class="manadatory">*</span></label>' +
                                    '<input type="number" class="form-control border-input"' +
                ' name="sedan-rates[' + params.selected + ']" required max="99999" >' +
                                '</div>' +
                            '</div>' +
                            '<div class="col-md-6">' +
                                '<div class="form-group">' +
                                    '<label class="control-label">Service Time <span class="manadatory">*</span></label>' +
                                    '<select name ="sedan-times[' + params.selected + ']" id="sedan-times-' + params.selected +'" class="form-control' +
                ' chosen-select  border-input"><option value="1.0">1.0 hr</option><option value="1.5">1.5 hr</option><option value="2.0">2.0 hr</option><option value="2.5">2.5 hr</option><option value="3.0">3.0 hr</option><option value="3.5">3.5 hr</option><option value="4.0">4.0 hr</option><option value="4.5">4.5 hr</option><option value="5.0">5.0 hr</option><option value="5.5">5.5 hr</option><option value="6.0">6.0 hr</option><option value="6.5">6.5 hr</option><option value="7.0">7.0 hr</option><option value="7.5">7.5 hr</option><option value="8.0">8.0 hr</option><option value="8.5">8.5 hr</option><option value="9.0">9.0 hr</option><option value="9.5">9.5 hr</option><option value="10">10 hr</option></select> ' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                '</div>'
            );
            $('#sedan-times-' + params.selected).chosen();
        }
        else if (params.deselected != undefined) {
            $('div.sedan-service-' + $('#sedan option[value="' + params.deselected + '"]').val()).remove();
        }
    });

    $('#luxury').on("change", function (e, params) {
        if(params.selected != undefined)
        {
            $('.category-luxury').append(
                '<div class="col-md-12 luxury-service-' + $('#luxury option[value="' + params.selected + '"]').val() + '">' +
                    '<div class="heading-service"><h5>' + $('#luxury option[value="' + params.selected + '"]').text() + '</h5></div>' +
                        '<div class="row" required>' +
                            '<div class="col-md-6">' +
                                '<div class="form-group">' +
                                    '<label class="control-label">Service Rate <span class="manadatory">*</span></label>' +
                                    '<input type="number" class="form-control border-input" required max="99999" ' + ' name="luxury-rates[' + params.selected +']">'  +
                                '</div>' +
                            '</div>' +
                            '<div class="col-md-6">' +
                                '<div class="form-group">' +
                                    '<label class="control-label">Service Time <span class="manadatory">*</span></label>' +
                                    '<select name ="luxury-times[' + params.selected +']" id="luxury-times-' + params.selected +'" class="form-control' + ' chosen-select  border-input"><option value="1.0">1.0 hr</option><option value="1.5">1.5 hr</option><option value="2.0">2.0 hr</option><option value="2.5">2.5 hr</option><option value="3.0">3.0 hr</option><option value="3.5">3.5 hr</option><option value="4.0">4.0 hr</option><option value="4.5">4.5 hr</option><option value="5.0">5.0 hr</option><option value="5.5">5.5 hr</option><option value="6.0">6.0 hr</option><option value="6.5">6.5 hr</option><option value="7.0">7.0 hr</option><option value="7.5">7.5 hr</option><option value="8.0">8.0 hr</option><option value="8.5">8.5 hr</option><option value="9.0">9.0 hr</option><option value="9.5">9.5 hr</option><option value="10">10 hr</option></select> ' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                '</div>'
            );
            $('#luxury-times-' + params.selected).chosen();
        }
        else if(params.deselected != undefined)
        {
            $('div.luxury-service-' + $('#luxury option[value="' + params.deselected + '"]').val()).remove();
        }
    });

    $('#suv').on("change", function (e, params) {
        if(params.selected != undefined)
        {
            $('.category-suv').append(
                '<div class="col-md-12 suv-service-' + $('#suv option[value="' + params.selected + '"]').val() + '">' +
                    '<div class="heading-service"><h5>' + $('#suv option[value="' + params.selected + '"]').text() + '</h5></div>' +
                        '<div class="row">' +
                            '<div class="col-md-6">' +
                                '<div class="form-group">' +
                                    '<label class="control-label">Service Rate <span class="manadatory">*</span></label>' +
                                    '<input type="number" class="form-control border-input"' + ' name="suv-rates[' + params.selected +']" required max="99999" >' +
                                '</div>' +
                            '</div>' +
                            '<div class="col-md-6">' +
                                '<div class="form-group">' +
                                    '<label class="control-label">Service Time <span class="manadatory">*</span></label>' +
                                    '<select name ="suv-times[' + params.selected +']" id="suv-times-' + params.selected +'" class="form-control' + ' chosen-select  border-input"><option value="1.0">1.0 hr</option><option value="1.5">1.5 hr</option><option value="2.0">2.0 hr</option><option value="2.5">2.5 hr</option><option value="3.0">3.0 hr</option><option value="3.5">3.5 hr</option><option value="4.0">4.0 hr</option><option value="4.5">4.5 hr</option><option value="5.0">5.0 hr</option><option value="5.5">5.5 hr</option><option value="6.0">6.0 hr</option><option value="6.5">6.5 hr</option><option value="7.0">7.0 hr</option><option value="7.5">7.5 hr</option><option value="8.0">8.0 hr</option><option value="8.5">8.5 hr</option><option value="9.0">9.0 hr</option><option value="9.5">9.5 hr</option><option value="10">10 hr</option></select> ' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                '</div>'
            );
            $('#suv-times-' + params.selected).chosen();
        }
        else if(params.deselected != undefined)
        {
            $('div.suv-service-' + $('#suv option[value="' + params.deselected + '"]').val()).remove();
        }
    });



    //old input re-populate Service Name and Class names

    $('input[name*="service-rates"]').each(function(){
        var parent_col_div  = $(this).closest('.col-md-12');
        parent_col_div.parent('.row').addClass($('#services option[value="' + $(this).attr('name').substr(14,1) + '"]').text().toLowerCase().replace(' ','-'));
        parent_col_div.children('h5').text($('#services option[value="' + $(this).attr('name').substr(14,1) + '"]').text());
    });

    
});

function workshopCustomValidation (obj)
{
   if (!obj.checkValidity())
   {
     $(obj).siblings('p').addClass('red');  
     $(obj).siblings('p').text(obj.validationMessage);
    } 
    else 
    {
        $(obj).siblings('p').text("");
    }  
}
