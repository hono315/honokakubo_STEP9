<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('contact');
    }

    public function submitForm(ContactRequest $request)
    {
        $data = $request->validated();
        try {
            Mail::to(config('mail.admin_email'))->send(new ContactMail($data));
        } catch (\Exception $e) {
            \Log::error('メール送信エラー' . $e->getMessage());
            return back()->with('error', 'メール送信に失敗しました。');
        }

        return redirect()->route('products.index')
            ->with('success', 'お問い合わせが送信されました');
    }
}
