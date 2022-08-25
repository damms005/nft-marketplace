<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke()
    {
        $allUsers = User::with('loginAttempts', 'mostRecentLoginAttempt')->get();

        $userToLogin = $this->getNextPersonToLogin($allUsers)->firstOrFail();

        Auth::login($userToLogin, true);

        return redirect()->route('homepage');
    }

    public function getNextPersonToLogin(Collection $allUsers)
    {
        $usersThatHaveNeverLoggedIn = $allUsers->filter(fn (User $user) => $user->loginAttempts->isEmpty());

        if ($usersThatHaveNeverLoggedIn->isEmpty()) {
            return $allUsers->sortBy(fn (User $user) => $user->mostRecentLoginAttempt->id);
        }

        return $usersThatHaveNeverLoggedIn;
    }
}
