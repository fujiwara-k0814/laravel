<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    //
    public function export(Request $request)
    {
        //検索機能
        $contacts = Contact::with('category')
                    ->KeywordSearch($request->keyword)
                    ->GenderSearch($request->gender)
                    ->CategorySearch($request->category_id)
                    ->DateSearch($request->date)
                    ->get();

        
        //csv処理
        $filename = 'contacts_' . now()->format('Ymd_His') . '.csv';

        if ($request->destination === 'storage') {
            $csv = fopen('php://temp', 'r+');
            fputcsv($csv, [
                'ID', 
                'お名前', 
                '性別', 
                'メールアドレス', 
                '電話番号', 
                '住所', 
                '建物名', 
                'お問い合わせ種類', 
                'お問い合わせ内容', 
                '作成日', 
                '更新日'
            ]);
            
            foreach ($contacts as $contact){
                fputcsv($csv, [
                    $contact->id,
                    $contact->last_name . ' ' . $contact->first_name,
                    $contact->gender_label,
                    $contact->email,
                    $contact->tel,
                    $contact->address,
                    $contact->building,
                    $contact->category_label,
                    $contact->detail,
                    $contact->created_at,
                    $contact->updated_at
                ]);
            }

            rewind($csv);
            $csvContent = stream_get_contents($csv);
            fclose($csv);

            Storage::disk('local')->put("exports/{$filename}", $csvContent);

            return back();
        }

        return new StreamedResponse(function () use ($contacts) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, [
                'ID', 
                'お名前', 
                '性別', 
                'メールアドレス', 
                '電話番号', 
                '住所', 
                '建物名', 
                'お問い合わせ種類', 
                'お問い合わせ内容', 
                '作成日', 
                '更新日'
            ]);

            foreach ($contacts as $contact) {
                fputcsv($handle, [
                    $contact->id,
                    $contact->last_name . ' ' . $contact->first_name,
                    $contact->gender_label,
                    $contact->email,
                    $contact->tel,
                    $contact->address,
                    $contact->building,
                    $contact->category_label,
                    $contact->detail,
                    $contact->created_at,
                    $contact->updated_at
                ]);
            }

            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ]);
    }
}
