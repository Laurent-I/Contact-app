<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use CodeIgniter\HTTP\RedirectResponse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|string
     */
    public function index()
    {
        $companies = auth()->user()->companies()->latest()->paginate(10);
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|string
     */
    public function create()
    {
        $company = new Company();

        return view('companies.create', compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CompanyRequest $request
     * @return RedirectResponse|Application|\Illuminate\Http\RedirectResponse|Redirector
     */
    public function store(CompanyRequest $request)
    {
        $request->user()->companies()->create($request->all());
        return redirect()->route('companies.index')->with('message', 'Company created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     * @return Application|Factory|string|View
     */
    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Company $company
     * @return Application|Factory|string|View
     */
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Company $company
     * @return Application|\Illuminate\Http\RedirectResponse|Redirector|RedirectResponse
     */
    public function update(Request $request, Company $company)
    {
        $company->update($request->all());
        return redirect()->route('companies.index')->with('message', 'Company updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return back()->with('message', 'Company deleted successfully');
    }
}
