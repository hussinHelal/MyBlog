
import './bootstrap';
import 'bootstrap';
import '../js/bootstrap.js';

import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

import jQuery from 'jquery';
window.$ = window.jQuery = jQuery;




document.addEventListener('DOMContentLoaded', function() {

    const likeButtons = document.querySelectorAll('.add-like-btn');

    likeButtons.forEach(button => {
        button.addEventListener('click', async function(e) {
            e.preventDefault();

            const postId = this.dataset.id;
            const storeUrl = this.dataset.storeUrl;

            try {
                const response = await fetch(storeUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        post_id: postId
                    })
                });

                const data = await response.json();

                if (data.success) {
                    const icon = this.querySelector('i');
                    const span = this.querySelector('span');

                    if (data.liked) {
                        icon.classList.remove('fa-regular');
                        icon.classList.add('fa-solid');
                        this.style.color = '#0d6efd';
                    } else {
                        icon.classList.remove('fa-solid');
                        icon.classList.add('fa-regular');
                        this.style.color = '';
                    }

                    span.textContent = `like (${data.likes_count})`;
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Please login to like posts');
            }
        });
    });
});

$(document).on('click', '.edit-post-btn', function (e) {
    let postId = $(this).data('id');
    let title = $(this).data('title');
    let content = $(this).data('content');
    let image = $(this).data('image');
    let tag = $(this).data('tag');
    let category = $(this).data('category');

    $('#edit-title').val(title);
    $('#edit-content').val(content);
    $('#edit-tag').val(tag);
    $('#edit-image').val(image);
    $('#edit-category').val(category);
    $('#editPostForm').attr('action', $(this).data('update-url'));
});

$(document).on('submit', '#editPostForm', function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            $('#editPostModal').modal('hide');
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
    $('#create-image').val('');

    $('#createPostForm').attr('action', $(this).data('store-url'));
});

$(document).on('submit', '#createPostForm', function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            $('#createPostModal').modal('hide');
            window.location.href = window.LaravelConfig.adminUrl + "/posts";
        },
        error: function (xhr) {
            console.log(xhr.responseText);
            alert('Error ' + xhr.status + ': ' + xhr.responseJSON.message);
        }
    });
});

$(document).on('click', '.create-category-btn', function (e) {
    $('#create-name').val('');
    $('#create-content').val('');
    $('#createCategoryForm').attr('action', $(this).data('store-url'));
});

$(document).on('submit', '#createCategoryForm', function (e) {
    e.preventDefault();
    let formData = new FormData(this);

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            $('#createCategoryModal').modal('hide');
            window.location.href = window.LaravelConfig.adminUrl + "/category";
        },
        error: function (xhr) {
            console.log(xhr.responseText);
            let errorMsg = 'An error occurred';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMsg = xhr.responseJSON.message;
            } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                errorMsg = Object.values(xhr.responseJSON.errors).flat().join('\n');
            }

            alert('Error: ' + errorMsg);
        }
    });
});


$(document).on('click', '.edit-category-btn', function (e) {
    let name = $(this).data('name');
    let description = $(this).data('description');

    $('#edit-name').val(name);
    $('#edit-description').val(description);
    $('#editCategoryForm').attr('action', $(this).data('update-url'));
});

$(document).on('submit', '#editCategoryForm', function (e) {
    e.preventDefault();

    let formData = new FormData(this);
    formData.append('_method', 'PUT');

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            $('#editCategoryModal').modal('hide');
            window.location.href = window.LaravelConfig.adminUrl + "/category";
        },
        error: function (xhr) {
            console.log(xhr.responseText);
            alert('Error ' + xhr.status + ': ' + xhr.responseJSON.message);
        }
    });
});

$(document).on('click', '.create-user-btn', function (e) {
    $('#create-name').val('');
    $('#create-email').val('');
    $('#create-password').val('');
    $('#create-password_confirmation').val('');

    $('#createUserForm').attr('action', $(this).data('store-url'));
});

$(document).on('submit', '#createUserForm', function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            $('#createUserModal').modal('hide');
            window.location.href = window.LaravelConfig.adminUrl + "/users";
        },
        error: function (xhr) {
            console.log(xhr.responseText);
            alert('Error ' + xhr.status + ': ' + xhr.responseJSON.message);
        }
    });
});

$(document).on('click', '.edit-tag-btn', function (e) {
    let name = $(this).data('name');

    $('#edit-name').val(name);
    $('#editTagForm').attr('action', $(this).data('update-url'));
});

$(document).on('submit', '#editTagForm', function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            $('#editTagModal').modal('hide');
            window.location.href = window.LaravelConfig.adminUrl + "/tags";
        },
        error: function (xhr) {
            console.log(xhr.responseText);
            alert('Error ' + xhr.status + ': ' + xhr.responseJSON.message);
        }
    });
});

$(document).on('click', '.edit-user-btn', function (e) {

    let name = $(this).data('name');
    let email = $(this).data('email');
    let password = $(this).data('password');
    let role = $(this).data('role');

    $('#edit-name').val(name);
    $('#edit-email').val(email);
    $('#edit-password').val(password);
    $('#edit-role').val(role);
    $('#editTagForm').attr('action', $(this).data('update-url'));
});

$(document).on('submit', '#editUserModal', function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            $('#editTagModal').modal('hide');
            window.location.href = window.LaravelConfig.adminUrl + "/users";
        },
        error: function (xhr) {
            console.log(xhr.responseText);
            alert('Error ' + xhr.status + ': ' + xhr.responseJSON.message);
        }
    });
});

$(document).on('click', '.create-tag-btn', function (e) {
    $('#create-name').val('');
    $('#createTagForm').attr('action', $(this).data('store-url'));
});

$(document).on('submit', '#createTagForm', function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            $('#createTagModal').modal('hide');
            window.location.href = window.LaravelConfig.adminUrl + "/tags";
        },
        error: function (xhr) {
            console.log(xhr.responseText);
            let message = xhr.responseJSON?.message || 'An error occurred';
            if (xhr.responseJSON?.errors) {
                message = Object.values(xhr.responseJSON.errors).flat().join('\n');
            }
            alert('Error ' + xhr.status + ': ' + message);
        }
    });
});

$(document).on('click', '.delete-tag-btn', function (e) {

    e.preventDefault();

    if (!confirm('Are you sure you want to delete this tag?')) {
        return;
    }

    let deleteUrl = $(this).data('delete-url');

    $.ajax({
        url: deleteUrl,
        type: 'DELETE',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            window.location.href = window.LaravelConfig.adminUrl + "/tags";
        },
        error: function (xhr) {
            console.log(xhr.responseText);
            alert('Error ' + xhr.status + ': ' + (xhr.responseJSON?.message || 'An error occurred') );
        }
    });
});

    $(document).on('click', '.delete-user-btn', function (e) {

        e.preventDefault();

        if (!confirm('Are you sure you want to delete this user?')) {
            return;
        }


    let deleteUrl = $(this).data('delete-url');

    $.ajax({
        url: deleteUrl,
        type: 'DELETE',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            window.location.href = window.LaravelConfig.adminUrl + "/users";
        },
        error: function (xhr) {
            console.log(xhr.responseText);
            alert('Error ' + xhr.status + ': ' + (xhr.responseJSON?.message || 'An error occurred') );
        }
         });
    });
    $(document).on('click', '.delete-post-btn', function (e) {

        e.preventDefault();

        if (!confirm('Are you sure you want to delete this post?')) {
            return;
        }


    let deleteUrl = $(this).data('delete-url');

    $.ajax({
        url: deleteUrl,
        type: 'DELETE',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            window.location.href = window.LaravelConfig.adminUrl + "/posts";
        },
        error: function (xhr) {
            console.log(xhr.responseText);
            alert('Error ' + xhr.status + ': ' + (xhr.responseJSON?.message || 'An error occurred') );
        }
     });
    });
    $(document).on('click', '.delete-category-btn', function (e) {

        e.preventDefault();

        if (!confirm('Are you sure you want to delete this category?')) {
            return;
        }


    let deleteUrl = $(this).data('delete-url');

    $.ajax({
        url: deleteUrl,
        type: 'DELETE',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            window.location.href = window.LaravelConfig.adminUrl + "/category";
        },
        error: function (xhr) {
            console.log(xhr.responseText);
            alert('Error ' + xhr.status + ': ' + (xhr.responseJSON?.message || 'An error occurred') );
        }
     });
    });


