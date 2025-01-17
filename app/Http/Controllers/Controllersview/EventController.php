<?php
namespace App\Http\Controllers\Controllersview;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use App\Models\Talent;
use App\Models\TicketCategory;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('ticketCategories', 'categories', 'image', 'talent')->get();
        \Log::info($events);
        return view('organizer.events.index', compact('events'));
    }

    public function create()
    {
        $categories = Category::where('user_id', auth()->id())->get();
        $talents = Talent::where('user_id', auth()->id())->get();
        return view('organizer.events.create', compact('categories', 'talents'));
    }

    public function store(Request $request)
    {
        \Log::info($request);
        try {
            // Validasi untuk event
            $eventValidated = $request->validate([
                'title' => 'required|string|max:255|unique:events,title',
                'date' => 'required|date',
                'about' => 'required|string',
                'tagline' => 'nullable|string|max:255',
                'keypoint' => 'nullable|array',
                'venue_name' => 'required|string|max:255',
                'categories_id' => 'nullable|exists:categories,id',
                'image_id' => 'nullable|exists:images,id',
                'talent_id' => 'nullable|exists:talents,id',
                'key_points' => 'nullable|array',
            ], [
                'title.required' => 'Judul acara harus diisi.',
                'title.unique' => 'Judul acara sudah digunakan.',
                'date.required' => 'Tanggal acara harus diisi.',
                'about.required' => 'Deskripsi acara harus diisi.',
                'venue_name.required' => 'Nama venue harus diisi.',
            ]);

            $eventValidated['key_points'] = json_encode($request->key_points);
            $eventValidated['status'] = 'inactive';
            $event = Event::create($eventValidated);

            $ticketCategoriesValidated = $request->validate([
                'ticket_categories' => 'required|array',
                'ticket_categories.*.price' => 'required|integer|min:0',
                'ticket_categories.*.sum_ticket' => 'required|integer|min:0',
                'ticket_categories.*.status' => 'required|in:available,sold out',
            ], [
                'ticket_categories.required' => 'Kategori tiket harus diisi.',
                'ticket_categories.*.price.required' => 'Harga tiket harus diisi.',
                'ticket_categories.*.sum_ticket.required' => 'Jumlah tiket harus diisi.',
                'ticket_categories.*.status.required' => 'Status tiket harus dipilih.',
            ]);

            foreach ($ticketCategoriesValidated['ticket_categories'] as $ticketData) {
                // \Log::info($ticketData['type']);
                $ticketData['event_id'] = $event->id;
                $ticketData['stock'] = $ticketData['sum_ticket'];
                $ticketData['type'] = $ticketData['type'] ?? 'regular';
                $event->ticketCategories()->create($ticketData);
            }

            return redirect()->route('organizer.events.index');
        } catch (\Exception $e) {
            \Log::error('Error creating event: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal membuat acara.' . $e->getMessage())->withInput();
        }
    }

    public function edit(Event $event)
    {
        $event->load('ticketCategories');
        return view('organizer.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $event->update($request->all());

        $event->ticketCategories()->delete();
        foreach ($request->ticket_categories as $ticket) {
            $event->ticketCategories()->create($ticket);
        }

        return redirect()->route('organizer.events.index');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('organizer.events.index');
    }

    public function approveEvent($id)
    {
        try {
            $event = Event::findOrFail($id);
            $event->update(['status' => 'active']);

            return redirect()->route('organizer.events.index')->with('success', 'Acara berhasil disetujui.');
        } catch (\Exception $e) {
            \Log::error('Error approving event: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menyetujui acara. ' . $e->getMessage());
        }
    }
}
