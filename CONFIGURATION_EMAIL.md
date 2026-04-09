# Configuration des Emails pour LLB Gestion

## Étape 1 : Créer un compte Mailtrap (gratuit pour le développement)

1. Allez sur [https://mailtrap.io](https://mailtrap.io)
2. Créez un compte gratuit
3. Créez un nouveau projet "LLB Gestion"
4. Créez une nouvelle inbox "Development"

## Étape 2 : Configurer les identifiants

Dans votre fichier `.env`, remplacez :
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=votre-username-mailtrap
MAIL_PASSWORD=votre-password-mailtrap
MAIL_FROM_ADDRESS="noreply@llb-gestion.com"
MAIL_FROM_NAME="LLB Gestion"
```

Par les identifiants réels de Mailtrap :
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=VOTRE_USERNAME_MAILTRAP
MAIL_PASSWORD=VOTRE_PASSWORD_MAILTRAP
MAIL_FROM_ADDRESS="noreply@llb-gestion.com"
MAIL_FROM_NAME="LLB Gestion"
```

## Étape 3 : Tester l'envoi d'email

1. Redémarrez votre serveur Laravel : `php artisan serve`
2. Allez sur la page de connexion
3. Cliquez sur "Mot de passe oublié ?"
4. Entrez votre email
5. Vérifiez dans Mailtrap que l'email a été reçu

## Alternative : Utiliser Gmail (pour tests rapides)

Si vous préférez utiliser Gmail :

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_ENCRYPTION=tls
MAIL_USERNAME=votre-email@gmail.com
MAIL_PASSWORD=votre-mot-de-passe-app
MAIL_FROM_ADDRESS="noreply@llb-gestion.com"
MAIL_FROM_NAME="LLB Gestion"
```

**Important :** Pour Gmail, vous devez :
1. Activer l'authentification à deux facteurs
2. Créer un "mot de passe d'application" dans les paramètres de sécurité Google

## Production

Pour la production, utilisez :
- **SendGrid** (recommandé)
- **Mailgun**
- **Amazon SES**
- **Brevo (anciennement Sendinblue)**

## Vérification

Une fois configuré, le système :
1. Enverra un vrai email avec le code à 5 chiffres
2. Redirigera automatiquement vers la page de vérification
3. Pré-remplira l'email dans le formulaire de vérification
