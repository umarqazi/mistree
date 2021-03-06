type = ['','info','success','warning','danger'];

demo = {
    initPickColor: function(){
        $('.pick-class-label').click(function(){
            var new_class = $(this).attr('new-class');
            var old_class = $('#display-buttons').attr('data-class');
            var display_div = $('#display-buttons');
            if(display_div.length) {
                var display_buttons = display_div.find('.btn');
                display_buttons.removeClass(old_class);
                display_buttons.addClass(new_class);
                display_div.attr('data-class', new_class);
            }
        });
    },

    initChartist: function(){

        var dataSales = {
            labels: ['9:00AM', '12:00AM', '3:00PM', '6:00PM', '9:00PM', '12:00PM', '3:00AM', '6:00AM'],
            series: [
                [287, 385, 490, 562, 594, 626, 698, 895, 952],
                [67, 152, 193, 240, 387, 435, 535, 642, 744],
                [23, 113, 67, 108, 190, 239, 307, 410, 410]
            ]
        };

        var optionsSales = {
            lineSmooth: false,
            low: 0,
            high: 1000,
            showArea: true,
            height: "245px",
            axisX: {
                showGrid: false,
            },
            lineSmooth: Chartist.Interpolation.simple({
                divisor: 3
            }),
            showLine: true,
            showPoint: false,
        };

        var responsiveSales = [
            ['screen and (max-width: 640px)', {
                axisX: {
                    labelInterpolationFnc: function (value) {
                        return value[0];
                    }
                }
            }]
        ];

        Chartist.Line('#chartHours', dataSales, optionsSales, responsiveSales);


        var data = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            series: [
                [542, 543, 520, 680, 653, 753, 326, 434, 568, 610, 756, 895],
                [230, 293, 380, 480, 503, 553, 600, 664, 698, 710, 736, 795]
            ]
        };

        var options = {
            seriesBarDistance: 10,
            axisX: {
                showGrid: false
            },
            height: "245px"
        };

        var responsiveOptions = [
            ['screen and (max-width: 640px)', {
                seriesBarDistance: 5,
                axisX: {
                    labelInterpolationFnc: function (value) {
                        return value[0];
                    }
                }
            }]
        ];

        Chartist.Line('#chartActivity', data, options, responsiveOptions);

        var dataPreferences = {
            series: [
                [25, 30, 20, 25]
            ]
        };

        var optionsPreferences = {
            donut: true,
            donutWidth: 40,
            startAngle: 0,
            total: 100,
            showLabel: false,
            axisX: {
                showGrid: false
            }
        };

        Chartist.Pie('#chartPreferences', dataPreferences, optionsPreferences);

        Chartist.Pie('#chartPreferences', {
            labels: ['62%','32%','6%'],
            series: [62, 32, 6]
        });
    },

    initGoogleMaps: function(){
        var myLatlng = new google.maps.LatLng(40.748817, -73.985428);
        var mapOptions = {
            zoom: 13,
            center: myLatlng,
            scrollwheel: false, //we disable de scroll over the map, it is a really annoing when you scroll through page
            styles: [{"featureType":"water","stylers":[{"saturation":43},{"lightness":-11},{"hue":"#0088ff"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"hue":"#ff0000"},{"saturation":-100},{"lightness":99}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#808080"},{"lightness":54}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ece2d9"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#ccdca1"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#767676"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#b8cb93"}]},{"featureType":"poi.park","stylers":[{"visibility":"on"}]},{"featureType":"poi.sports_complex","stylers":[{"visibility":"on"}]},{"featureType":"poi.medical","stylers":[{"visibility":"on"}]},{"featureType":"poi.business","stylers":[{"visibility":"simplified"}]}]

        }
        var map = new google.maps.Map(document.getElementById("map"), mapOptions);

        var marker = new google.maps.Marker({
            position: myLatlng,
            title:"Hello World!"
        });

        // To add the marker to the map, call setMap();
        marker.setMap(map);
    },

    showNotification: function(from, align){
        color = Math.floor((Math.random() * 4) + 1);

        $.notify({
            icon: "ti-gift",
            message: "Welcome to <b>Paper Dashboard</b> - a beautiful freebie for every web developer."

        },{
            type: type[color],
            timer: 4000,
            placement: {
                from: from,
                align: align
            }
        });
    },
    initDocumentationCharts: function(){
        //     	init single simple line chart
        var dataPerformance = {
            labels: ['6pm','9pm','11pm', '2am', '4am', '8am', '2pm', '5pm', '8pm', '11pm', '4am'],
            series: [
                [1, 6, 8, 7, 4, 7, 8, 12, 16, 17, 14, 13]
            ]
        };

        var optionsPerformance = {
            showPoint: false,
            lineSmooth: true,
            height: "200px",
            axisX: {
                showGrid: false,
                showLabel: true
            },
            axisY: {
                offset: 40,
            },
            low: 0,
            high: 16,
            height: "250px"
        };

        Chartist.Line('#chartPerformance', dataPerformance, optionsPerformance);

        //     init single line with points chart
        var dataStock = {
            labels: ['\'07','\'08','\'09', '\'10', '\'11', '\'12', '\'13', '\'14', '\'15'],
            series: [
                [22.20, 34.90, 42.28, 51.93, 62.21, 80.23, 62.21, 82.12, 102.50, 107.23]
            ]
        };

        var optionsStock = {
            lineSmooth: false,
            height: "200px",
            axisY: {
                offset: 40,
                labelInterpolationFnc: function(value) {
                    return '$' + value;
                }

            },
            low: 10,
            height: "250px",
            high: 110,
            classNames: {
                point: 'ct-point ct-green',
                line: 'ct-line ct-green'
            }
        };

        Chartist.Line('#chartStock', dataStock, optionsStock);

        //      init multiple lines chart
        var dataSales = {
            labels: ['9:00AM', '12:00AM', '3:00PM', '6:00PM', '9:00PM', '12:00PM', '3:00AM', '6:00AM'],
            series: [
                [287, 385, 490, 562, 594, 626, 698, 895, 952],
                [67, 152, 193, 240, 387, 435, 535, 642, 744],
                [23, 113, 67, 108, 190, 239, 307, 410, 410]
            ]
        };

        var optionsSales = {
            lineSmooth: false,
            low: 0,
            high: 1000,
            showArea: true,
            height: "245px",
            axisX: {
                showGrid: false,
            },
            lineSmooth: Chartist.Interpolation.simple({
                divisor: 3
            }),
            showLine: true,
            showPoint: false,
        };

        var responsiveSales = [
            ['screen and (max-width: 640px)', {
                axisX: {
                    labelInterpolationFnc: function (value) {
                        return value[0];
                    }
                }
            }]
        ];

        Chartist.Line('#chartHours', dataSales, optionsSales, responsiveSales);

        //      pie chart
        Chartist.Pie('#chartPreferences', {
            labels: ['62%','32%','6%'],
            series: [62, 32, 6]
        });

        //      bar chart
        var dataViews = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            series: [
                [542, 443, 320, 780, 553, 453, 326, 434, 568, 610, 756, 895]
            ]
        };

        var optionsViews = {
            seriesBarDistance: 10,
            classNames: {
                bar: 'ct-bar'
            },
            axisX: {
                showGrid: false,

            },
            height: "250px"

        };

        var responsiveOptionsViews = [
            ['screen and (max-width: 640px)', {
                seriesBarDistance: 5,
                axisX: {
                    labelInterpolationFnc: function (value) {
                        return value[0];
                    }
                }
            }]
        ];

        Chartist.Bar('#chartViews', dataViews, optionsViews, responsiveOptionsViews);

        //     multiple bars chart
        var data = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            series: [
                [542, 543, 520, 680, 653, 753, 326, 434, 568, 610, 756, 895],
                [230, 293, 380, 480, 503, 553, 600, 664, 698, 710, 736, 795]
            ]
        };

        var options = {
            seriesBarDistance: 10,
            axisX: {
                showGrid: false
            },
            height: "245px"
        };

        var responsiveOptions = [
            ['screen and (max-width: 640px)', {
                seriesBarDistance: 5,
                axisX: {
                    labelInterpolationFnc: function (value) {
                        return value[0];
                    }
                }
            }]
        ];

        Chartist.Line('#chartActivity', data, options, responsiveOptions);

    }

}


$(".chosen-select").chosen({width: "100%"});

$('.cn-section-2').hide();
$('.cn-section-3').hide();

$(document).ready(function(){

    $(".btn-back-1").click(function(event){
        event.preventDefault();
        $('.cn-section-1').show();
        $('.cn-section-2').hide();
        $('.cn-section-3').hide();
    });

    $(".btn-back-2").click(function(event){
        event.preventDefault();
        $('.cn-section-1').hide();
        $('.cn-section-2').show();
        $('.cn-section-3').hide();
    });


    $('.file1').hide();
    $('.file2').hide();

    function readURL1(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#file1').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imgInp1").change(function() {
        $('.file1').show();
        readURL1(this);
    });


    function readURL2(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#file2').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imgInp2").change(function() {
        $('.file2').show();
        readURL2(this);
    });



    $('#jsTable').DataTable({
        /* Disable initial sort */
        "aaSorting": []
    });


    $(".nav > li a.query_links").click(function(e){
        e.preventDefault();
        $(".subnav").toggleClass("show_ul");
        $(this).children("i").last().toggleClass("ti-angle-down ti-angle-up");
    });


    /* Header Notification Code */
    $('.notification_links, .notification_lnks').click(function (e) {
        var a_element = $(this);
        e.preventDefault();
        var notif_id = $(this).attr('notif-id');

        $.ajax({
            url: '/notifications/markasread',
            type: 'GET',
            data: {id: notif_id},
            success: function (data) {
                if(data){
                    if(data == 1){
                        window.location.href = a_element.attr("href");
                    }
                }
            }
        });
    });
});


$(document).ready(function () {

    loadGallery(true, 'a.thumbnail');

    //This function disables buttons when needed
    function disableButtons(counter_max, counter_current) {
        $('#show-previous-image, #show-next-image').show();
        if (counter_max == counter_current) {
            $('#show-next-image').hide();
        } else if (counter_current == 1) {
            $('#show-previous-image').hide();
        }
    }

    /**
     *
     * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
     * @param setClickAttr  Sets the attribute for the click handler.
     */

    function loadGallery(setIDs, setClickAttr) {
        var current_image,
            selector,
            counter = 0;

        $('#show-next-image, #show-previous-image').click(function () {
            if ($(this).attr('id') == 'show-previous-image') {
                current_image--;
            } else {
                current_image++;
            }

            selector = $('[data-image-id="' + current_image + '"]');
            updateGallery(selector);
        });

        function updateGallery(selector) {
            var $sel = selector;
            current_image = $sel.data('image-id');
            $('#image-gallery-caption').text($sel.data('caption'));
            $('#image-gallery-title').text($sel.data('title'));
            $('#image-gallery-image').attr('src', $sel.data('image'));
            disableButtons(counter, $sel.data('image-id'));
        }

        if (setIDs == true) {
            $('[data-image-id]').each(function () {
                counter++;
                $(this).attr('data-image-id', counter);
            });
        }
        $(setClickAttr).on('click', function () {
            updateGallery($(this));
        });
    }
});
