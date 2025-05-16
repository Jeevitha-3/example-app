<!DOCTYPE html>
<html>
<head>
    <title>Registers Tables</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Registers Tables</h2>

    <form method="GET" action="{{ route('registers.index') }}" class="row g-3 mb-4">
        <div class="col-auto">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search...">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
    <div class="mb-3">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">Add Register</button>
    </div>


    <table class="table table-bordered">    
        <thead class="table-dark">
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Address</th><th>City</th>
                <th>State</th><th>Country</th><th>Zipcode</th><th>Role</th><th>Gender</th>
                <th>DOB</th><th>Created</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($registers as $register)
            <tr>
                <td>{{ $register->id }}</td>
                <td>{{ $register->name }}</td>
                <td>{{ $register->email }}</td>
                <td>{{ $register->phonenumber }}</td>
                <td>{{ $register->address }}</td>
                <td>{{ $register->city }}</td>
                <td>{{ $register->state }}</td>
                <td>{{ $register->country }}</td>
                <td>{{ $register->zipcode }}</td>
                <td>{{ $register->role }}</td>
                <td>{{ $register->gender }}</td>
                <td>{{ $register->dob }}</td>
                <td>{{ $register->created_at }}</td>
                <td>
                    <button class="btn btn-sm btn-warning editBtn"
                        data-id="{{ $register->id }}"
                        data-name="{{ $register->name }}"
                        data-email="{{ $register->email }}"
                        data-phonenumber="{{ $register->phonenumber }}"
                        data-address="{{ $register->address }}"
                        data-city="{{ $register->city }}"
                        data-state="{{ $register->state }}"
                        data-country="{{ $register->country }}"
                        data-zipcode="{{ $register->zipcode }}"
                        data-role="{{ $register->role }}"
                        data-gender="{{ $register->gender }}"
                        data-dob="{{ $register->dob }}"
                        data-bs-toggle="modal" data-bs-target="#editModal">
                        Edit
                    </button>
                    <button class="btn btn-sm btn-danger deleteBtn" data-id="{{ $register->id }}">Delete</button>
                </td>   
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $registers->appends(request()->input())->links() }}
    </div>
</div>

<!-- Hidden iframe to prevent redirect -->
<iframe name="hiddenFrame" style="display:none;"></iframe>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form method="POST" target="hiddenFrame" id="editForm">
        @csrf
        @method('PUT')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Register</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row g-3">
                <input type="hidden" id="edit_id" name="id">
                <div class="col-md-6">
                    <label>Name</label>
                    <input type="text" name="name" id="edit_name" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Email</label>
                    <input type="email" name="email" id="edit_email" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Phone</label>
                    <input type="text" name="phonenumber" id="edit_phonenumber" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Address</label>
                    <input type="text" name="address" id="edit_address" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>City</label>
                    <input type="text" name="city" id="edit_city" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>State</label>
                    <input type="text" name="state" id="edit_state" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Country</label>
                    <input type="text" name="country" id="edit_country" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Zipcode</label>
                    <input type="text" name="zipcode" id="edit_zipcode" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Role</label>
                    <input type="text" name="role" id="edit_role" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Date of Birth</label>
                    <input type="date" name="dob" id="edit_dob" class="form-control">
                </div>
                <div class="col-md-12">
                    <label>Gender</label><br>
                    <input type="radio" name="gender" value="male" id="gender_male"> Male
                    <input type="radio" name="gender" value="female" id="gender_female"> Female
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </form>
  </div>
</div>


<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form method="POST" target="hiddenFrame" action="{{ route('register.store') }}">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Register</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row g-3">
                <div class="col-md-6">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Phone</label>
                    <input type="text" name="phonenumber" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label>City</label>
                    <input type="text" name="city" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label>State</label>
                    <input type="text" name="state" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label>Country</label>
                    <input type="text" name="country" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label>Zipcode</label>
                    <input type="text" name="zipcode" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label>Role</label>
                    <input type="number" name="role" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label>Date of Birth</label>
                    <input type="date" name="dob" class="form-control" required>
                </div>
                <div class="col-md-12">
                    <label>Gender</label><br>
                    <input type="radio" name="gender" value="male" required> Male
                    <input type="radio" name="gender" value="female" required> Female
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Add</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </form>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.querySelectorAll('.editBtn').forEach(button => {
    button.addEventListener('click', function () {
        const form = document.getElementById('editForm');
        const id = this.dataset.id;

        form.action = `/registers/${id}`; 

        document.getElementById('edit_id').value = id;
        document.getElementById('edit_name').value = this.dataset.name;
        document.getElementById('edit_email').value = this.dataset.email;
        document.getElementById('edit_phonenumber').value = this.dataset.phonenumber;
        document.getElementById('edit_address').value = this.dataset.address;
        document.getElementById('edit_city').value = this.dataset.city;
        document.getElementById('edit_state').value = this.dataset.state;
        document.getElementById('edit_country').value = this.dataset.country;
        document.getElementById('edit_zipcode').value = this.dataset.zipcode;
        document.getElementById('edit_role').value = this.dataset.role;
        document.getElementById('edit_dob').value = this.dataset.dob;

        if (this.dataset.gender === "male") {
            document.getElementById('gender_male').checked = true;
        } else {
            document.getElementById('gender_female').checked = true;
        }
    });
});
</script>
<script>
document.querySelectorAll('.deleteBtn').forEach(button => {
    button.addEventListener('click', function () {
        const id = this.dataset.id;

        if (confirm("Are you sure you want to delete this record?")) {
            fetch(`/registers/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ id: id })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const row = this.closest('tr');
                    row.remove();
                    alert("Record deleted successfully.");
                } else {
                    alert("Error deleting record. Please try again."); 
                }
            })
            .catch(error => {
                alert("An error occurred. Please try again."); 
            });
        }
    });
});
</script>

</body>
</html>