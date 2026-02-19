@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <div class="row mb-4">

                <h2 class="mb-4">Manage Posts</h2>
                <button
                class="btn btn-primary create-post-btn mb-2"
                data-store-url="{{ route('posts.store') }}"
                data-bs-toggle="modal"
                data-bs-target="#createPostModal" > <i class="fa-solid fa-plus me-1"></i>
                    Create New Post
                </button>

                <table class="table table-primary table-striped-columns ">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Content</th>
                            <th scope="col">Author</th>
                            <th scope="col">Category</th>
                            <th scope="col">image</th>
                            <th scope="col">tags</th>
                            <th scope="col">views</th>
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
                                <td >{{ $post->user?->name ?? 'this post has no author name'}}</td>
                                <td >{{ $post->category?->name ?? 'this post has no category'}}</td>
                                <td > @if($post->image_path) <img src="{{ asset('storage/'. $post?->image_path) ?? 'this post has no image'}}" class="img-fluid" style="max-height:60px;"> @else no Image @endif</td>
                                <td >
                                    {{ $post->tags->pluck('name')->join(', ') ?: 'No tags' }}
                                </td>
                                <td >{{ $post?->views ?? 'this post has no views'}}</td>
                                <td >{{ $post->created_at?->format('M d, Y') ?? 'unknown date'}}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning edit-post-btn"
                                            data-id="{{ $post->id }}"
                                            data-title="{{ $post->title }}"
                                            data-content="{{ $post->content }}"
                                            data-category="{{ $post->category_id }}"
                                            data-tags="{{ $post->tags->pluck('id')->toJson() }}"
                                            data-image="{{ $post->image ? asset('storage/' . $post->image_path) : '' }}"
                                            data-update-url="{{ route('posts.update', $post->id) }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editPostModal"
                                    >
                                        <i class="fa-solid fa-edit me-1"></i>
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
                                    <label for="create-title" class="form-label">Title</label>
                                    <input type="text" name="title" id="create-title" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="create-category" class="form-label">Category</label>
                                    <select name="category_id" id="create-category" class="form-select"  required>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="create-tag" class="form-label">Tags (optional)</label>
                                    <select name="tags[]" id="create-tag" class="form-select" multiple>
                                    @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted">Hold Ctrl/Cmd to select multiple tags</small>
                                </div>

                                <div class="mb-3">
                                    <label for="create-content" class="form-label">Content</label>
                                    <textarea name="content" id="create-content" class="form-control" rows="6" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="create-image" class="form-label">Image (optional)</label>
                                    <input type="file" name="image" id="create-image" class="form-control" accept="image/*">
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Cancel
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa-solid fa-check me-1"></i>
                                    Create Post
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
                                    <label for="edit-title" class="form-label">Title</label>
                                    <input type="text" name="title" id="edit-title" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="edit-category" class="form-label">Category</label>
                                    <select name="category_id" id="edit-category" class="form-select" required>
                                        <option value="">Select a category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="edit-tag" class="form-label">Tags (optional)</label>
                                    <select name="tags[]" id="edit-tag" class="form-select" multiple >
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted">Hold Ctrl/Cmd to select multiple tags</small>
                                </div>

                                <div class="mb-3">
                                    <label for="edit-content" class="form-label">Content</label>
                                    <textarea name="content" id="edit-content" class="form-control" rows="6" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="edit-image" class="form-label">Image (optional)</label>
                                    <input type="file" name="image" id="edit-image" class="form-control" accept="image/*">
                                    <small class="text-muted">Leave empty to keep current image</small>
                                    <div id="current-image-preview" class="mt-2"></div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Cancel
                                </button>
                                <button type="submit" class="btn btn-warning">
                                    <i class="fa-solid fa-save me-1"></i>
                                    Update Post
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
