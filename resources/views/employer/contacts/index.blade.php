@extends('layouts.dashboard')

@section('title')
    College Contact @parent
@endsection

@section('subtitle')
    College Contact
@endsection

@section('content')
    <main class="mt-3 p-2">
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <i class="bi bi-info-circle-fill"></i>&nbsp;<strong>Note:</strong> You can add persons who can help you
            manage your business activities on this platform. They will have access to your business information. and
            operations provided by this platform.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <div class="card p-2">

            <div class="card-header">
                <div class="d-flex justify-content-end gap-2">
                    <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#createCorporateUserModal" id="createCorporateUserToggle"><i class="bi bi-plus"></i>
                        Add
                        new</a>
                    <div class="dropdown">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Actions
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item text-danger" href="#" id="deleteContact"><i
                                        class="bi bi-trash"></i>&nbsp;Delete</a></li>
                            <li><a class="dropdown-item text-info" href="#" id="exportContact"><i
                                        class="bi bi-file-earmark-excel"></i>&nbsp;Export</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body pt-3 table-container">
                <table class="table table-hover table-striped table-bordered table-sm">
                    <thead>
                        <th scope="col"><input type="checkbox" name="contact_id[]" value="" id="allContactSelect">
                        </th>
                        <th>#</th>
                        <th>Name</th>
                        <th>Address </th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Alt. Phone</th>
                        <th>Actions</th>
                    </thead>

                    <tbody>
                        @foreach ($contacts as $item)
                            <tr>
                                <td><input type="checkbox" name="contact_id[]" value="{{ $item->id }}"></td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->title . ' ' . $item->first_name . ' ' . $item->middle_name . ' ' . $item->last_name }}
                                </td>
                                <td>{{ $item->address }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->alt_phone }}</td>
                                <td>
                                    <a href="#" data-id="{{ $item->id }}" class="btn btn-primary btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#createCorporateUserModal"
                                        id="editContactToggle"><i class="bi bi-pencil-square"></i></a>
                                    <a href="{{ route('employer.contacts.show', $item->id) }}"
                                        class="btn btn-info btn-sm"><i class="bi bi-eye-fill"></i></a>
                                    <a href="#" class="btn btn-danger btn-sm" data-contactid="{{ $item->id }}"
                                        id="deleteContactToggle"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="text-end">{{ $contacts->links() }}</tfoot>
                </table>
            </div>
        </div>
    </main>
@endsection

@section('footer_scripts')
    <div class="modal fade" id="createCorporateUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="createCorporateUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createCorporateUserModalLabel">Create Contact Person</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('users.store') }}" method="POST" id="corporateUserCreateForm">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="corporateUserID" value="">
                        <div class="row">

                            <input type="hidden" name="corporate_id" id="corporateUserID"
                                value="{{ auth()->user()->corporate_id }}">

                            <div class="col-md-6 mb-2">
                                <label for="name" class="form-label">First Name</label>
                                <input type="text" class="form-control" name="first_name" id="corporateUserFirstName"
                                    required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="name" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" name="middle_name"
                                    id="corporateUserMiddleName">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="corporateUserLastName"
                                    required>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="corporateUserEmail"
                                    required>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone" id="corporateUserPhone"
                                    required>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="altPhone" class="form-label">Alternative Phone</label>
                                <input type="text" class="form-control" name="alt_phone" id="collegeUseraltPhone">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" id="corporateUserAddress">
                            </div>

                        </div>
                    </div>

                    <div id="corporateUserFeedback"></div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="corporateUserCreateSubmit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/sweetalert.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
    <script src="{{ asset('js/employer/contacts.js') }}"></script>
@endsection
