<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Contact::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $contactIdList = Order::whereNotNull('contact_id')->pluck('contact_id');
        $contactList = Contact::whereNotIn('id', $contactIdList)->get();
        return view('admin.contact.index', compact('contactList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Contact $contact
     * @return void
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Contact $contact
     * @return void
     */
    public function edit(Contact $contact)
    {
        $contactList = Contact::all();
        return view('admin.contact.index', compact('contact', 'contactList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Contact $contact
     * @return void
     */
    public function update(Request $request, Contact $contact)
    {
        parse_str(parse_url(url()->previous())['query'] ?? '', $queryArray);
        if (isset($queryArray['back'])) {
            $route = redirect($queryArray['back']);
        } else {
            $route = to_route('contact.index');
        }
        $contact->update($request->all());
        return $route->withSuccess(trans('message.saved'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Contact $contact
     * @return void
     * @throws Exception
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return to_route('contact.index')->withSuccess(trans('message.deleted'));
    }
}
