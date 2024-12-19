<h2 class="text-center mt-5">Modifier l'évenement</h2>
<div class="container mt-4 mb-4">
    <form action="index.php?controller=Event&action=updateEventAction&id_event=<?php echo $event->id_event ?>" method="post" class="needs-validation" novalidate>
    <div class="invalid-feedback">
                ID de l'évenement.
            </div>
    <div class="mb-3">
            <label for="id_event" class="form-label">Nom</label>
            <input type="text" name="id_event" id="id_event" class="form-control" value="<?php echo $event->id_event ?>" disabled>
            <div class="invalid-feedback">
                Veuillez entrer le nom de l'événement.
            </div>
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" id="name" class="form-control" value="<?php echo $event->name ?>" required>
            <div class="invalid-feedback">
                Veuillez entrer le nom de l'événement.
            </div>
        </div>
        
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="date" value="<?php echo $event->date ?>" class="form-control" required>
            <div class="invalid-feedback">
                Veuillez choisir une date.
            </div>
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4"  required><?php echo $event->description ?>"</textarea>
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
            <button type="submit" class="btn btn-primary">Modifier l'événement</button>
        </div>
    </form>
</div>