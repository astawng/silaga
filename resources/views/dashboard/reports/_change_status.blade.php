@php
    $statuses = ['pending', 'review', 'progress', 'done'];
@endphp
<form action="{{ route('dashboard.reports.changeStatus', $report->report_id) }}" method="POST" id="formChangeStatus">
    @csrf
    @method('PATCH')
    <div class="modal-header">
        <h5 class="modal-title">Change Report Status</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control" required>
                @foreach($statuses as $status)
                    <option value="{{ $status }}" @if($report->status == $status) selected @endif>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
<script>
    $('#formChangeStatus').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            type: 'POST', // gunakan type POST agar _method PATCH terbaca oleh Laravel
            data: form.serialize(),
            success: function(response) {
                location.reload();
            },
            error: function(xhr) {
                alert('Failed to update status');
            }
        });
    });
</script>
