<div class="modal-header" style="background: #2E63A2; color: #fff;">
    <h5 class="modal-title" style="color: #fff;">Detail User</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="row mb-3">
        <div class="col-12 text-center">
            <div class="rounded-circle bg-light d-inline-block mb-2" style="width: 90px; height: 90px; overflow: hidden; border: 3px solid #3677C3;">
                <img src="{{ $user->details?->image_url ?? asset('backend/img/avatars/profile.png') }}" alt="Profile" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <h5 class="mt-2 mb-0">{{ $user->name }}</h5>
            <span class="badge {{ $user->details?->status == 1 ? 'bg-success' : 'bg-danger' }}">
                {{ $user->details?->status_info ?? '-' }}
            </span>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-6">
            <label class="fw-bold">Email</label>
            <div>{{ $user->email }}</div>
        </div>
        <div class="col-md-6">
            <label class="fw-bold">Role</label>
            <div>{{ $user->roles->role ?? '-' }}</div>
        </div>
        <div class="col-md-6">
            <label class="fw-bold">Nomor Identity</label>
            <div>{{ $user->details?->identity ?? '-' }}</div>
        </div>
        <div class="col-md-6">
            <label class="fw-bold">Identity Image</label>
            <div>
                @if($user->details?->identity_image)
                    <a href="{{ $user->details->image_identity_url }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat Gambar</a>
                @else
                    -
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <label class="fw-bold">Phone</label>
            <div>{{ $user->details?->phone ?? '-' }}</div>
        </div>
        <div class="col-md-6">
            <label class="fw-bold">Gender</label>
            <div>
                @if($user->details?->gender == 'L')
                    Laki-laki
                @elseif($user->details?->gender == 'P')
                    Perempuan
                @else
                    -
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <label class="fw-bold">Address</label>
            <div>{{ $user->details?->address ?? '-' }}</div>
        </div>
        <div class="col-md-4">
            <label class="fw-bold">Zip Code</label>
            <div>{{ $user->details?->zip_code ?? '-' }}</div>
        </div>
        <div class="col-md-4">
            <label class="fw-bold">State</label>
            <div>{{ $user->details?->state ?? '-' }}</div>
        </div>
        <div class="col-md-4">
            <label class="fw-bold">Status</label>
            <div>{{ $user->details?->status_info ?? '-' }}</div>
        </div>
    </div>
</div>
