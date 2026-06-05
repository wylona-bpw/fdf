<?php
namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'name'  => 'nullable|string|max:150',
        ]);

        NewsletterSubscriber::firstOrCreate(
            ['email' => $request->email],
            ['name' => $request->name, 'unsubscribed_at' => null]
        );

        return back()->with('newsletter_success', 'Merci ! Vous êtes inscrit(e) à notre newsletter.');
    }

    public function unsubscribe(string $token)
    {
        $sub = NewsletterSubscriber::where('token', $token)->firstOrFail();
        $sub->unsubscribe();

        return view('pages.newsletter-unsubscribed');
    }
}
