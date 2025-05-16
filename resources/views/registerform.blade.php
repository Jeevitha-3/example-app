<!DOCTYPE html>
<html>
<head>
    <title>Register Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Register Form</h2>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Phone Number</label>
            <input type="text" name="phonenumber" class="form-control" value="{{ old('phonenumber') }}">
            @error('phonenumber') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Address</label>
            <textarea name="address" class="form-control">{{ old('address') }}</textarea>
            @error('address') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>City</label>
            <select name="city" class="form-control">
                <option value="">-- Select City --</option>
                <option value="Mumbai" {{ old('city') == 'Mumbai' ? 'selected' : '' }}>Mumbai</option>
                <option value="San Francisco" {{ old('city') == 'San Francisco' ? 'selected' : '' }}>San Francisco</option>
                <option value="London" {{ old('city') == 'London' ? 'selected' : '' }}>London</option>
            </select>
            @error('city') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>State</label>
            <select name="state" class="form-control">
                <option value="">-- Select State --</option>
                <option value="Maharashtra" {{ old('state') == 'Maharashtra' ? 'selected' : '' }}>Maharashtra</option>
                <option value="California" {{ old('state') == 'California' ? 'selected' : '' }}>California</option>
                <option value="Texas" {{ old('state') == 'Texas' ? 'selected' : '' }}>Texas</option>
            </select>
            @error('state') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Country</label>
            <select name="country" class="form-control">
                <option value="">-- Select Country --</option>
                <option value="India" {{ old('country') == 'India' ? 'selected' : '' }}>India</option>
                <option value="USA" {{ old('country') == 'USA' ? 'selected' : '' }}>USA</option>
                <option value="UK" {{ old('country') == 'UK' ? 'selected' : '' }}>UK</option>
            </select>
            @error('country') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Zip Code</label>
            <input type="text" name="zipcode" class="form-control" value="{{ old('zipcode') }}">
            @error('zipcode') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Role</label>
            <input type="number" name="role" class="form-control" value="{{ old('role') }}">
            @error('role') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Gender</label><br>
            <label><input type="radio" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}> Male</label>
            <label><input type="radio" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}> Female</label>
            <br>
            @error('gender') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Date of Birth</label>
            <input type="date" name="dob" class="form-control" value="{{ old('dob') }}">
            @error('dob') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
