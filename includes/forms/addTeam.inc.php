<h1>Ajouter une équipe</h1>

<div class="container">
    <!--enctype="multipart/form-data" pr envoyer des fichiers -->
    <form method="POST" enctype="multipart/form-data">
    
    <div class="row">
        <div class="col-md-4">
            <label>Nom</label>
            <input type="text" name="nom">
        </div>
        <div class="col-md-4">
            <label>Entraineur</label>
            <input type="text" name="entraineur">
        </div>
        <div class="col-md-4">
            <label>Couleurs</label>
            <input type="text" name="couleurs">
        </div>

        <br>
        <div class="col-md-4">
            <label>Logo</label>
            <input type="file" name="logo">
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <input type="submit" name="input" value="Enregistrer">
        </div>
    </div>

    </form>
</div>