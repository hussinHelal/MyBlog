@extends('layouts.admin')

@section('content')


    <div class="container-fluid">
        <div class="row mb-4">

                <h2 class="mb-4">Manage Users</h2>
                <button
                class="btn btn-primary create-user-btn mb-2"
                data-store-url="{{ route('register') }}"
                data-bs-toggle="modal"
                data-bs-target="#createUserModal"> Create User </button>
                <table class="table table-striped table-primary">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">email</th>
                            <th scope="col">role</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{ $user?->id ?? '0'}}</th>
                                <td>{{ $user?->name ?? 'unknown user'}}</td>
                                <td>{{ $user?->email ?? 'unknown user email'}}</td>
                                <td>{{ $user?->role ?? 'this user has no role'}}</td>
                                <td>{{ $user->created_at?->format('M d, Y') ?? 'unknown date'}}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning edit-user-btn"
                                        data-id="{{ $user->id }}"
                                        data-name="{{ $user->name }}"
                                        data-email="{{ $user->email }}"
                                        data-password="{{ $user->password }}"
                                        data-update-url="{{ route('user.update', $user->id) }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editUserModal"
                                    > Edit </button>
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $users->links() }}
                </div>

        </div>
    </div>
    </div>

    <div class="modal fade" id="createUserModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="createUserForm" method="POST" enctype="multipart/form-data" >
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title"> Create New User </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label" for="name">name</label>
                        <input type="text" id="create-name" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="email">email</label>
                        <input type="text" id="create-email" name="email" class="form-control" required>
                    </div>


                    <div class="mb-3">
                        <label for="password" class="form-label">password</label>
                        <input type="text" id="create-password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">password confirm</label>
                        <input type="text" id="create-password_confirmation" name="password_confirmation" class="form-control" required>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Create</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancel</button>
                    </div>

                    </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editUserModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="editUserForm" method="post" enctype="multipart/form-data">
                @csrf
                @method("PUT")

                <div class="modal-header">
                    <h5 class="modal-title"> Edit User </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>


                <div class="mb-3">
                    <label for="name">name</label>
                    <input type="text" id="edit-name" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email">email</label>
                    <input type="text" id="edit-email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password">password</label>
                    <input type="text" id="edit-password" name="password" class="form-control" required>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Create</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancel</button>
                </div>

                </form>
            </div>
        </div>
    </div>

@endsection
