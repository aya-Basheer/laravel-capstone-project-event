<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Pagination\LengthAwarePaginator;

class EventService
{
    /**
     * Get all events with filters
     */
    public function getAll(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = Event::with(['location', 'speakers', 'organizer'])
            ->withCount('registrations');

        // Apply filters
        if (! empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('title', 'like', '%'.$filters['search'].'%')
                    ->orWhere('description', 'like', '%'.$filters['search'].'%');
            });
        }

        if (! empty($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        if (! empty($filters['location_id'])) {
            $query->where('location_id', $filters['location_id']);
        }

        if (! empty($filters['date_from'])) {
            $query->whereDate('starts_at', '>=', $filters['date_from']);
        }

        if (! empty($filters['date_to'])) {
            $query->whereDate('starts_at', '<=', $filters['date_to']);
        }

        if (! empty($filters['upcoming'])) {
            $query->where('starts_at', '>', now());
        }

        if (! empty($filters['today'])) {
            $query->whereDate('starts_at', today());
        }

        if (! empty($filters['user_events']) && auth()->check()) {
            $query->where('organizer_id', auth()->id());
        }

        if (! empty($filters['exclude'])) {
            $query->where('id', '!=', $filters['exclude']);
        }

        // Add registration status for authenticated users
        if (auth()->check() && auth()->user()->isAudience()) {
            $query->addSelect([
                'is_registered' => function ($q) {
                    $q->selectRaw('COUNT(*) > 0')
                        ->from('registrations')
                        ->whereColumn('event_id', 'events.id')
                        ->where('user_id', auth()->id());
                },
            ]);
        }

        $query->orderBy('starts_at', 'asc');

        if (! empty($filters['limit'])) {
            return $query->limit($filters['limit'])->get();
        }

        return $query->paginate($perPage);
    }

    /**
     * Get event by ID
     */
    public function getById(int $id): Event
    {
        $query = Event::with(['location', 'speakers', 'organizer'])
            ->withCount('registrations');

        // Add registration status for authenticated users
        if (auth()->check() && auth()->user()->isAudience()) {
            $query->addSelect([
                'is_registered' => function ($q) {
                    $q->selectRaw('COUNT(*) > 0')
                        ->from('registrations')
                        ->whereColumn('event_id', 'events.id')
                        ->where('user_id', auth()->id());
                },
            ]);
        }

        return $query->findOrFail($id);
    }

    /**
     * Create new event
     */
    public function create(array $data): Event
    {
        // Set organizer
        $data['organizer_id'] = auth()->id();

        // Handle audience types
        if (isset($data['audience_types'])) {
            $data['audience_mask'] = $this->calculateAudienceMask($data['audience_types']);
            unset($data['audience_types']);
        }

        $event = Event::create($data);

        // Attach speakers if provided
        if (! empty($data['speaker_ids'])) {
            $event->speakers()->attach($data['speaker_ids']);
        }

        return $this->getById($event->id);
    }

    /**
     * Update event
     */
    public function update(int $id, array $data): Event
    {
        $event = Event::findOrFail($id);

        // Handle audience types
        if (isset($data['audience_types'])) {
            $data['audience_mask'] = $this->calculateAudienceMask($data['audience_types']);
            unset($data['audience_types']);
        }

        $event->update($data);

        // Update speakers if provided
        if (isset($data['speaker_ids'])) {
            $event->speakers()->sync($data['speaker_ids']);
        }

        return $this->getById($event->id);
    }

    /**
     * Delete event
     */
    public function delete(int $id): bool
    {
        $event = Event::findOrFail($id);

        // Delete related registrations
        $event->registrations()->delete();

        // Detach speakers
        $event->speakers()->detach();

        return $event->delete();
    }

    /**
     * Calculate audience mask from array
     */
    private function calculateAudienceMask(array $audienceTypes): int
    {
        $mask = 0;
        $typeValues = [
            'students' => 1,
            'professionals' => 2,
            'general' => 4,
            'vip' => 8,
        ];

        foreach ($audienceTypes as $type) {
            if (isset($typeValues[$type])) {
                $mask |= $typeValues[$type];
            }
        }

        return $mask;
    }
}
