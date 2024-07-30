// ajax on ready
$(document).ready(function () {
    $('.openReviewModal').click(function () {
        //get this attributes
        var project_id = $(this).data('project_id');
        var freelancer_id = $(this).data('freelancer_id');
        var freelancer_name = $(this).data('freelancer_name');
        var freelancer_photo = $(this).data('freelancer_photo');

        // change img src
        $('#freelancer_avatar').attr('src', freelancer_photo);
        //change span text
        $('#freelancer_name').text(freelancer_name);

        //change input value
        $('#project_id').val(project_id);
        $('#freelancer_id').val(freelancer_id);


        $('#write-review').modal('show');
    })
})
