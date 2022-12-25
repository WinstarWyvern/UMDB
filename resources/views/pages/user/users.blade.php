@extends('layouts.app')
@section('title', 'User List')

@section('content')
    <div class="container">
        @if (session()->has('deleted'))
            <div class="row justify-content-center">
                <div class="alert alert-danger alert-dismissible col-md-6" role="alert">
                    {{ session('deleted') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if (session()->has('updated'))
            <div class="row justify-content-center">
                <div class="alert alert-warning alert-dismissible col-md-6" role="alert">
                    {{ session('updated') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <div class="bg-white my-md-2">
            <div
                class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">User List</h1>
            </div>

            <div class="table-responsive col-lg-12">
                <table class="table table-lg">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                    <form method="POST" action="{{ route('users.update', $user) }}" class="d-inline">
                                        @method('patch')
                                        @csrf
                                        @if ($user->isAdmin)
                                            <button class="badge bg-success border-0"
                                                onclick="return confirm('Do you really want to take his admin role from this user ?')"><i
                                                    class="bi bi-eye"></i></button>
                                        @else
                                            <button class="badge bg-dark border-0"
                                                onclick="return confirm('Do you really want to make this user an admin ?')"><i
                                                    class="bi bi-eye-slash"></i></button>
                                        @endif
                                    </form>

                                    <form method="POST" action="{{ route('users.destroy', $user) }}" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="badge bg-danger border-0"
                                            onclick="return confirm('Do you really want to delete this user ?')"><i
                                                class="bi bi-trash2"></i></button>
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
