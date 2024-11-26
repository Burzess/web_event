<form action="{{ route('talents.store') }}" method="POST">
    @csrf
    <div>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required>
    </div>

    <div>
        <label for="organizer">Organizer</label>
        <select name="organizer" id="organizer">
            @foreach ($organizers as $organizer)
                <option value="{{ $organizer->id }}">{{ $organizer->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="image">Image</label>
        <select name="image" id="image">
            @foreach ($images as $image)
                <option value="{{ $image->id }}">{{ $image->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="role">Role</label>
        <select name="role" id="role">
            @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit">Create Talent</button>
</form>
