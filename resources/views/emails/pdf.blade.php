<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados de {{ $mascota }}</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; color: #333; font-size: 15px;">
    <div style="max-width: 480px; margin: auto; border: 1px solid #eee; padding: 32px; border-radius: 8px;">
        <div style="text-align:center; margin-bottom:18px;">
            <img src="{{ asset('images/logota.png') }}" alt="Laboratorio Tu Amigo" width="180">
        </div>
        <p style="font-size: 17px; color: #234f7d; margin-bottom: 8px;">
            <strong>Resultados de {{ $mascota }}</strong>
        </p>
        <p>
            Estimado(a) <b>{{ $nombre }}</b> <br>
            <span style="color: #777;">{{ $clinica }}</span>
        </p>
        <p style="margin-top: 14px;">
            Adjuntamos los resultados que solicitó en nuestro Laboratorio Clínico Veterinario.<br>
            Si tiene alguna duda, estamos a sus órdenes.
        </p>
        <p style="margin-top: 28px;">
            Saludos cordiales,
        </p>
        <p>
            <strong>M.V.Z. Claudia Maza Santiago</strong><br>
            <span style="font-size:13px;">Laboratorio Clínico Veterinario</span>
        </p>
        <hr style="margin: 18px 0;">
        <div style="font-size:12px; color: #999;">
            <i>Este correo ha sido enviado automáticamente. No responda a este mensaje.</i>
        </div>
    </div>
</body>
</html>



