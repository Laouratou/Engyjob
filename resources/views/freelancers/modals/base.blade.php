<div class="modal fade custom-modal" id="add-projectDuration">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Ajouter une durée</h4>
                <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{ route('project_durations.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Libellé</label>
                        <input required name="name" id="name" type="text" class="form-control" placeholder="">
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-block">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade custom-modal" id="add-freelancerLevel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Ajouter un niveau de freelancers</h4>
                <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{ route('freelancer_levels.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Libellé</label>
                        <input required name="name" id="name" type="text" class="form-control" placeholder="">
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-block">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade custom-modal" id="add-freelancerType">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Ajouter un type de freelancers</h4>
                <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{ route('freelancer_types.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Libellé</label>
                        <input required name="name" id="name" type="text" class="form-control" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-block">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade custom-modal" id="add-language">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Ajouter une langue</h4>
                <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{ route('project_languages.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Libellé</label>
                        <input required name="name" id="name" type="text" class="form-control" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="image">Drapeau</label>
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

<div class="modal fade custom-modal" id="add-languageLevel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Ajouter un niveau de langue</h4>
                <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{ route('project_languages_levels.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Libellé</label>
                        <input required name="name" id="name" type="text" class="form-control" placeholder="">
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-block">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
