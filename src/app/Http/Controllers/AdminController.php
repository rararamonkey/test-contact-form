<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $gender = $request->gender;
        $category_id = $request->category_id;
        $date = $request->date;

        $query = Contact::query();

        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('first_name', 'like', '%' . $keyword . '%')
                  ->orWhere('last_name', 'like', '%' . $keyword . '%')
                  ->orWhere('email', 'like', '%' . $keyword . '%');
            });
        }

        if (!empty($gender)) {
            $query->where('gender', $gender);
        }

        if (!empty($category_id)) {
            $query->where('category_id', $category_id);
        }

        if (!empty($date)) {
            $query->whereDate('created_at', $date);
        }

        $contacts = $query->paginate(7)->appends($request->query());
        $categories = Category::all();

        return view('admin', compact(
            'contacts',
            'keyword',
            'gender',
            'category_id',
            'categories',
            'date'
        ));
    }
    public function destroy($id)
{
    Contact::findOrFail($id)->delete();

    return redirect('/admin');
}
}