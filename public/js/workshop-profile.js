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
                                    '<input type="text" class="form-control border-input" name="service-times[' + params.selected +']">' +
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