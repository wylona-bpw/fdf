<?php
namespace App\Http\Controllers;

use App\Mail\NewContactMessage;
use App\Models\Contact;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function create()
    {
        return view('pages.contact');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:150',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:30',
            'subject' => 'nullable|string|max:200',
            'message' => 'required|string|max:5000',
            'consent' => 'accepted',
        ], [
            'consent.accepted' => 'Merci d\'accepter la politique de confidentialité pour continuer.',
        ]);

        unset($data['consent']);

        $contact = Contact::create($data);

        try {
            Mail::to(setting('email'))->send(new NewContactMessage($contact));
        } catch (\Throwable $e) {
            Log::warning('Échec de l\'envoi du mail de notification contact : ' . $e->getMessage());
        }

        return back()->with('success', 'Votre message a bien été envoyé. Nous vous répondrons dans les meilleurs délais.');
    }
}
