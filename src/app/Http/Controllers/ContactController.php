<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
{
    $contact = $request->only([
        'first_name',
        'last_name',
        'gender',
        'email',
        'phone1',
        'phone2',
        'phone3',
        'address',
        'building',
        'category_id',
        'content'
    ]);

    // 性別
    $contact['gender_text'] = $contact['gender'];

    // 電話番号結合
    $contact['tel'] = $contact['phone1'] . '-' . $contact['phone2'] . '-' . $contact['phone3'];

    // お問い合わせ種類
    $contact['category_name'] = $contact['category_id'] ?? '未選択';


    $validated = $request->validated();
    $categories = [
    1 => '商品について',
    2 => '配送について',
    3 => '返品について',
    4 => 'その他',
];

$contact['category_name'] = $categories[$contact['category_id']] ?? '未選択';


    return view('confirm', compact('contact'));
}

    public function back(Request $request)
{
    return redirect()->route('contact.index')->withInput($request->all());
}


    public function store(ContactRequest $request)
    {
        $contact = $request->only([
            'first_name',
            'last_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'category_id',
            'content'
        ]);
        $contact['tel'] = $request->phone1 . '-' . $request->phone2 . '-' . $request->phone3;
        

        $contact['category_id'] = $request->category_id;
        $contact['detail'] = $request->content;


        Contact::create($contact);

        return view('thanks');

    }
    
}
