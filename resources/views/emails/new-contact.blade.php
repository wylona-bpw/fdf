<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<title>Nouveau message de contact</title>
</head>
<body style="font-family: Arial, sans-serif; color: #1f2937; background: #f9fafb; padding: 24px;">
    <div style="max-width: 560px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; border: 1px solid #e5e7eb;">
        <div style="background: #1e3a5f; padding: 20px 28px;">
            <h1 style="color: #ffffff; font-size: 18px; margin: 0;">Nouveau message — site AMFDF</h1>
        </div>
        <div style="padding: 28px;">
            <table style="width: 100%; font-size: 14px; border-collapse: collapse;">
                <tr>
                    <td style="padding: 8px 0; color: #6b7280; width: 120px;">Nom</td>
                    <td style="padding: 8px 0; font-weight: bold;">{{ $contact->name }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: #6b7280;">E-mail</td>
                    <td style="padding: 8px 0;"><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></td>
                </tr>
                @if($contact->phone)
                <tr>
                    <td style="padding: 8px 0; color: #6b7280;">Téléphone</td>
                    <td style="padding: 8px 0;">{{ $contact->phone }}</td>
                </tr>
                @endif
                @if($contact->subject)
                <tr>
                    <td style="padding: 8px 0; color: #6b7280;">Sujet</td>
                    <td style="padding: 8px 0;">{{ $contact->subject }}</td>
                </tr>
                @endif
            </table>
            <div style="margin-top: 16px; padding: 16px; background: #f9fafb; border-radius: 8px; font-size: 14px; white-space: pre-line;">{{ $contact->message }}</div>
            <p style="margin-top: 24px; font-size: 12px; color: #9ca3af;">Répondez directement à cet e-mail, ou retrouvez ce message dans l'admin (section « Demandes »).</p>
        </div>
    </div>
</body>
</html>
