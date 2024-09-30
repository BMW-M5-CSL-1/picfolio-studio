<?php

namespace App\Http\Controllers;

use App\DataTables\EventDataTable;
use App\Models\Event;
use App\Models\EventPhotographer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EventDataTable $table)
    {
        return $table->render('app.event.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'no_of_photographers' => 'required|integer|min:1',
            'arieal_view' => 'required|in:yes,no',
            'location' => 'required|string',
            'description' => 'nullable|string',
        ], [
            'type.required' => 'Please select the shoot for.',
            'title.required' => 'Please select a title for the event.',
            'start_date.required' => 'Please provide a start date for the event.',
            'start_date.after_or_equal' => 'The start date cannot be before today.',
            'end_date.required' => 'Please provide an end date for the event.',
            'end_date.after_or_equal' => 'The end date must be after or equal to the start date.',
            'no_of_photographers.required' => 'Please specify the number of photographers required.',
            'no_of_photographers.integer' => 'The number of photographers must be a valid integer.',
            'no_of_photographers.min' => 'At least one photographer is required.',
            'arieal_view.required' => 'Please specify whether a drone view is required.',
            'arieal_view.in' => 'The selected drone view option is invalid.',
            'location.required' => 'Please provide the event location.',
            'location.string' => 'The location must be a valid string.',
            'description.string' => 'The description must be a valid string.',
        ]);
        // dd($request->all());

        DB::beginTransaction();

        try {
            $max = Event::withTrashed()->count() + 1;

            // Generate the document number with leading zeros
            $doc_no = sprintf('EV-%04d', $max);

            // Ensure the doc_no is unique
            while (Event::where('doc_no', $doc_no)->exists()) {
                $max++;
                $doc_no = sprintf('EV-%04d', $max);
            }

            $event = new Event([
                'doc_no' => $doc_no,
                'type' => $request->type,
                'title' => $request->title,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'required_photographers' => $request->no_of_photographers,
                'arieal_view' => $request->arieal_view === 'yes' ? true : false,
                'location' => $request->location,
                'description' => $request->description,
                'status' => 'pending',
                'user_id' => Auth::id(),
            ]);

            $event->save();
            // Commit transaction if all goes well
            DB::commit();
            return redirect()->route('event.index')->with('success', 'Event created successfully!');
        } catch (Exception $e) {
            // Rollback the transaction if any error occurs
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create the event: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        if ($event) {
            $data = [
                'event' => $event,
            ];
            return view('app.event.edit', $data);
        } else {
            return redirect()->back()->withDanger('Event not found');
        }
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'type' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'no_of_photographers' => 'required|integer|min:1',
            'arieal_view' => 'required|in:yes,no',
            'location' => 'required|string',
            'description' => 'nullable|string',
        ], [
            'type.required' => 'Please select the type of event.',
            'title.required' => 'Please provide a title for the event.',
            'start_date.required' => 'Please provide a start date for the event.',
            'start_date.after_or_equal' => 'The start date cannot be before today.',
            'end_date.required' => 'Please provide an end date for the event.',
            'end_date.after_or_equal' => 'The end date must be after or equal to the start date.',
            'no_of_photographers.required' => 'Please specify the number of photographers required.',
            'no_of_photographers.integer' => 'The number of photographers must be a valid integer.',
            'no_of_photographers.min' => 'At least one photographer is required.',
            'arieal_view.required' => 'Please specify whether a drone view is required.',
            'arieal_view.in' => 'The selected drone view option is invalid.',
            'location.required' => 'Please provide the event location.',
            'location.string' => 'The location must be a valid string.',
            'description.string' => 'The description must be a valid string.',
        ]);

        // Start a DB transaction
        DB::beginTransaction();

        try {
            // Find the event to update
            $event = Event::findOrFail($id);

            // Update the event data
            $event->update([
                'type' => $request->type,
                'title' => $request->title,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'required_photographers' => $request->no_of_photographers,

                // Set arieal_view to true if 'yes', otherwise false
                'arieal_view' => $request->arieal_view === 'yes' ? true : false,

                'location' => $request->location,
                'description' => $request->description,
                'status' => $event->status, // Maintain existing status
            ]);

            // Commit transaction
            DB::commit();

            // Redirect with success message
            return redirect()->route('event.index')->with('success', 'Event updated successfully!');
        } catch (Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();

            // Redirect with error message
            return redirect()->back()->with('error', 'Failed to update the event: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }

    public function publish($id)
    {
        return DB::transaction(function () use ($id) {
            $event = Event::findOrFail($id);
            if ($event) {
                if ($event->status == 'pending') {
                    $event->update([
                        'status' => 'published',
                        'published_at' => now(),
                    ]);
                    return response()->json([
                        'success' => true,
                        'message' => 'Event Published !'
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Cannot Raise Offer !'
                    ]);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Not FOund !',
                ], 500);
            }
        });
    }

    public function raiseOffer($id, Request $request)
    {
        return DB::transaction(function () use ($id, $request) {
            $event = Event::findOrFail($id);
            if ($event) {
                if ($event->status == 'published') {
                    EventPhotographer::create([
                        'event_id' => $id,
                        'photographer_id' => Auth::id(),
                        'offer' => $request->offer ?? '',
                        'status' => 'pending',
                    ]);

                    return response()->json([
                        'success' => true,
                        'message' => 'Offer Raised Successfully !',
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Cannot Raise Offer !'
                    ]);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Not FOund !',
                ], 500);
            }
        });
    }

    public function details($id, Request $request)
    {
        $event = Event::findOrFail($id);
        if ($event) {
            if ($request->has('query_for')) {
                $query_for = $request->query_for;
                switch ($query_for) {
                    case 'offer_list':
                        $data = [
                            'event' => $event,
                            'offers' => $event->eventPhotographers ?? [],
                            'query_for' => $query_for,
                        ];
                        $view = view('app.event.details', $data)->render();
                        return response()->json([
                            'success' => true,
                            'view' => $view,
                        ]);
                        break;

                    default:
                        return response()->json([
                            'success' => false,
                            'message' => 'Something Went Wrong !'
                        ]);
                        break;
                }
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Not FOund !',
            ], 500);
        }
    }
}
