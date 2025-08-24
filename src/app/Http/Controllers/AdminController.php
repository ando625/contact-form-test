<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;


class AdminController extends Controller
{
    //
    public function index(Request $request)
    {
        // Contact + Categoryをまとめて取得
        $query = Contact::with('category');
        $categories = Category::all(); // Bladeのselectに利用

        // 名前・メール検索
        if ($request->filled('name')) {
            $name = $request->name;
            $query->where(function ($q) use ($name) {
                $q->where('first_name', 'like', "%{$name}%")
                  ->orWhere('last_name', 'like', "%{$name}%")
                  ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$name}%"])
                  ->orWhere('email', 'like', "%{$name}%");
            });
        }

        // 性別検索（文字列→数字に変換）
        if ($request->filled('gender') && $request->gender !== 'all') {
            $genderMap = ['男性' => '1', '女性' => '2', 'その他' => '3'];
            $query->where('gender', $genderMap[$request->gender] ?? null);
        }

        // お問い合わせ種類検索
        if ($request->filled('inquiry_type')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('content', $request->inquiry_type);
            });
        }

        // 日付検索
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // ページネーション（7件ずつ）
        $contacts = $query->paginate(7)->withQueryString();

        return view('admin.index', compact('contacts', 'categories'));
    }

    public function export(Request $request)
    {
        $query = Contact::with('category');

        // index() と同じ絞り込み処理
        if ($request->filled('name')) {
            $name = $request->name;
            $query->where(function ($q) use ($name) {
                $q->where('first_name', 'like', "%{$name}%")
                  ->orWhere('last_name', 'like', "%{$name}%")
                  ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$name}%"]);
            });
        }

        if ($request->filled('gender') && $request->gender !== 'all') {
            $genderMap = ['男性' => '1', '女性' => '2', 'その他' => '3'];
            $query->where('gender', $genderMap[$request->gender] ?? null);
        }

        if ($request->filled('inquiry_type')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('content', $request->inquiry_type);
            });
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->get();

        // CSV作成
        $csvData = [];
        $csvData[] = ['姓', '名', '性別', 'メールアドレス', 'お問い合わせ種類', '作成日'];
        foreach ($contacts as $contact) {
            $genderText = $contact->gender == '1' ? '男性' : ($contact->gender == '2' ? '女性' : 'その他');
            $csvData[] = [
                $contact->last_name,
                $contact->first_name,
                $genderText,
                $contact->email,
                $contact->category->content ?? '',
                $contact->created_at->format('Y-m-d'),
            ];
        }

        $filename = 'contacts_' . now()->format('Ymd_His') . '.csv';

        return Response::stream(function () use ($csvData) {
            $handle = fopen('php://output', 'w');
            // BOM出力（Excel文字化け防止）
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));
            foreach ($csvData as $line) {
                fputcsv($handle, $line);
            }
            fclose($handle);
        }, 200, [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename={$filename}",
        ]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
    // AdminController.php
public function destroyContact(Contact $contact)
{
    $contact->delete();
    return redirect()->route('admin.index')->with('success', '削除しました');
}
}
