<h2 class="text-center mt-5">Ajouter des événements</h2>
<div class="container mt-4 mb-4">
    <form action="index.php?controller=Event&action=addEvent" method="post" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Nom de l'événement" required>
            <div class="invalid-feedback">
                Veuillez entrer le nom de l'événement.
            </div>
        </div>
        
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="date" class="form-control" required>
            <div class="invalid-feedback">
                Veuillez choisir une date.
            </div>
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4" placeholder="Description de l'événement" required></textarea>
            <div class="invalid-feedback">
                Veuillez fournir une description de l'événement.
            </div>
        </div>
        
        <div class="mb-3">
            <label for="id_category" class="form-label">Catégorie</label>
            <select name="id_category" id="id_category" class="form-select" required>
                <?php foreach ($category as $categorie): ?>
                <option value="<?php echo $categorie->id_category;?>" selected><?php echo $categorie->name; ?></option>
                
                <?php endforeach?>
            </select>
            <div class="invalid-feedback">
                Veuillez sélectionner une catégorie.
            </div>
        </div>
        
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Ajouter l'événement</button>
        </div>
    </form>
</div>