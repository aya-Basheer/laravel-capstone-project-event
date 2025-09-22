<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(private UserService $userService)
    {
        // It's good practice to apply authorization here as well
        $this->authorizeResource(User::class, 'user');//يطبق Gates / Policies
    }

    /**
     * Display a listing of the users.
     */
    public function index(Request $request): JsonResponse
    {
        $users = $this->userService->getAll($request->all());
        return response()->json(['success' => true, 'data' => $users]);
    }

    /**
     * Display the specified user.
     */
    public function show(User $user): JsonResponse
    {
        $user = $this->userService->getById($user->id);
        return response()->json(['success' => true, 'data' => $user]);
    }

    /**
     * Update the specified user in storage.
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $updatedUser = $this->userService->update($user->id, $request->validated());
        return response()->json([
            'success' => true, 
            'data' => $updatedUser, 
            'message' => 'تم تحديث المستخدم بنجاح.'
        ]);
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        $this->userService->delete($user->id);
        return response()->json(['success' => true, 'message' => 'تم حذف المستخدم بنجاح.']);
    }
}
