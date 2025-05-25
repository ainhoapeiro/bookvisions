<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserFollowController extends Controller
{
    public function toggle(User $user)
    {
        $follower = Auth::user();

        if ($follower->following->contains($user->id)) {
            // Dejar de seguir
            $follower->following()->detach($user->id);
        } else {
            // Seguir
            $follower->following()->attach($user->id);
        }

        return back();
    }
}
