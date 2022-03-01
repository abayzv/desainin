<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $contact = Contact::paginate(10);
        return view('dashboard', compact(['contact']));
    }
}
