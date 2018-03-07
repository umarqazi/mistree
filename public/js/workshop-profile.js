$(document).ready(function () {
    $('#password, #confirm_password').on('keyup', function () {
        if ($('#password').val() == $('#confirm_password').val()) {
            $('#message').html('Matching').css('color', 'green');
        } else
            $('#message').html('Not Matching').css('color', 'red');
    });

    $('#services option:selected').each(function(){
        $('#services-container').append(
            '<div class="row ' + $(this).text().toLowerCase().replace(' ', '-') + '">' +
                '<div class="col-md-12">' + '<h5>' + $(this).text() + '</h5>' +
                    '<div class="row">' +
                        '<div class="col-md-6">' +
                            '<div class="form-group">' +
                                '<label class="control-label">Service Rate <span class="manadatory">*</span></label>' +
                                '<input type="text" class="form-control border-input" name="service-rates[' + $(this).val() +']">' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-md-6">' +
                            '<div class="form-group">' +
                                '<label class="control-label">Service Time <span class="manadatory">*</span></label>' +
                                '<input type="text" class="form-control border-input" name="service-times[' + $(this).val() +']">' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
            '</div>'
        );
    });

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
});