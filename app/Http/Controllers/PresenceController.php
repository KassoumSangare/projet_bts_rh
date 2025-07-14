<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Presence;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresenceController extends Controller
{
  public function index()
{
    return view('backend.pages.Presence.index', [
        'presences' => Presence::latest()->paginate(25),
    ]);
}

}
