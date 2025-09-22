<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Get all users with pagination and filters.
     */
    public function getAll(array $filters = [], int $perPage = 15)
    {
        // Eager load roles to prevent N+1 query problems
        $query = User::with('role');

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('email', 'like', '%' . $filters['search'] . '%');
            });
        }

        return $query->paginate($perPage);
    }

    /**
     * Get a single user by ID.
     */
    public function getById(int $userId): User
    {
        return User::with('role')->findOrFail($userId);
    }

    /**
     * Update a user.
     */
    public function update(int $userId, array $data): User
    {
        $user = User::findOrFail($userId);

        // Hash password if it is being updated
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);
        return $user;
    }

    /**
     * Delete a user.
     */
    public function delete(int $userId): void
    {
        $user = User::findOrFail($userId);
        // Add any other cleanup logic here if needed (e.g., deleting related data)
        $user->delete();
    }
}
