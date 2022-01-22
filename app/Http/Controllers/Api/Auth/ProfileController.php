<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        return [
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->image,
        ];
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        $user->update($request->validated());
        if ($request->avatar) {
            $user->replaceImage($request->avatar, 'user_profile');
        }

        return response()->json([
            'message' => 'Profile updated successfully',
        ]);
    }
}