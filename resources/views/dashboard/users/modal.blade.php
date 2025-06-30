<div class="modal-header" style="background: #2E63A2; color: #fff;">
    <h5 class="modal-title" id="modalCenterTitle" style="color: #fff;">{{$title}}</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form method="POST" enctype="multipart/form-data" action="@if(!$user) {{ route('dashboard.users.store') }} @else {{ route('dashboard.users.update', $user->user_id) }} @endif" >
@csrf
@if($user)
    @method('PUT')
@endif
<div class="modal-body" >
    @if (!$user)
    <div class="row" >
        <div class="col mb-3">
            <label for="nameWithTitle" class="form-label">Name</label>
            <input type="text" id="nameWithTitle" name="name" class="form-control @error('name') is-invalid @enderror" required value="{{ old('name') }}" placeholder="Enter Name" />
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="row g-2">
        <div class="col mb-0">
            <label for="emailWithTitle" class="form-label">Email</label>
            <input type="email" id="emailWithTitle" name="email" class="form-control @error('email') is-invalid @enderror" required value="{{ old('email') }}" placeholder="xxxx@xxx.xx" />
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col mb-0">
            <label for="dobWithTitle" class="form-label">Roles</label>
            <select class="form-select" id="selectRole" name="role_id" required aria-label="Default select example">
                <option selected disabled>Select</option>
                @if(Auth::user()->role_id == 1)
                    <option value="2" @selected(old('role_id') == 2)>Petugas</option>
                    <option value="3" @selected(old('role_id') == 3)>Warga</option>
                @else
                    <option value="3" @selected(old('role_id') == 3)>Warga</option>
                @endif
            </select>
            @error('role_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="row g-2">
        <div class="col mb-0">
            <label for="identity" class="form-label">Nomor Identity</label>
            <input type="text" id="identity" name="identity" class="form-control @error('identity') is-invalid @enderror" value="{{ old('identity') }}" placeholder="Nomor Identity" />
            @error('identity')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col mb-0">
            <label for="identity_image" class="form-label">Identity Image</label>
            <input type="file" id="identity_image" name="identity_image" class="form-control @error('identity_image') is-invalid @enderror" accept="image/*" />
            @error('identity_image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="row g-2">
        <div class="col mb-0">
            <label for="address" class="form-label">Address</label>
            <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" placeholder="Address" />
            @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col mb-0">
            <label for="zip_code" class="form-label">Zip Code</label>
            <input type="text" id="zip_code" name="zip_code" class="form-control @error('zip_code') is-invalid @enderror" value="{{ old('zip_code') }}" placeholder="Zip Code" />
            @error('zip_code')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="row g-2">
        <div class="col mb-0">
            <label for="state" class="form-label">State</label>
            <input type="text" id="state" name="state" class="form-control @error('state') is-invalid @enderror" value="{{ old('state') }}" placeholder="State" />
            @error('state')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col mb-0">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="Phone" />
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="row g-2">
        <div class="col mb-0">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-select" id="gender" name="gender">
                <option value="male" @selected(old('gender') == 'male')>Laki-laki</option>
                <option value="female" @selected(old('gender') == 'female')>Perempuan</option>
            </select>
            @error('gender')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col mb-0">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status">
                <option value="1" @selected(old('status') == 1)>Verified</option>
                <option value="0" @selected(old('status') == 0)>Not Verified</option>
            </select>
            @error('status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    @else
    <div class="row">
        <div class="col mb-3">
            <label for="nameWithTitle" class="form-label">Name</label>
            <input type="text" id="nameWithTitle" name="name" class="form-control @error('name') is-invalid @enderror" required value="{{ $user->name ?? old('name') }}" placeholder="Enter Name" />
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="row g-2">
        <div class="col mb-0">
            <label for="emailWithTitle" class="form-label">Email</label>
            <input type="email" id="emailWithTitle" name="email" class="form-control @error('email') is-invalid @enderror" required value="{{ $user->email ?? old('email') }}" placeholder="xxxx@xxx.xx" />
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col mb-0">
            <label for="dobWithTitle" class="form-label">Roles</label>
            <select class="form-select" id="selectRole" name="role_id" required aria-label="Default select example">
                <option disabled>Select</option>
                @if(Auth::user()->role_id == 1)
                    <option value="2" @selected($user->role_id == 2)>Petugas</option>
                    <option value="3" @selected($user->role_id == 3)>Warga</option>
                @else
                    <option value="3" @selected($user->role_id == 3)>Warga</option>
                @endif
            </select>
            @error('role_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="row g-2">
        <div class="col mb-0">
            <label for="identity" class="form-label">Nomor Identity</label>
            <input type="text" id="identity" name="identity" class="form-control @error('identity') is-invalid @enderror" value="{{ $user->details?->identity ?? old('identity') }}" placeholder="Nomor Identity" />
            @error('identity')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col mb-0">
            <label for="identity_image" class="form-label">Identity Image</label>
            <input type="file" id="identity_image" name="identity_image" class="form-control @error('identity_image') is-invalid @enderror" accept="image/*" />
            @if($user->details?->identity_image)
                <img src="{{ $user->details->imageIdentityUrl }}" alt="Identity Image" class="img-thumbnail mt-2" width="100">
            @endif
            @error('identity_image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="row g-2">
        <div class="col mb-0">
            <label for="address" class="form-label">Address</label>
            <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ $user->details?->address ?? old('address') }}" placeholder="Address" />
            @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col mb-0">
            <label for="zip_code" class="form-label">Zip Code</label>
            <input type="text" id="zip_code" name="zip_code" class="form-control @error('zip_code') is-invalid @enderror" value="{{ $user->details?->zip_code ?? old('zip_code') }}" placeholder="Zip Code" />
            @error('zip_code')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="row g-2">
        <div class="col mb-0">
            <label for="state" class="form-label">State</label>
            <input type="text" id="state" name="state" class="form-control @error('state') is-invalid @enderror" value="{{ $user->details?->state ?? old('state') }}" placeholder="State" />
            @error('state')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col mb-0">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ $user->details?->phone ?? old('phone') }}" placeholder="Phone" />
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="row g-2">
        @php
            $genderValue = old('gender');
            if (!$genderValue && isset($user) && isset($user->details->gender)) {
                if ($user->details->gender === 'P') {
                    $genderValue = 'female';
                } elseif ($user->details->gender === 'L') {
                    $genderValue = 'male';
                } else {
                    $genderValue = $user->details->gender;
                }
            }
        @endphp
        <div class="col mb-0">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-select" id="gender" name="gender">
                <option value="male" @selected($genderValue == 'male')>Laki-laki</option>
                <option value="female" @selected($genderValue == 'female')>Perempuan</option>
            </select>
            @error('gender')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            @if($user && !$user->details?->gender)
                <span class="text-danger small">Belum diisi</span>
            @endif
        </div>
        <div class="col mb-0">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status">
                <option value="1" @selected(($user->details?->status ?? old('status')) == 1)>Verified</option>
                <option value="0" @selected(($user->details?->status ?? old('status')) == 0)>Not Verified</option>
            </select>
            @error('status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    @endif
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
        Close
    </button>
    <button type="submit" class="btn btn-primary">
    @if(!$user)
        Save
    @else
        Save Changes
    @endif
    </button>
</div>
</form>

<style>
    .row.g-2, .row {
        margin-bottom: 1.3rem;
    }
    .form-label {
        margin-bottom: 0.5rem;
    }
    .form-control, .form-select {
        margin-bottom: 0.2rem;
    }
    .modal-body > .row:last-child {
        margin-bottom: 0.7rem;
    }
</style>
