function imagezoom(obj) {
    var src = obj.src;
    $('#pictureModal').modal('show');
    $("#imagesrc").attr("src",src);
    $('.modal-backdrop').hide();
}