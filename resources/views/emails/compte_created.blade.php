<!DOCTYPE html>
<html>
<body>
    <h2>Bonjour {{ $user->prenom }} {{ $user->nom }},</h2>
    <p>Votre compte bancaire a été créé avec succès 🎉</p>

    <p><strong>Numéro de compte :</strong> {{ $compte->numero_compte }}</p>
    <p><strong>Login :</strong> {{ $user->login }}</p>
    <p><strong>Mot de passe :</strong> {{$user->password}}</p>

    <p>Merci de votre confiance,<br>Orange Bank Sénégal</p>
</body>
</html>
