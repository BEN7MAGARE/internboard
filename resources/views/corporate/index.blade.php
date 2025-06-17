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
            <div class="card-header">
                <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">

                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100 active" id="corporates-tab" data-bs-toggle="tab"
                            data-bs-target="#corporatesTab" type="button" role="tab" aria-controls="corporates"
                            aria-selected="true">Corporates</button>
                    </li>

                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100" id="contactPersons-tab" data-bs-toggle="tab"
                            data-bs-target="#contactPersonsTab" type="button" role="tab" aria-controls="contactPersons"
                            aria-selected="false">Contact Persons</button>
                    </li>
                </ul>
            </div>
            <div class="card-body">

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="corporatesTab" role="tabpanel"
                        aria-labelledby="corporates-tab">
                        <div class="d-flex justify-content-end gap-2 mb-2">
                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#createCorporateModal" id="createCorporateToggle"><i
                                    class="bi bi-plus"></i>Add corporate</a>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Actions
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item text-danger" href="#" id="deleteCorporate"><i
                                                class="bi bi-trash"></i>&nbsp;Delete</a></li>
                                    <li><a class="dropdown-item text-info" href="#" id="exportCorporate"><i
                                                class="bi bi-file-earmark-excel"></i>&nbsp;Export</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="table-container">
                            <table class="table table-bordered table-sm table-hover table-striped scrollableTable">
                                <thead>
                                    <tr>
                                        <th scope="col"><input type="checkbox" name="corporate_id[]" value=""
                                                id="allCorporateSelect"></th>
                                        <th>#</th>
                                        <th>Category</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Size</th>
                                        <th>Jobs</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($corporates as $corporate)
                                        <tr>
                                            <td><input type="checkbox" name="corporate_id[]" value="{{ $corporate->id }}">
                                            </td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $corporate->category?->name }}</td>
                                            <td>{{ $corporate->name }}</td>
                                            <td>{{ $corporate->email }}</td>
                                            <td>{{ $corporate->phone }}</td>
                                            <td>{{ $corporate->address }}</td>
                                            <td>{{ $corporate->size }}</td>
                                            <td>{{ $corporate->jobs_count }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm"
                                                    id="editCorporateToggle" data-bs-toggle="modal"
                                                    data-bs-target="#createCorporateModal" data-id="{{ $corporate->id }}"><i
                                                        class="bi bi-pencil-square"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="contactPersonsTab" role="tabpanel" aria-labelledby="contactPersons-tab">
                        <div class="d-flex justify-content-end gap-2 mb-2">
                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#createContactPersonModal" id="createContactPersonToggle"><i
                                    class="bi bi-plus"></i>Add contact person</a>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Actions
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item text-danger" href="#" id="deleteContactPerson"><i
                                                class="bi bi-trash"></i>&nbsp;Delete</a></li>
                                    <li><a class="dropdown-item text-info" href="#" id="exportContactPerson"><i
                                                class="bi bi-file-earmark-excel"></i>&nbsp;Export</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="table-container">
                            <table class="table table-hover table-striped table-bordered table-sm scrollableTable">
                                <thead>
                                    <tr>
                                        <th scope="col"><input type="checkbox" name="corporate_user_id[]" value=""
                                                id="allCorporateUserSelect"></th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Company</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($corporatesusers as $user)
                                        <tr>

                                            <td><input type="checkbox" name="corporate_user_id[]" value="{{ $user->id }}"></td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->address }}</td>
                                            <td>{{ $user->corporate?->name }}</td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm" id="editContactPersonToggle" data-id="{{ $user->id }}"
                                                data-bs-toggle="modal" data-bs-target="#createContactPersonModal"><i class="bi bi-pencil"></i></a>
                                                {{-- <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="bi bi-trash"></i></button>
                                                </form> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <div class="pagination-box p-box-2">
                    {!! $corporates->links() !!}
                </div>

            </div>
    </main>
@endsection


<div class="modal fade" id="createCorporateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="createCorporateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createCorporateModalLabel">Create Corporate</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('corporates.store') }}" method="POST" id="corporateCreateForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="corporateID" value="">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" id="corporateCategory" class="form-control" required>
                            
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="corporateName" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="corporateEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" id="corporatePhone">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" id="corporateAddress">
                    </div>
                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo</label>
                        <input type="file" class="form-control" name="logo" id="corporateLogo">
                    </div>
                    <div class="mb-3">
                        <label for="size" class="form-label">Size</label>
                        <input type="text" class="form-control" name="size" id="corporateSize">
                    </div>
                    <div class="mb-3">
                        <label for="mission_vision" class="form-label">Mission & Vision</label>
                        <textarea name="mission_vision" id="corporateMissionVision" class="form-control"></textarea>
                    </div>
                </div>
                <div id="corporateFeedback"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="corporateCreateSubmit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="createContactPersonModal" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="createContactPersonModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createContactPersonModalLabel">Create Contact Person</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('corporate.user.store') }}" method="POST" id="contactPersonCreateForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="corporateContactPersonID" value="">
                    <div class="mb-2">
                        <label for="corporateOptionsID" class="form-label">Corporate</label>
                        <select name="corporate_id" id="corporateOptionsID" class="form-control">
                            
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label for="corpContactPersonFirstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" name="first_name" id="corpContactPersonFirstName" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="corpContactPersonMiddleName" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" name="middle_name" id="corpContactPersonMiddleName" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="corpContactPersonLastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="last_name" id="corpContactPersonLastName" required>
                        </div>
                        

                        <div class="col-md-6 mb-2">
                            <label for="corpContactPersonEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="corpContactPersonEmail" required>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="corpContactPersonPhone" class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" id="corpContactPersonPhone" required>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="corpContactPersonAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" id="corpContactPersonAddress">
                        </div>
                    </div>
                </div>
                <div id="corporateContactPersonFeedback"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="corporateContactPersonCreateSubmit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>





@section('footer_scripts')
    <script src="{{ asset('js/functions.js') }}"></script>
    <script src="{{ asset('js/corporate.js') }}"></script>
@endsection
