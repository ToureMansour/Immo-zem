<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PasswordResetCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    // Afficher le formulaire de mot de passe oublié
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    // Envoyer le code de réinitialisation
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'email.exists' => 'Cette adresse email n\'existe pas dans notre système.',
        ]);

        // Générer un code à 5 chiffres
        $code = str_pad(random_int(0, 99999), 5, '0', STR_PAD_LEFT);

        // Supprimer les anciens codes pour cet email
        PasswordResetCode::where('email', $request->email)->delete();

        // Insérer le nouveau code (expire dans 1 heure)
        PasswordResetCode::create([
            'email' => $request->email,
            'code' => $code,
            'expires_at' => Carbon::now()->addHour(1),
            'used' => false,
        ]);

        // Envoyer l'email
        try {
            Mail::send('auth.emails.reset-code', ['code' => $code], function($message) use ($request) {
                $message->to($request->email);
                $message->subject('Code de réinitialisation - LLB Gestion');
            });
        } catch (\Exception $e) {
            // Si l'envoi échoue, logger l'erreur mais continuer
            \Log::error('Erreur envoi email: ' . $e->getMessage());
            \Log::info('Code généré pour ' . $request->email . ': ' . $code);
        }

        // Rediriger vers la page de vérification avec l'email en session
        session(['reset_email' => $request->email]);
        return redirect()->route('password.verify.form')->with('success', 'Un code de réinitialisation à 5 chiffres a été envoyé à votre adresse email.')->with('email', $request->email);
    }

    // Afficher le formulaire de vérification du code
    public function showVerifyForm()
    {
        return view('auth.verify-reset-code');
    }

    // Vérifier le code et afficher le formulaire de réinitialisation
    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:5',
        ], [
            'code.required' => 'Le code est obligatoire.',
            'code.digits' => 'Le code doit contenir exactement 5 chiffres.',
        ]);

        // Récupérer l'email depuis la session ou le formulaire
        $email = session('reset_email') ?: $request->email;

        if (!$email) {
            return redirect()->route('password.request')->with('error', 'Session expirée. Veuillez redemander un code.');
        }

        // Vérifier le code
        $resetCode = PasswordResetCode::where('email', $email)
            ->where('code', $request->code)
            ->first();

        if (!$resetCode || !$resetCode->isValid()) {
            return back()->with('error', 'Code invalide ou expiré. Veuillez demander un nouveau code.');
        }

        // Marquer le code comme utilisé
        $resetCode->update(['used' => true]);

        return redirect()->route('password.reset.form', ['email' => $email]);
    }

    // Afficher le formulaire de réinitialisation
    public function showResetForm($email)
    {
        return view('auth.reset-password', ['email' => $email]);
    }

    // Réinitialiser le mot de passe
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
        ], [
            'email.required' => 'L\'adresse email est obligatoire.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
        ]);

        // Mettre à jour le mot de passe
        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('login')->with('success', 'Votre mot de passe a été réinitialisé avec succès. Vous pouvez maintenant vous connecter.');
    }
}
