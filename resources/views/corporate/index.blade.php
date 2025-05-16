@extends('layouts.dashboard')

@section('title')
    Corporates @parent
@endsection

@section('subtitle')
    Corporates
@endsection

@section('content')
    <main class="mt-2 p-2">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-sm table-hover table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Jobs</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($corporates as $corporate)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $corporate->name }}</td>
                                <td>{{ $corporate->email }}</td>
                                <td>{{ $corporate->phone }}</td>
                                <td>{{ $corporate->address }}</td>
                                <td>{{ $corporate->jobs_count }}</td>
                                <td>
                                    <a href="{{ route('corporates.edit', $corporate->id) }}" class="btn btn-primary btn-sm"><i
                                            class="bi bi-pencil"></i></a>
                                    <a href="{{ route('corporates.show', $corporate->id) }}" class="btn btn-info btn-sm"><i
                                            class="bi bi-eye"></i></a>
                                    <a href="{{ route('corporates.destroy', $corporate->id) }}"
                                        class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination-box p-box-2 text-end">
                <nav aria-label="Page navigation example">
                    <ul class="pagination" id="pagination">
                        {!! $corporates->links() !!}
                    </ul>
                </nav>
            </div>

        </div>
    </main>
@endsection
