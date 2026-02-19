@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <div class="row mb-4">
                <h2 class="mb-4">Manage Comments</h2>
                <table class="table table-striped table-primary">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Content</th>
                            <th scope="col">User_id</th>
                            <th scope="col">Post_id</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comments as $comment)
                            <tr>
                                <th scope="row">{{ $comment?->id ?? '0'}}</th>
                                <td>{{ $comment?->content ?? 'this comment has no content'}}</td>
                                <td>{{ $comment->user?->id ?? 'this comment has unknown author'}}</td>
                                <td>{{ $comment->post?->id ?? 'this comment has unknown author'}}</td>
                                <td>{{ $comment->created_at?->format('M d, Y') ?? 'unknown date'}}</td>
                                <td>
                                    {{-- <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-sm btn-warning">Edit</a> --}}
                                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this comment?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $comments->links() }}
                </div>
        </div>
    </div>

@endsection
