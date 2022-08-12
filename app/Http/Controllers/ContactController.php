<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Company;
use Illuminate\Validation\Validator;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {

        $companies = Company::userCompanies();
        $contacts=auth()->user()->contacts()->latestFirst()->paginate(10);
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

    public function store(Request $request)
    {
        $request->validate([
            'first_name' =>'required',
            'last_name' =>'required',
            'email' =>'required|email',
            'address' =>'required',
            'company_id' =>'required|exists:companies,id'
        ]);
        $request->user()->contacts()->create($request->all());

        return redirect()->route('contacts.index')->with('message', "Contact has been added successfully");
    }

    public function edit(Contact $contact)
    {
        $companies =Company::userCompanies();

        return view('contacts.edit', compact('companies', 'contact'));
    }

    public function update(Contact $contact, Request $request)
    {
        $request->validate([
            'first_name' =>'required',
            'last_name' =>'required',
            'email' =>'required|email',
            'address' =>'required',
            'company_id' =>'required|exists:companies,id'
        ]);
//        Contact::create($request->all());
        $contact->update($request->all());

        return redirect()->route('contacts.index')->with('message', "Contact has been updated successfully");
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return back()->with('message', "Contact has been deleted successfully");
    }

}
