<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{

    public function index(Request $request)
    {
        $form = $request->session()->get('form', []);
        $categories = Category::all();
        return view('contact', [
            'form'=>$form,
            'categories' => $categories
        ]);
    }

    public function confirm(ContactRequest $request)
    {
        $form = $request->all();
        $request->session()->put('form', $form);

        $genders = [
            'male' => '男性',
            'female' => '女性',
            'other' => 'その他',
        ];

        $form['tel'] = [
            $request->input('tel')[0] ?? '',
            $request->input('tel')[1] ?? '',
            $request->input('tel')[2] ?? '',
        ];

        $categories = Category::pluck('content', 'id');

        return view('confirm', [
            'form' => $form,
            'genders' => $genders,
            'categories' => $categories
        ]);
    }

    public function send(Request $request)
    {
        $form = $request->session()->get('form');

        if (!$form) {
            return redirect()->route('contact.index');
        }

        $genderMap = [
            'male' => 1,
            'female' => 2,
            'other' => 3,
        ];

        $form['tel'] = implode('-', $form['tel'] ?? []);

        Contact::create([
            'last_name' => $form['last_name'],
            'first_name' => $form['first_name'],
            'gender' => $genderMap[$form['gender']],
            'email' => $form['email'],
            'tel' => $form['tel'],
            'adress' => $form['adress'],
            'building' => $form['building'] ?? null,
            'category_id' => $form['category_id'],
            'detail' => $form['detail'],
        ]);

        $request->session()->forget('form');

        return view('thanks');
    }
}