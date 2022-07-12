<div class="row">
    <form class="col-md-auto wrap" action="php/createUser.php" method="POST">
                <h2> CREER </h2>
                <div class="form-group">
                    <label>Nom</label>
                    <input type="text" name="nom" class="form-control" placeholder="Nom" required>
                </div>
                <div class="form-group">
                    <label>Prenom</label>
                    <input type="text" name="prenom" class="form-control" placeholder="Prenom" required>
                </div>
                <div class="form-group">
                    <label>Telephone</label>
                    <input type="tel" name="telephone" class="form-control" placeholder="Telephone" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label>Nom d'utilisateur</label>
                    <input type="text" name="username" class="form-control" placeholder="Nom d'utilisateur" required>
                </div>
                <div class="form-group">
                    <label>Mot de Passe</label>
                    <input type="password" name="password" class="form-control" placeholder="Mot de passe" required>
                </div>
                    <label>Sexe</label>
                        <label class="radio-inline">
                        <input type="radio" name="genre" value="m" checked>Homme
                        </label>
                        <label class="radio-inline">
                        <input type="radio" name="genre" value="f">Femme
                    </label>
                <div class="form-group">
                <label>Privilege</label>
                <select name="privilege">
                    <option checked value="user">Utilisateur</option>
                    <option value="admin">Administrateur</option>
                </select>
            </div>
                <div class="container" style="margin-top: 30px;">  
                    <input type="submit" class="btn btn-success" name="enregistrer" value="Enregistrer">
                    <input type="reset"  class="btn btn-warning" name="annuler" value="Effacer">
                </div>
    </form>
<!--    <div class="col col-lg-1"></div>-->
    <div class="col grid">
        <caption><h2><u>Les utilisateurs</u></h2></caption>
        <?php include "liens/userBoard.php" ?>
    </div>
</div>

<div class="row board">
            <div class="col-sm-12 col-md-12 col-lg-12"></div>
</div>

