<div id="contenu">
    <h2>Enregistrer nouvel utilisateur</h2>
    <form method="POST" action="index.php?uc=connexion&action=valideNewUser">
        <label>Type d'utilisateur : </label><br>
        <select id='lstType' name='lstType'>
            <option value='comptable'>Comptable</option>
            <option value='visiteur'>Visiteur</option>
        </select><br>
        <label>Login : </label><br>
        <input type="text" name='login' required>*<br>
        <label>Mot de passe : </label><br>
        <input type="password" name='mdp' required>*<br>
        <label>Confirmez le mot de passe : </label><br>
        <input type="password" name='mdpConfirm' required>*<br>

        <label>Nom : </label><br>
        <input type="text" name='nom'><br>
        <label>Prenom : </label><br>
        <input type="text" name='prenom'><br>
        <label>adresse : </label><br>
        <input type="text" name='adresse'><br>
        <label>code postal : </label><br>
        <input type="text" name='cp'><br>
        <label>ville : </label><br>
        <input type="text" name='ville'><br>
        <label>date d'embauche : </label><br>
        <input type="text" id="datepicker" name='date'>

        <p>
            <input type="submit" value="Enregistrer">
            <input type="reset" value="Effacer">
            <input type="button" onclick="location.href = 'index.php';" value="Annuler">
        </p>
    </form>
</div>