<?php
namespace App\Http\Controllers;

use App\Mail\NewVolunteerApplication;
use App\Models\Volunteer;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class VolunteerController extends Controller
{
    public function create()
    {
        return view('pages.volunteer');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name'    => 'required|string|max:100',
            'last_name'     => 'required|string|max:100',
            'email'         => 'required|email|max:255',
            'phone'         => 'nullable|string|max:30',
            'city'          => 'nullable|string|max:100',
            'country'       => 'nullable|string|max:100',
            'country_other' => 'nullable|string|max:100|required_if:country,Autre',
            'message'       => 'nullable|string|max:2000',
            'skills'        => 'nullable|string|max:500',
            'availability'  => 'nullable|string|max:255',
            'consent'       => 'accepted',
        ], [
            'country_other.required_if' => 'Merci de préciser votre pays.',
            'consent.accepted'          => 'Merci d\'accepter la politique de confidentialité pour continuer.',
        ]);

        if (($data['country'] ?? null) === 'Autre') {
            $data['country'] = $data['country_other'];
        }
        unset($data['country_other'], $data['consent']);

        $volunteer = Volunteer::create($data);

        try {
            Mail::to(setting('email'))->send(new NewVolunteerApplication($volunteer));
        } catch (\Throwable $e) {
            Log::warning('Échec de l\'envoi du mail de notification bénévolat : ' . $e->getMessage());
        }

        return back()->with('success', 'Merci pour votre engagement ! Nous vous recontacterons très vite.');
    }
}
