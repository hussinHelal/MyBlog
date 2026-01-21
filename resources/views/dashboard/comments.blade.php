@extends('layouts.admin')

@section('content')
{{-- <div class="container">
    <div class="row mb-4">
        <div class="col-12 ">
            <h1 class="d-block border-bottom border-black">Blog DashBoard</h1>
        </div>
        <br>
        <div class="col d-flex m-3">
            <div class="row">
            <div class="card m-1" style="width:18rem; border-radius: 22px;">
               <i class="fas fa-newspaper m-2 card-top"></i>
              <div class="card-body">
                <h5 class="card-title"> <i class="fas fa-newspaper me-2"></i> Posts </h5>
                <h6 class="card-subtitle mb-2 text-muted ">Posts count</h6>
                <p class="card-text"> {{ $postCount ?? 0 }} </p>
              </div>
            </div>

            <div class="card m-1" style="width:18rem; border-radius: 22px;">
             <i class="fas fa-clipboard m-2 card-top"></i>
              <div class="card-body">
                <h5 class="card-title"> <i class="fas fa-clipboard me-2"></i> Notes</h5>
                <h6 class="card-subtitle mb-2 text-muted ">Notes Count</h6>
                <p class="card-text"> {{ $NoteCount ?? 0 }} </p>
              </div>
            </div>

            <div class="card m-1" style="width:18rem; border-radius: 22px;">
             <i class="fas fa-comments m-2 card-top"></i>
              <div class="card-body">
                <h5 class="card-title"> <i class="fas fa-comments me-2"></i> Comments</h5>
                <h6 class="card-subtitle mb-2 text-muted ">Comments Count</h6>
                <p class="card-text">{{ $commentCount ?? 0 }}</p>
              </div>
            </div>
     </div>
    </div>
  </div>
</div> --}}

    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="mb-4">Manage Comments</h2>
                <table class="table table-striped table-primary">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Content</th>
                            <th scope="col">Author</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comments as $comment)
                            <tr>
                                <th scope="row">{{ $comment?->id ?? '0'}}</th>
                                <td>{{ $comment?->content ?? 'this comment has no content'}}</td>
                                <td>{{ $comment->author?->name ?? 'this comment has unknown author'}}</td>
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
            </div>
        </div>
    </div>

@endsection
