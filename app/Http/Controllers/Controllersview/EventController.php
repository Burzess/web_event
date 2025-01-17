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
                \Log::info($ticketData['type']);
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
}




// namespace App\Http\Controllers\Controllersview;

// use App\Http\Controllers\Controller;
// use App\Models\Event;
// use App\Models\Category;
// use App\Models\Image;
// use App\Models\Talent;
// use App\Models\Organizer;
// use Illuminate\Http\Request;

// class EventController extends Controller
// {
//     public function index(Request $request)
//     {
//         try {
//             $events = Event::with(['category', 'image', 'talent', 'organizer', 'ticketCategories'])->get();
//             return view('events.index', ['events' => $events]);
//         } catch (\Exception $e) {
//             return view('error', ['message' => 'Gagal mengambil acara.']);
//         }
//     }

//     public function create()
//     {
//         try {
//             $categories = Category::all();
//             $organizers = Organizer::all();
//             $talents = Talent::all();
//             return view('events.create', compact('categories', 'organizers', 'talents'));
//         } catch (\Exception $e) {
//             return view('error', ['message' => 'Gagal memuat form pembuatan acara.']);
//         }
//     }
//     public function show($id)
//     {
//         try {
//             $event = Event::with(['category', 'image', 'talent', 'organizer', 'ticketCategories'])->findOrFail($id);
//             return view('events.show', ['event' => $event]);
//         } catch (\Exception $e) {
//             return view('error', ['message' => 'Gagal mengambil detail acara.']);
//         }
//     }

//     public function store(Request $request)
//     {
//         try {
//             $validated = $request->validate([
//                 'title' => 'required|string|max:255|unique:events,title',
//                 'date' => 'required|date',
//                 'about' => 'required|string',
//                 'venue_name' => 'required|string|max:255',
//                 'status' => 'required|in:active,inactive',
//                 'category_id' => 'required|exists:categories,id',
//                 'organizer_id' => 'required|exists:organizers,id',
//                 'talent_id' => 'nullable|exists:talents,id',
//                 'ticket_categories' => 'required|array',
//                 'ticket_categories.*.price' => 'required|integer|min:0',
//                 'ticket_categories.*.stock' => 'required|integer|min:0',
//                 'ticket_categories.*.sum_ticket' => 'required|integer|min:0',
//                 'ticket_categories.*.status' => 'required|in:available,sold out',
//             ]);

//             $event = Event::create($validated);

//             foreach ($validated['ticket_categories'] as $ticketData) {
//                 $ticketData['event_id'] = $event->id;
//                 \App\Models\TicketCategory::create($ticketData);
//             }

//             return redirect()->route('events.index')->with('success', 'Acara berhasil dibuat.');
//         } catch (\Exception $e) {
//             return view('error', ['message' => 'Gagal membuat acara. ' . $e->getMessage()]);
//         }
//     }

//     public function edit($id)
//     {
//         try {
//             $event = Event::with(['ticketCategories'])->findOrFail($id);
//             $categories = Category::all();
//             $organizers = Organizer::all();
//             $talents = Talent::all();
//             return view('events.edit', compact('event', 'categories', 'organizers', 'talents'));
//         } catch (\Exception $e) {
//             return view('error', ['message' => 'Gagal memuat form pengeditan acara.']);
//         }
//     }
//     public function update(Request $request, Event $event)
//     {
//         try {
//             $validated = $request->validate([
//                 'title' => 'required|string|max:255|unique:events,title,' . $event->id,
//                 'date' => 'required|date',
//                 'about' => 'required|string',
//                 'venue_name' => 'required|string|max:255',
//                 'status' => 'required|in:active,inactive',
//             ]);

//             $event->update($validated);

//             return redirect()->route('events.index')->with('success', 'Acara berhasil diperbarui.');
//         } catch (\Exception $e) {
//             return view('error', ['message' => 'Gagal memperbarui acara. ' . $e->getMessage()]);
//         }
//     }

//     public function destroy($id)
//     {
//         try {
//             $event = Event::findOrFail($id);
//             $event->delete();

//             return redirect()->route('events.index')->with('success', 'Acara berhasil dihapus.');
//         } catch (\Exception $e) {
//             return view('error', ['message' => 'Gagal menghapus acara. ' . $e->getMessage()]);
//         }
//     }
// }
