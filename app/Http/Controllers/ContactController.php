<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Company;
use Illuminate\Validation\Validator;
use App\Http\Requests\ContactRequest;


class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {

        $companies = Company::userCompanies();
        #eager loading
        $contacts=auth()->user()->contacts()->with('company')->latestFirst()->paginate(10);
        return view('contacts.index', compact('contacts','companies'));
    }
    public function create()
    {

        $contact = new Contact();
        $companies =Company::userCompanies();

        return view('contacts.create', compact('companies', 'contact'));
    }
    public function show(Contact $contact)
    {
        return view('contacts.show',compact('contact'));
    }

    public function store(ContactRequest $request)
    {
        $request->user()->contacts()->create($request->all());

        return redirect()->route('contacts.index')->with('message', "Contact has been added successfully");
    }

    public function edit(Contact $contact)
    {
        $companies =Company::userCompanies();

        return view('contacts.edit', compact('companies', 'contact'));
    }

    public function update(Contact $contact, ContactRequest $request)
    {
//        Contact::create($request->all());
        $contact->update($request->all());

        return redirect()->route('contacts.index')->with('message', "Contact has been updated successfully");
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index')->with('message', "Contact has been deleted successfully");
    }

}
