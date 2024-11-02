<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    public function showContact(Request $request)
    {
        $categories = Category::all();
        return view('contact', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $form = $request->all();
        return view('confirm', $form);
    }
    public function store(Request $request)
    {

        if ($request->has('back') == 'back') {
            return redirect('contact')->withInput();
        }

        $phone = $request->input('phone1') . $request->input('phone2') .  $request->input('phone3');
        $gender = $request->input('gender');
        $category = $request->input('category');
        $category_id = null;

        switch ($gender) {
            case '男性':
                $gender = 0;
                break;

            case '女性':
                $gender = 1;
                break;

            case 'その他':
                $gender = 2;
                break;
        }

        switch ($category) {
            case '商品のお届けについて';
                $category_id = 1;
                break;

            case '商品の交換について';
                $category_id = 2;
                break;

            case '商品トラブル':
                $category_id = 3;
                break;

            case 'ショップへのお問い合わせ':
                $category_id = 4;
                break;

            case 'その他':
                $category_id = 5;
                break;
        }

        Contact::create([
            'category_id' => $category_id,
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'gender' => $gender,
            'email' => $request->input('email'),
            'tell' => $phone,
            'address' => $request->input('address'),
            'building' => $request->input('building'),
            'detail' => $request->input('detail'),
        ]);

        return view('thanks');
    }

}
