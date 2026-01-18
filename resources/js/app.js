
import './bootstrap';
import 'bootstrap';
import '../js/bootstrap.bundle.js';

import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

import jQuery from 'jquery';
window.$ = window.jQuery = jQuery;


// $(document).on('click', '.edit-post-btn', function () {

//     preventDefault();

//     let postId = $(this).data('id');
//     let title = $(this).data('title');
//     let content = $(this).data('content');

//     $('#edit-title').val(title);
//     $('#edit-content').val(content);

//     $('#editPostForm').attr('action', $(this).data('update-url'));
// });

// $(document).on('click', '.create-post-btn', function () {

//     $('#create-title').val('');
//     $('#create-content').val('');

//     $('#createPostForm').attr('action', $(this).data('store-url'));
// });




$(document).on('click', '.edit-post-btn', function (e) {
    let postId = $(this).data('id');
    let title = $(this).data('title');
    let content = $(this).data('content');

    $('#edit-title').val(title);
    $('#edit-content').val(content);
    $('#editPostForm').attr('action', $(this).data('update-url'));
});

$(document).on('submit', '#editPostForm', function (e) {
    e.preventDefault();

    let formData = new FormData(this);
    // let adminUrl = "{{ url('admin') }}";
    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            window.location.href = window.LaravelConfig.adminUrl + "/posts";
        },
        error: function (xhr) {
            console.log(xhr.responseText);
            alert('Error ' + xhr.status + ': ' + xhr.responseJSON.message);
        }
    });
});

$(document).on('click', '.create-post-btn', function (e) {
    $('#create-title').val('');
    $('#create-content').val('');
    $('#createPostForm').attr('action', $(this).data('store-url'));
});

$(document).on('submit', '#createPostForm', function (e) {
    e.preventDefault();

    let formData = new FormData(this);
    let adminUrl = "{{ url('admin') }}";

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            window.location.href = window.LaravelConfig.adminUrl + "/posts";
        },
        error: function (xhr) {
            console.log(xhr.responseText);
            alert('Error ' + xhr.status + ': ' + xhr.responseJSON.message);
        }
    });
});
