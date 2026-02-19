@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <div class="row mb-4">

                <h2 class="mb-4">Manage Tags</h2>
                <button
                class="btn btn-primary create-tag-btn mb-2"
                data-store-url="{{ route('tags.store') }}"
                data-bs-toggle="modal"
                data-bs-target="#createTagModal" > Create New Tag </button>

                <table class="table table-primary table-striped-columns ">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tags as $tag)
                            <tr>
                                <th scope="row">{{ $tag?->id ?? '0'}}</th>
                                <td >{{ $tag?->name ?? 'this tag has no name'}}</td>
                                <td >{{ $tag->created_at?->format('M d, Y') ?? 'unknown date'}}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning edit-tag-btn"
                                        data-id="{{ $tag->id }}"
                                        data-name="{{ $tag->name }}"
                                        data-update-url="{{ route('tags.update', $tag->id) }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editTagModal"
                                    >
                                        Edit
                                    </button>

                                    <button
                                        data-id="{{ $tag->id }}"
                                        data-name="{{ $tag->name }}"
                                        data-delete-url="{{ route('tags.destroy', $tag->id) }}"
                                        class="btn btn-sm btn-danger delete-tag-btn" style="display:inline-block;"
                                    >
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $tags->links() }}
                </div>

                <div class="modal fade" id="createTagModal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <form id="createTagForm" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="modal-header">
                                <h5 class="modal-title">Create Tag</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">

                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" id="create-name" class="form-control" required>
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
                <div class="modal fade" id="editTagModal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                    <form id="editTagForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="modal-header">
                            <h5 class="modal-title">Edit Tag</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">


                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" id="edit-name" class="form-control" required>
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
