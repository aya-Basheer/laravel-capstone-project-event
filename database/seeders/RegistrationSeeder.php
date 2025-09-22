<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Registration;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $audienceRole = Role::where('name', 'audience')->first();
        $audienceUsers = User::where('role_id', $audienceRole->id)->get();
        $events = Event::all();

        // Create registrations for upcoming events
        $upcomingEvents = Event::where('starts_at', '>', now())->get();

        foreach ($upcomingEvents as $event) {
            // Register random number of users for each event (20-80% of capacity)
            $registrationCount = rand(
                (int) ($event->capacity * 0.2),
                (int) ($event->capacity * 0.8)
            );

            $registeredUsers = $audienceUsers->random(min($registrationCount, $audienceUsers->count()));

            foreach ($registeredUsers as $user) {
                Registration::create([
                    'user_id' => $user->id,
                    'event_id' => $event->id,
                    'registered_at' => Carbon::now()->subDays(rand(1, 10)),
                ]);
            }
        }

        // Create registrations for past events (completed registrations)
        $pastEvents = Event::where('ends_at', '<', now())->get();

        foreach ($pastEvents as $event) {
            // Register random number of users for past events
            $registrationCount = rand(
                (int) ($event->capacity * 0.5),
                (int) ($event->capacity * 0.9)
            );

            $registeredUsers = $audienceUsers->random(min($registrationCount, $audienceUsers->count()));

            foreach ($registeredUsers as $user) {
                Registration::create([
                    'user_id' => $user->id,
                    'event_id' => $event->id,
                    'registered_at' => Carbon::parse($event->starts_at)->subDays(rand(5, 20)),
                ]);
            }
        }

        // Ensure specific test users have some registrations
        $testUser = User::where('email', 'audience@example.com')->first();
        if ($testUser) {
            $testEvents = $upcomingEvents->random(min(3, $upcomingEvents->count()));

            foreach ($testEvents as $event) {
                // Check if not already registered
                if (! Registration::where('user_id', $testUser->id)->where('event_id', $event->id)->exists()) {
                    Registration::create([
                        'user_id' => $testUser->id,
                        'event_id' => $event->id,
                        'registered_at' => Carbon::now()->subDays(rand(1, 5)),
                    ]);
                }
            }
        }
    }
}
