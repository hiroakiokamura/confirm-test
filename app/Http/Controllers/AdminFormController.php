<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminFormController extends Controller
{

    public function showAdminForm(Request $request)
    {
        $query = Contact::query();
        $contacts = Contact::with('category')->get();
        $categories = Category::all();

        $contactsCount = $query->count();

        if ($contactsCount > 7) {
            $contacts = $query->paginate(7)->appends($request->except('page'));
            $paginate = true;
        } else {
            $contacts = $query->get();
            $paginate = false;
        }

        return view('/auth/admin', compact('contacts', 'categories', 'paginate'));
    }

    public function searchContact(Request $request)
    {
        $query = Contact::query();

        // 名前またはメールアドレスでの部分一致検索
        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('last_name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('email', 'like', '%' . $request->keyword . '%');
            });
        }

        // 性別での検索
        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        // お問い合わせ種類での検索
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 日付での検索
        if ($request->filled('contact_date')) {
            $query->whereDate('created_at', $request->contact_date);
        }

        $contactsCount = $query->count();

        if ($contactsCount > 7) {
            $contacts = $query->paginate(7)->appends($request->except('page'));
            $paginate = true;
        } else {
            $contacts = $query->get();
            $paginate = false;
        }

        // カテゴリーを表示するためのデータを渡す
        $categories = Category::all();

        return view('/auth/admin', compact('contacts', 'categories', 'paginate'));
    }

    // 削除処理
    public function destroy($id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json(['error' => 'データが見つかりませんでした'], 404);
        }

        $contact->delete();

        return redirect()->route('showAdmin')->with('success', '削除されました。');
    }




    // CSVエクスポート機能
    public function export(Request $request)
    {
        // パラメータに基づいてデータをフィルタリング
        $contacts = Contact::query();

        if ($request->filled('keyword')) {
            $contacts->where(function ($query) use ($request) {
                $query->where('first_name', 'like', '%' . $request->keyword . '%')
                ->orWhere('last_name', 'like', '%' . $request->keyword . '%')
                ->orWhere('email', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($request->filled('gender') && $request->gender !== 'all') {
            $contacts->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $contacts->where('category_id', $request->category_id);
        }

        if ($request->filled('contact_date')) {
            $contacts->whereDate('created_at', $request->contact_date);
        }

        $contacts = $contacts->get();

        // CSVを生成し、BOM付きのUTF-8でストリーム出力
        $response = new StreamedResponse(function () use ($contacts) {
            $handle = fopen('php://output', 'w');

            // BOMを追加してUTF-8エンコーディングを指定
            fwrite($handle, "\xEF\xBB\xBF");

            // CSVのヘッダ行を作成
            fputcsv($handle, ['名前', '性別', 'メールアドレス', 'お問い合わせの種類', '詳細']);

            // データをCSV形式で出力
            foreach ($contacts as $contact) {
                fputcsv($handle, [
                    $contact->last_name . $contact->first_name,
                    $contact->gender == 0 ? '男性' : ($contact->gender == 1 ? '女性' : 'その他'),
                    $contact->email,
                    $contact->category->content,
                    $contact->detail
                ]);
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
        $response->headers->set('Content-Disposition', 'attachment; filename="contacts.csv"');

        return $response;
    }

}
