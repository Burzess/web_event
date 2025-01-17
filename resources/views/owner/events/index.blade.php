<x-app title="List Event">
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nama Event</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
            <tr>
                <td>{{ $event->id }}</td>
                <td>{{ $event->title }}</td>
                <td>{{ $event->status }}</td>
                <td>
                    <button class="btn btn-success" onclick="confirmApproval({{ $event->id }})">Setujui</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <script>
    function confirmApproval(eventId) {
        if (confirm('Apakah Anda yakin ingin menyetujui event ini?')) {
            window.location.href = '/owner/events/approve/' + eventId;
        }
    }
    </script>
</x-app>
