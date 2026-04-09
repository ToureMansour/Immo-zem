<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code de réinitialisation - LLB Gestion</title>
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #445f47;
            padding: 40px 30px;
            text-align: center;
        }
        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }
        .content {
            padding: 40px 30px;
        }
        .code-container {
            background-color: #f8f9fa;
            border: 2px dashed #445f47;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            margin: 30px 0;
        }
        .code {
            font-size: 36px;
            font-weight: 800;
            letter-spacing: 0.2em;
            color: #445f47;
            margin: 10px 0;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px 30px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        .footer p {
            margin: 0;
            color: #6c757d;
            font-size: 14px;
        }
        .btn {
            display: inline-block;
            background-color: #445f47;
            color: #ffffff;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            margin: 20px 0;
        }
        .btn:hover {
            background-color: #364b39;
        }
        .warning {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .warning p {
            margin: 0;
            color: #856404;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>LLB Gestion</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <h2 style="color: #333; font-size: 24px; margin-bottom: 20px;">Code de réinitialisation</h2>
            
            <p style="color: #666; font-size: 16px; line-height: 1.5;">
                Vous avez demandé à réinitialiser votre mot de passe pour votre compte LLB Gestion. 
                Utilisez le code ci-dessous pour continuer le processus de réinitialisation.
            </p>

            <!-- Code Container -->
            <div class="code-container">
                <p style="margin: 0; color: #666; font-weight: 600;">Votre code de vérification :</p>
                <div class="code">{{ $code }}</div>
            </div>

            <!-- Warning -->
            <div class="warning">
                <p>
                    <strong>Important :</strong> Ce code expirera dans <strong>1 heure</strong>. 
                    Ne partagez ce code avec personne.
                </p>
            </div>
        <!-- Footer -->
        <div class="footer">
            <p>&copy; {{ date('Y') }} LLB Gestion. Tous droits réservés.</p>
            <p style="margin-top: 10px; font-size: 12px;">
                Si vous n'avez pas demandé cette réinitialisation, veuillez ignorer cet email.
            </p>
        </div>
    </div>
</body>
</html>
