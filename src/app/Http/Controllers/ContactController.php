<?php

namespace App\Http\Controllers;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use App\Models\Contact; 

class ContactController extends Controller
{
  public function index()
  {
    return view('contact.index');
  }

  public function confirm(ContactRequest $request)
  {
 $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'tel1', 'tel2', 'tel3', 'address', 'building', 'category_id', 'detail'
    ]);

    return view('contact.confirm', compact('contact'));
  }

  public function store(ContactRequest $request){
    Contact::create([
        'category_id' => $request->category_id,
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'gender' => $request->gender,
        'email' => $request->email,
        'tel' => $request->tel1.$request->tel2.$request->tel3,
        'address' => $request->address,
        'building' => $request->building,
        'detail' => $request->detail
    ]);
    return redirect('/thanks');
  }
   public function thanks()
    {
        return view('contact.thanks');
    }
}