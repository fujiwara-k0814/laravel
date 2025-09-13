<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    //
    public function index()
    {
        return view('index');
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only([
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel1',
            'tel2',
            'tel3',
            'address',
            'building',
            'category_id',
            'detail'
        ]);
        
        return view('confirm', compact('contact'));
    }

    public function edit()
    {
        return redirect('/')->withInput();
    }

    public function store(ContactRequest $request)
    {
        $contact = $request->only([
            'last_name',
            'first_name',
            'gender',
            'email',
            'address',
            'building',
            'category_id',
            'detail'
        ]);

        $tel = implode("", [
            $request->input('tel1'),
            $request->input('tel2'),
            $request->input('tel3')
        ]);

        $contact['tel'] = $tel;
        
        Contact::create($contact);
    
        return view('thanks');
    }

}
