@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('message')) {{-- kiểm tra xem có một biến session có tên 'message'(message ben UseController.php) hay không. --}}
            <div class="alert alert-primary" role="alert">
                {{ session('message') }}
            </div>
        @endif

        <div>
            <h1>
                List Users
            </h1>
        </div>
        <a href="{{ route('users.create') }}" class="btn btn-primary"> Create</a>
        <div>
            <table class="table table hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->address }}</td>
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                                <form id="deleteForm{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                </form>
                                <button data-form="deleteForm{{ $user->id }}" class="btn btn-delete btn-danger">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Paginate --}}
            <div>
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(function() {
            $(document).on('click', '.btn-delete', function() {
                let formId = $(this).data('form')

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(`#${formId}`).submit();
                    }
                })
                // if (confirm('You want delete it?')) {
                //     $(`#${formId}`).submit();
                // }
            })
        })
    </script>
@endsection

