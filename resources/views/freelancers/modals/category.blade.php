<div class="modal fade custom-modal" id="add-category">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Ajouter une catégorie</h4>
                <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nom de la catégorie</label>
                        <input required name="name" id="name" type="text" class="form-control" placeholder="Entrez le nom de la catégorie">
                    </div>
                    <div class="form-group">
                        <label for="description">Description de la catégorie</label>
                        <textarea name="description" id="description" class="form-control" placeholder="Entrez la description de la catégorie" rows="8" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image" class="form-control" required>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-block">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
