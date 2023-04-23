<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Jobs\ContactJob;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('home.contact.index');
    }

    public function store(Request $request)
    {
        $contact = Contact::create($request->all());
        dispatch(new ContactJob($contact));
    }
}
