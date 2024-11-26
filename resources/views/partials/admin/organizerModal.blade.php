<!-- Modal Create Organizer -->
<div class="modal fade" id="createOrganizerModal" tabindex="-1" aria-labelledby="createOrganizerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createOrganizerModalLabel">Create New Organizer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('organizers.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="organizerName" class="form-label">Organizer Name</label>
                        <input type="text" class="form-control" id="organizerName" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Organizer -->
<div class="modal fade" id="editOrganizerModal" tabindex="-1" aria-labelledby="editOrganizerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editOrganizerModalLabel">Edit Organizer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="error-message" style="color: red; display: none;">Nama peran tidak boleh mengandung angka.</div>

            <form id="editOrganizerForm" action="{{ route('organizers.update', ':id') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editOrganizerName" class="form-label">Organizer Name</label>
                        <input type="text" class="form-control" id="editOrganizerName" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
