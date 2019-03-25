// Remove display: none from navigation menu on large screens
$(window).resize(function() {
    var screen_size = $(window).width();

    if (screen_size > 974) {
        $('#nav-menu').removeAttr('style');
    }
});

// Toggle navigation menu for small screens
$('#nav-btn').on('click', function(){
    $(this).parent().children('#nav-menu').slideToggle('fast');
});

// Content image uploading while adding a new story
$('#upload-img').on('click', function(){
    $('#uploader').click();
});

$('#uploader').on('change', function() {
    if ($(this).val() != '') {
        upload(this);

    }
});

function upload(img) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let form_data = new FormData();
    form_data.append('file', img.files[0]);

    $.ajax({
        type: 'POST',
        url: '/story/new/' + $('#post_id').val(),
        data: form_data,
        contentType: false,
        processData: false,

        success: function (data) {
            $('#img-error').remove();
            $('#content').append('<img src="/img/uploads/'+data+'"><textarea class="hidden" name="content[]">{/img/uploads/'+data+'}</textarea>');
        },
        statusCode: {
            400: function() {
                let error = '<div id="img-error" class="flex mt-8 mb-l justify-center items-center flex-col">\n' +
                            '<span class="w-2/3 invalid-feedback" role="alert">\n' +
                            '<strong>The file must be an image</strong>\n' +
                            '</span>\n' +
                            '</div>';
                $('#top-container').prepend(error);
            }
        }
    });
}

// Generate Textarea for Post Content
$('#createTextField').on('click', function(){
    $('#content').append('<textarea name="content[]" class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 my-6 rounded shadow"></textarea>');
});


/**
 * ========================
 * Admin Dashboard
 * ========================
 */
$('#select_all').on('click', function(){
    $('input[name="select[]"]').prop('checked', this.checked);

    enableBulkDelete();
});

// Enable/Disable Delete All button in Admin Dashboard
function enableBulkDelete() {
    if ($(".admin-dashboard input[type=checkbox]:checked").length > 0) {
        $('#delete-all').removeClass('hidden');
    } else {
        $('#delete-all').addClass('hidden');
    }
}

// Feature/Unfeature Post from Admin Dashboard
function featurePost(el, id) {

    if (confirm('Are you sure you want to change the Featured status of this post?')) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '/admin/featured',
            data: {id: id},

            success: function (data) {
                if (data == 1) {
                    $(el).removeClass('text-black').addClass('text-green-dark');
                    $(el).attr('title', 'Featured');
                } else {
                    $(el).removeClass('text-green-dark').addClass('text-black');
                    $(el).attr('title', 'Un-Featured');
                }
            }
        });
    }
}

// Publish/Unpublish post from Admin Dashboard
function publishPost(el, id) {

    if (confirm('Are you sure you want to change the visibility of this post?')) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '/admin/publish',
            data: {id: id},

            success: function (data) {
                if (data == 1) {
                    $(el).removeClass('text-black').addClass('text-green-dark');
                    $(el).attr('title', 'Featured');
                } else {
                    $(el).removeClass('text-green-dark').addClass('text-black');
                    $(el).attr('title', 'Un-Featured');
                }
            }
        });
    }
}

// Delete Post from Admin Dashboard
function deletePostProcess(el, id, type='') {
    // if (confirm('Are you sure you want to delete this post?')) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '/admin/delete',
            data: {id: id},

            success: function (data) {
                if (type == '') {
                    $(el).parent().parent().fadeOut();
                } else {
                    $(el).parent().parent().parent().fadeOut();
                }
            }
        });
    // }
}

// Enable/Disable Delete All button on selecting a single checkbox in Admin Dashboard
$('.admin-dashboard input[type=checkbox]').on('change', function(){
    enableBulkDelete();
});

// Bulk Delete in Admin Dashboard
$('#delete-all').on('click', function(){
    if (confirm('Are you sure you want to delete the selected posts?')) {
        $.each($("input[name='select[]']:checked"), function(){
            console.log();
            deletePostProcess($(this), $(this).val(), 'bulk');
        });
    }
});

// Single Post Delete in Admin Dashboard
function deletePost(el, id) {
    if (confirm('Are you sure you want to delete this post?')) {
        deletePostProcess(el, id);
    }
}