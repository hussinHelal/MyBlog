@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <div class="row mb-4">

                <h2 class="mb-4">Manage Categories</h2>
                <button
                class="btn btn-primary create-category-btn mb-2"
                data-store-url="{{ route('category.store') }}"
                data-bs-toggle="modal"
                data-bs-target="#createCategoryModal" > Create New Category </button>

                <table class="table table-striped table-primary">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">description</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td scope="row">{{ $category?->id ?? '0'}}</td>
                                <td>{{ $category?->name ?? 'this category has no name'}}</td>
                                <td>{{ $category?->description ?? 'this category has no description'}}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning edit-category-btn"
                                        data-id="{{ $category->id }}"
                                        data-name="{{ $category->name }}"
                                        data-description="{{ $category->description }}"
                                        data-update-url="{{ route('category.update', $category->id) }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editCategoryModal"
                                    >
                                        Edit
                                    </button>
                                    <form action="{{ route('category.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $categories->links() }}
                </div>

                <div class="modal fade" id="createCategoryModal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <form id="createCategoryForm" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="modal-header">
                                <h5 class="modal-title">Create Category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">

                                <div class="mb-3">
                                    <label class="form-label">name</label>
                                    <input type="text" name="name" id="create-name" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" id="create-description" class="form-control" rows="4" required></textarea>
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
            
             <div class="modal fade" id="editCategoryModal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                    <form id="editCategoryForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="modal-header">
                            <h5 class="modal-title">Edit Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">

                            <div class="mb-3">
                                <label class="form-label">name</label>
                                <input type="text" name="name" id="edit-name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" id="edit-description" class="form-control" rows="4" required></textarea>
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
