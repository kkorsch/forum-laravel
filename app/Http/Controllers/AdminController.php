<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
      return view('admin.index');
    }

    public function addModerator(Request $request)
    {
      $user = User::where('username', $request->user)->firstOrFail();

      $user->role()->update([
        'role_id' => 2,
      ]);

      return redirect()->back()->with('info', "User '{$user->username}' is now a Moderator");
    }

    public function deleteModerator(Request $request)
    {
      $user = User::where('username', $request->user)->firstOrFail();

      $user->role()->update([
        'role_id' => 1,
      ]);

      return redirect()->back()->with('info', "User '{$user->username}' is no longer Moderator.");
    }

    public function addAdmin(Request $request)
    {
      $user = User::where('username', $request->user)->firstOrFail();

      $user->role()->update([
        'role_id' => 3,
      ]);

      return redirect()->back()->with('info', "User '{$user->username}' is now an Admin.");
    }

    public function deleteAdmin(Request $request)
    {
      $user = User::where('username', $request->user)->firstOrFail();

      $user->role()->update([
        'role_id' => 1,
      ]);

      return redirect()->back()->with('info', "User '{$user->username}' is no longer Admin.");
    }

    public function banUser(Request $request)
    {
      $user = User::where('username', $request->user)->firstOrFail();

      $user->update([
        'active' => 0,
      ]);

      $user->logout();

      return redirect()->back()->with('info', "User '{$user->username}' is banned noob.");
    }
}
