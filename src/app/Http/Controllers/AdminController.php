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

    public function search(Request $request)
    {
        return $this->index($request);
    }

    public function reset()
    {
        return redirect('/admin');
    }

    public function export(Request $request)
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

        $contacts = $query->get();

        $filename = "contacts.csv";
        $handle = fopen($filename, 'w');
        fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));

        fputcsv($handle, ['名前','性別','メール','お問い合わせ種類','内容']);

        foreach ($contacts as $contact) {

            $genderText = $contact->gender == 1 ? '男性' :
                         ($contact->gender == 2 ? '女性' : 'その他');

            fputcsv($handle, [
                $contact->last_name . ' ' . $contact->first_name,
                $genderText,
                $contact->email,
                $contact->category->content,
                $contact->detail
            ]);
        }

        fclose($handle);

        return response()->download($filename)->deleteFileAfterSend(true);
    }
}