<div class="modal fade custom-modal" id="add-skill">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Ajouter un skill</h4>
                <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{ route('skills.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nom du skill</label>
                        <input required name="name" id="name" type="text" class="form-control" placeholder="Entrez le nom du skill">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" placeholder="Entrez la description" rows="8" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image" class="form-control">
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-block">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
