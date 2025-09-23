<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct(
        private EventService $eventService
    ) {
    }

    /**
     * Display a listing of events
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $filters = $request->only([
                'search', 'type', 'location_id', 'date_from', 'date_to',
                'upcoming', 'today', 'user_events', 'exclude', 'limit',
            ]);

            $events = $this->eventService->getAll($filters, $request->get('per_page', 15));

            return response()->json([
                'success' => true,
                'data' => $events,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'فشل في جلب الفعاليات',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created event
     */
    public function store(StoreEventRequest $request): JsonResponse
    {
        try {
            $event = $this->eventService->create($request->validated());

            return response()->json([
                'success' => true,
                'data' => $event,
                'message' => 'تم إنشاء الفعالية بنجاح',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'فشل في إنشاء الفعالية',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified event
     */
    public function show(Event $event): JsonResponse
    {
        try {
            $event = $this->eventService->getById($event->id);

            return response()->json([
                'success' => true,
                'data' => $event,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'فشل في جلب تفاصيل الفعالية',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified event
     */
    public function update(UpdateEventRequest $request, Event $event): JsonResponse
    {
        try {
            $event = $this->eventService->update($event->id, $request->validated());

            return response()->json([
                'success' => true,
                'data' => $event,
                'message' => 'تم تحديث الفعالية بنجاح',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'فشل في تحديث الفعالية',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified event
     */
    public function destroy(Event $event): JsonResponse
    {
        try {
            $this->eventService->delete($event->id);

            return response()->json([
                'success' => true,
                'message' => 'تم حذف الفعالية بنجاح',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'فشل في حذف الفعالية',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
