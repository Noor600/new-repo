<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\User;

class userController extends Controller
{
    public function index() {
        return view('users.index')->with('users' , User::all());
    }

    public function makeAdmin(User $user) {
        $user->role = 'admin';
        $user->save();
        session()->flash('success', 'the user is admin now');
        return redirect(route('users.index'));
    }
    public function makeWriter(User $user) {
        $user->role ='writer';
        $user->save();
        return redirect(route('users.index'));
    }
    public function edit(User $user) {
        $profile = $user->profile;
        return view('users.profile', ['user' => $user, 'profile' => $profile]);
    }
    public function update(User $user, Request $request) {
        $profile = $user->profile;
        $data = $request->all();
        if ($request->hasFile('picture')) {
            $picture = $request->picture->store('profilesPicture',
            'public');
            $data['picture'] = $picture;
        }
        $profile->update($data);
        return redirect(route('home'));
    }
}
