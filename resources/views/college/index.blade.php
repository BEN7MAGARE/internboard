@extends('layouts.dashboard')

@section('title')
    Colleges @parent
@endsection

@section('subtitle')
    Colleges
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
                            <th>Students</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($colleges as $college)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $college->name }}</td>
                                <td>{{ $college->email }}</td>
                                <td>{{ $college->phone }}</td>
                                <td>{{ $college->address }}</td>
                                <td>{{ $college->students_count }}</td>
                                <td>
                                    <a href="{{ route('colleges.edit', $college->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i></a>
                                    <a href="{{ route('colleges.show', $college->id) }}" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('colleges.destroy', $college->id) }}" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination-box p-box-2 text-end">
                <nav aria-label="Page navigation example">
                    <ul class="pagination" id="pagination">
                        {!! $colleges->links() !!}
                    </ul>
                </nav>
            </div>
        </div>
    </main>
@endsection