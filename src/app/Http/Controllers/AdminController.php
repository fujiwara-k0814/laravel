<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class AdminController extends Controller
{
    //
    public function index()
    {
        $contacts = Contact::paginate(7);
        
        return view('admin', compact('contacts'));
    }

    public function search(Request $request)
    {
        $contacts = Contact::with('category')
                    ->KeywordSearch($request->keyword)
                    ->GenderSearch($request->gender)
                    ->CategorySearch($request->category_id)
                    ->DateSearch($request->date)
                    ->paginate(7);

        return view('admin', compact('contacts'));
    }

    public function destroy(Request $request)
    {
        Contact::find($request->id)->delete();

        return redirect('/admin');
    }


}
