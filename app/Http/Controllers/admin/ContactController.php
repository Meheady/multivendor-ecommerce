<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function allContact()
    {
        $allData = Contact::latest()->get();
        return view('admin.contact.all-contact',compact('allData'));
    }
}
