<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<title>Nouvelle candidature bénévole</title>
</head>
<body style="font-family: Arial, sans-serif; color: #1f2937; background: #f9fafb; padding: 24px;">
    <div style="max-width: 560px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; border: 1px solid #e5e7eb;">
        <div style="background: #1e3a5f; padding: 20px 28px;">
            <h1 style="color: #ffffff; font-size: 18px; margin: 0;">Nouvelle candidature bénévole</h1>
        </div>
        <div style="padding: 28px;">
            <table style="width: 100%; font-size: 14px; border-collapse: collapse;">
                <tr>
                    <td style="padding: 8px 0; color: #6b7280; width: 140px;">Nom</td>
                    <td style="padding: 8px 0; font-weight: bold;">{{ $volunteer->first_name }} {{ $volunteer->last_name }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: #6b7280;">E-mail</td>
                    <td style="padding: 8px 0;"><a href="mailto:{{ $volunteer->email }}">{{ $volunteer->email }}</a></td>
                </tr>
                @if($volunteer->phone)
                <tr>
                    <td style="padding: 8px 0; color: #6b7280;">Téléphone</td>
                    <td style="padding: 8px 0;">{{ $volunteer->phone }}</td>
                </tr>
                @endif
                @if($volunteer->city || $volunteer->country)
                <tr>
                    <td style="padding: 8px 0; color: #6b7280;">Localisation</td>
                    <td style="padding: 8px 0;">{{ trim(($volunteer->city ?? '') . (($volunteer->city && $volunteer->country) ? ', ' : '') . ($volunteer->country ?? '')) }}</td>
                </tr>
                @endif
                @if($volunteer->skills)
                <tr>
                    <td style="padding: 8px 0; color: #6b7280;">Compétences</td>
                    <td style="padding: 8px 0;">{{ $volunteer->skills }}</td>
                </tr>
                @endif
                @if($volunteer->availability)
                <tr>
                    <td style="padding: 8px 0; color: #6b7280;">Disponibilité</td>
                    <td style="padding: 8px 0;">{{ $volunteer->availability }}</td>
                </tr>
                @endif
            </table>
            @if($volunteer->message)
            <div style="margin-top: 16px; padding: 16px; background: #f9fafb; border-radius: 8px; font-size: 14px; white-space: pre-line;">{{ $volunteer->message }}</div>
            @endif
            <p style="margin-top: 24px; font-size: 12px; color: #9ca3af;">Retrouvez cette candidature dans l'admin (section « Demandes »).</p>
        </div>
    </div>
</body>
</html>
