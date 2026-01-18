@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <div class="row mb-4">

                <h2 class="mb-4">Manage Posts</h2>
               <button
                class="btn btn-primary create-post-btn mb-2"
                data-store-url="{{ route('posts.store') }}"
                data-bs-toggle="modal"
                data-bs-target="#createPostModal" > Create New Post </button>

                <table class="table table-primary table-striped-columns ">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Content</th>
                            <th scope="col">Author</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <th scope="row">{{ $post?->id ?? '0'}}</th>
                                <td >{{ $post?->title ?? 'this post has no title'}}</td>
                                <td >{{ $post?->content ?? 'this post has no content'}}</td>
                                <td >{{ $post->author?->name ?? 'this post has no author'}}</td>
                                <td >{{ $post->created_at?->format('M d, Y') ?? 'unknown date'}}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning edit-post-btn"
                                        data-id="{{ $post->id }}"
                                        data-title="{{ $post->title }}"
                                        data-content="{{ $post->content }}"
                                        data-image="{{ $post->image_path }}"
                                        data-update-url="{{ route('posts.update', $post->id) }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editPostModal"
                                    >
                                        Edit
                                    </button>
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $posts->links() }}
                </div>

                <div class="modal fade" id="createPostModal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <form id="createPostForm" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="modal-header">
                                <h5 class="modal-title">Create Post</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">

                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="title" id="create-title" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Content</label>
                                    <textarea name="content" id="create-content" class="form-control" rows="4" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Image</label>
                                    <input type="file" name="image" class="form-control">
                                    <small class="text-muted">
                                        Leave empty to keep current image
                                    </small>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Create</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Cancel
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

                <div class="modal fade" id="editPostModal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                    <form id="editPostForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="modal-header">
                            <h5 class="modal-title">Edit Post</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">

                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" id="edit-title" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Content</label>
                                <textarea name="content" id="edit-content" class="form-control" rows="4" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" name="image" class="form-control">
                                <small class="text-muted">
                                    Leave empty to keep current image
                                </small>
                            </div>

                        </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>
                    </div>

                    </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
