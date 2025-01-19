<x-app title="Organizer | Create Event">
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="container">
        <h1>Tambah Event Baru</h1>
        <form action="{{ route('organizer.events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="title">Judul Event</label>
                        <input type="text" class="form-control" name="title" placeholder="Masukkan judul event"
                            required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="tagline">Tagline</label>
                        <input type="text" class="form-control" name="tagline" placeholder="Masukkan tagline">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="date">Tanggal dan Waktu (format 24 jam)</label>
                        <input type="datetime-local" class="form-control" name="date" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="category">Kategori</label>
                        <select class="form-control" name="categories_id">
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="about">Tentang Event</label>
                        <textarea class="form-control" name="about" placeholder="Deskripsi event" required></textarea>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="venue_name">Tempat Acara</label>
                        <input type="text" class="form-control" name="venue_name" placeholder="Masukkan tempat acara"
                            required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="keypoint">Key Points</label>
                        <div id="keypoint-container">
                            <input type="text" class="form-control mb-2" name="keypoint[]"
                                placeholder="Masukkan keypoint">
                        </div>
                        <button type="button" class="btn btn-secondary" id="add-keypoint">Tambah Keypoint</button>
                    </div>
                </div>
            </div>

            <br>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="speaker">Speaker</label>
                        <select class="form-control" name="talent_id">
                            <option value="">Pilih Speaker</option>
                            @foreach ($talents as $talent)
                                <option value="{{ $talent->id }}">{{ $talent->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="cover">Cover Event</label>
                        <input type="file" class="form-control" name="cover">
                    </div>
                </div>
            </div>

            <br>
            <div id="ticket-categories">
                <div class="ticket-category" data-index="0">
                    <h5>Kategori Tiket 1</h5>
                    <div class="form-group">
                        <label for="ticket_categories[0][type]">Type Tiket</label>
                        <select class="form-control" name="ticket_categories[0][type]">
                            <option value="">Pilih Type</option>
                            <option value="regular">Regular</option>
                            <option value="vip">VIP</option>
                            <option value="vvip">VVIP</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ticket_categories[0][price]">Harga</label>
                        <input type="number" class="form-control" name="ticket_categories[0][price]"
                            placeholder="Harga tiket" required>
                    </div>
                    <div class="form-group">
                        <label for="ticket_categories[0][sum_ticket]">Jumlah Tiket</label>
                        <input type="number" class="form-control" name="ticket_categories[0][sum_ticket]"
                            placeholder="Jumlah tiket" required>
                    </div>
                    <div class="form-group">
                        <label for="ticket_categories[0][status]">Status</label>
                        <select class="form-control" name="ticket_categories[0][status]">
                            <option value="available">Available</option>
                            <option value="sold out">Sold Out</option>
                        </select>
                    </div>
                    <hr>
                </div>
                <button type="button" class="btn btn-secondary mb-3" id="add-ticket-category">Tambah Tiket</button>
            </div>


            <button type="submit" class="btn btn-primary">Simpan Event</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let ticketIndex = 1;

            document.getElementById('add-keypoint').addEventListener('click', function() {
                const container = document.getElementById('keypoint-container');
                const newKeypoint = document.createElement('div');
                newKeypoint.classList.add('input-group', 'mb-2');

                newKeypoint.innerHTML = `
                    <input type="text" class="form-control" name="keypoint[]" placeholder="Masukkan keypoint">
                    <div class="input-group-append">
                        <button class="btn btn-danger" type="button" onclick="removeKeypoint(this)">X</button>
                    </div>
                `;

                container.appendChild(newKeypoint);
            });

            document.getElementById('add-ticket-category').addEventListener('click', function() {
                const container = document.getElementById('ticket-categories');
                const newCategory = document.createElement('div');
                newCategory.classList.add('ticket-category');
                newCategory.dataset.index = ticketIndex;

                newCategory.innerHTML = `
                    <h5>Kategori Tiket ${ticketIndex + 1}</h5>
                    <div class="form-group">
                        <label for="ticket_categories[${ticketIndex}][type]">Type Tiket</label>
                        <select class="form-control" name="ticket_categories[${ticketIndex}][type]">
                            <option value="">Pilih Type</option>
                            <option value="regular">Regular</option>
                            <option value="vip">VIP</option>
                            <option value="vvip">VVIP</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ticket_categories[${ticketIndex}][price]">Harga</label>
                        <input type="number" class="form-control" name="ticket_categories[${ticketIndex}][price]" placeholder="Harga tiket" required>
                    </div>
                    <div class="form-group">
                        <label for="ticket_categories[${ticketIndex}][stock]">Stok</label>
                        <input type="number" class="form-control" name="ticket_categories[${ticketIndex}][stock]" placeholder="Jumlah stok tiket" required>
                    </div>
                    <div class="form-group">
                        <label for="ticket_categories[${ticketIndex}][sum_ticket]">Jumlah Tiket</label>
                        <input type="number" class="form-control" name="ticket_categories[${ticketIndex}][sum_ticket]" placeholder="Jumlah tiket" required>
                    </div>
                    <div class="form-group">
                        <label for="ticket_categories[${ticketIndex}][status]">Status</label>
                        <select class="form-control" name="ticket_categories[${ticketIndex}][status]">
                            <option value="available">Available</option>
                            <option value="sold out">Sold Out</option>
                        </select>
                    </div>
                    <hr>
                `;

                container.appendChild(newCategory);
                ticketIndex++;
            });
        });

        function removeKeypoint(element) {
            element.closest('.input-group').remove();
        }
    </script>
</x-app>
