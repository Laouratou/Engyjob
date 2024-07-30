<div class="modal fade" id="makeProposalModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Envoyer une offre</h4>
                <span class="modal-close"><a href="javascript:void(0);" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa fa-times orange-text"></i></a></span>
            </div>
            <div class="modal-body">
                <div class="modal-info proposal-modal-info">
                    <form action="{{ route('proposals.store') }}" method="post" class="proposal-form">
                        @csrf
                        <input type="hidden" id="makeProposalModal_project_id" name="project_id">
                        <div class="feedback-form proposal-form ">
                            <div class="row">
                                <div class="col-md-6 input-block">
                                    <label class="form-label">Votre prix</label>
                                    <input type="number" name="price" class="form-control" placeholder="">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Délai de livraison estimé</label>
                                    <div class="input-group ">
                                        <input type="number" class="form-control" placeholder=""
                                            aria-label="Recipient's username" aria-describedby="basic-addon2"
                                            name="number_delivery_days">
                                        <span class="input-group-text" id="basic-addon2">Jours</span>
                                    </div>
                                </div>

                                <div class="col-md-12 input-block">
                                    <label class="form-label">Lettre de motivation</label>
                                    <textarea class="form-control summernote" rows="8" name="letter_cover"></textarea>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="suggested-milestones-form">
                            <div class="row">
                                <div class="col-md-4 input-block">
                                    <label class="form-label">Libellé</label>
                                    <input type="text" class="form-control" placeholder="Libellé">
                                </div>
                                <div class="col-md-2 input-block floating-icon">
                                    <label class="form-label">Montant</label>
                                    <input type="text" class="form-control" placeholder="Amount">
                                    <span><i class="feather-dollar-sign"></i></span>
                                </div>
                                <div class="col-md-3 input-block floating-icon">
                                    <label class="form-label">Date de début</label>
                                    <input type="text" class="form-control datetimepicker" placeholder="Choose">
                                    <span><i class="feather-calendar"></i></span>
                                </div>
                                <div class="col-md-3 input-block floating-icon">
                                    <label class="form-label">Date de fin</label>
                                    <input type="text" class="form-control datetimepicker" placeholder="Choose">
                                    <span><i class="feather-calendar"></i></span>
                                </div>
                                <div class="col-md-12">
                                    <div class="new-addd">
                                        <a id="new_add1" class="add-new"><i class="feather-plus-circle "></i>Ajouter un
                                            nouveau</a>
                                    </div>
                                </div>
                            </div>
                            <div id="add_row1"></div>
                        </div> --}}
                        <div class="proposal-features">
                            <div class="proposal-widget proposal-warning">
                                <label class="custom_check">
                                    <input type="checkbox" name="is_sticky" checked value="1">
                                    <span class="checkmark"></span>
                                    <span class="proposal-text">Collez cette proposition au sommet</span>
                                  
                                </label>
                                <p>La proposition sera toujours affichée au-dessus de toutes les propositions.</p>
                            </div>
                            <div class="proposal-widget proposal-blue">
                                <label class="custom_check">
                                    <input type="checkbox" name="is_hidden" value="1">
                                    <span class="checkmark"></span>
                                    <span class="proposal-text">Masquer cette proposition</span>
                               
                                </label>
                                <p>Cette proposition sera masquée pour tous les autres freelancers</p>
                            </div>

                        </div>
                        <div class="row">
                            {{-- <div class="col-md-12 submit-section">
                                <label class="custom_check">
                                    <input type="checkbox" name="select_time">
                                    <span class="checkmark"></span> J'accepte les termes et conditions
                                </label>
                            </div> --}}
                            <div class="col-md-12 submit-section text-end">
                                <a data-bs-dismiss="modal" href="javascript:void(0);"
                                    class="btn btn-cancel submit-btn">Annuler</a>
                                <button type="submit" class="btn btn-primary submit-btn">Envoyer la
                                    proposition</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            
        </div>
    </div>
</div>

<div class="modal fade" id="hireFreelancerModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg-">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmation</h4>
                <span class="modal-close">
                    <a href="javascript:void(0);" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times orange-text"></i>
                    </a>
                </span>
            </div>
            <form action="{{ route('company.projects.hire_freelancer') }}" method="post" class="proposal-form">
                <div class="modal-body">
                    <div class="modal-info proposal-modal-info">
                        @csrf
                        <input type="hidden" id="hireFreelancer_project_id" name="project_id">
                        <input type="hidden" id="hireFreelancer_freelancer_id" name="freelancer_id">
                        <input type="hidden" id="hireFreelancer_proposal_id" name="proposal_id">

                        <div class="feedback-form proposal-form ">
                            <div class="row">
                                <div class="text-center">
                                    <i class="fa-solid fa-circle-question text-primary fa-5x"></i>

                                    <h5 class="mt-3 fw-medium">
                                        Voulez-vous prendre <span class="text-primary"
                                            id="hireFreelancer_freelancer_name"></span><br>comme
                                        freelancer pour ce projet ?
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row mb-0 pb-0">
                        <div class="col-md-12 submit-section text-end">
                            <a data-bs-dismiss="modal" href="javascript:void(0);"
                                class="btn btn-cancel submit-btn">Annuler</a>
                            <button type="submit" class="btn btn-primary submit-btn">
                                Je confirme
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade edit-proposal-modal" id="add-milestone">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajout d'une nouvelle étape</h4>
                <span class="modal-close"><a href="javascript:void(0);" data-bs-dismiss="modal"
                        aria-label="Close"><i class="feather-x"></i></a></span>
            </div>
            <div class="modal-body">
                <form action="{{ route('etape_cles.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="etape_project_id" id="etape_project_id">
                    <div class="modal-info">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="input-block">
                                    <label class="form-label">Titre</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-block">
                                    <label class="form-label">Budget</label>
                                    <input type="number" class="form-control" name="price">
                                    <span class="input-group-text">CFA</span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-block">
                                    <label class="form-label">Date de début</label>
                                    {{-- <div class="cal-icon"> --}}
                                    <input class="form-control" type="date" name="start_date">
                                    {{-- </div> --}}
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-block">
                                    <label class="form-label">Date d'échance</label>
                                    {{-- <div class="cal-icon"> --}}
                                    <input class="form-control" type="date" name="end_date">
                                    {{-- </div> --}}
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="input-block">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section text-end">
                        <a href="javascript:void(0);" class="btn btn-cancel">Annuler</a>
                        <button type="submit" class="btn btn-primary submit-btn">Soumettre</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade edit-proposal-modal" id="add-task-modal">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter une nouvelle tâche</h4>
                <span class="modal-close"><a href="javascript:void(0);" data-bs-dismiss="modal"
                        aria-label="Close"><i class="feather-x"></i></a></span>
            </div>
            <div class="modal-body">
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="task_project_id" id="task_project_id">

                    <div class="modal-info">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-block">
                                    <label class="form-label">Etape</label>
                                    <select class="select" name="etape_cle_id">
                                        @isset($etapes_cles)
                                            @foreach ($etapes_cles as $key => $etape)
                                                <option value="{{ $etape->id }}">{{ $etape->name }}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-block">
                                    <label class="form-label">Date d'échéance</label>
                                    {{-- <div class="cal-icon"> --}}
                                    <input class="form-control" type="date" name="end_date">
                                    {{-- </div> --}}
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="input-block">
                                    <label class="form-label">Nom de la tâche</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="input-block">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-block">
                                    <label class="form-label">Statut</label>
                                    <select class="select" name="status">
                                        {{-- <option value="">Sélectionner</option> --}}
                                        <option value="pending">En attente</option>
                                        <option value="in_progress">En cours</option>
                                        <option value="completed">Terminée</option>
                                        <option value="cancelled">Annulée</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section text-end">
                        <a href="javascript:void(0);" class="btn btn-cancel">Annuler</a>
                        <button type="submit" class="btn btn-primary submit-btn">Soumettre</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- The Modal -->
<div class="modal fade edit-proposal-modal" id="add-project-file-modal">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter un nouveau fichier</h4>
                <span class="modal-close"><a href="javascript:void(0);" data-bs-dismiss="modal"
                        aria-label="Close"><i class="feather-x"></i></a></span>
            </div>
            <div class="modal-body">
                <form action="{{ route('project_files.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="file_project_id" id="file_project_id">

                    <div class="modal-info">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="pro-form-img">
                                    {{-- <div class="profile-pic">
                                        Profile Photo
                                    </div> --}}
                                    <div class="upload-files">
                                        <label class="file-upload image-upbtn ">
                                            <i class="feather-upload me-1"></i>
                                            Téléverser un fichier <input type="file" name="choosen_file">
                                        </label>
                                        <span>
                                            Pour une meilleure performance, ajoutez un fichier au format PDF ou JPG. Et
                                            utiliser des plateformes de stockage securisées pour partager vos fichiers
                                            volumineux.
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-block">
                                    <label class="form-label">Titre</label>
                                    <input class="form-control" type="text" name="name" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="input-block">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section text-end">
                        <a href="javascript:void(0);" class="btn btn-cancel">Annuler</a>
                        <button type="submit" class="btn btn-primary submit-btn">Soumettre</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /The Modal -->


<div class="modal fade success-modal hire-modal" id="success-verified">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-body pt-4">
                <div class="success-msg-content text-center">
                    <h4>Vérification soumise avec succès </h4>
                    <p>Vous serez vérifié une fois, l'administrateur approuve votre vérification</p>
                    <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary mt-3">Okay</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="payout_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Abonnement - Plan <span id="selected_plan_name"></span></h4>
                <span class="modal-close"><a href="javascript:void(0);" data-bs-dismiss="modal"
                        aria-label="Close"><i class="fa fa-times orange-text"></i></a></span>
            </div>
            <form action="{{ route('memberships.store') }}" method="POST">
                @csrf
                <input type="hidden" name="name" id="selected_plan" value="basic">
                <div class="modal-body">
                    <div class="modal-info">


                        <div class="wallet-add">
                            <div class="row mb-2">
                                <div class="col-12">
                                    <div class="input-block">
                                        <label for="periodicity" class="form-label">Type d'abonnement</label>
                                        <select name="periodicity" id="periodicity" class="form-control select">
                                            <option value="monthly">Mensuel</option>
                                            <option value="yearly">Annuel</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-md-4">
                                    <div class="bank-selection border p-2 rounded">
                                        <input type="radio" value="sank_money" id="rolelink"
                                            name="payment_method">
                                        <label for="rolelink">
                                            <img class="" width="90" src="{{ asset('assets/img/sm.png') }}"
                                                alt="Paypal">
                                            <span class="role-check"><i class="fa-solid fa-circle-check"></i></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="bank-selection border p-2 rounded">
                                        <input type="radio" value="orange_money" id="rolelink1"
                                            name="payment_method" checked>
                                        <label for="rolelink1">
                                            <img width="90" src="{{ asset('assets/img/om.png') }}"
                                                alt="Stripe">
                                            <span class="role-check"><i class="fa-solid fa-circle-check"></i></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="bank-selection border p-2 rounded">
                                        <input type="radio" value="moov_money" id="rolelink2"
                                            name="payment_method">
                                        <label for="rolelink2">
                                            <img width="90" src="{{ asset('assets/img/mm.png') }}"
                                                alt="image">
                                            <span class="role-check"><i class="fa-solid fa-circle-check"></i></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="doc-btn text-end">
                        <a data-bs-dismiss="modal" class="btn btn-gray">Annuler</a>
                        <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Abonnez-vous
                            maintenant</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="cancel_membership_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Confirmation d'annulation</h4>
                <span class="modal-close">
                    <a href="javascript:void(0);" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa fa-times orange-text"></i>
                    </a>
                </span>
            </div>
            <form action="{{ route('cancel_membership') }}" method="POST">
                @csrf
                <input type="hidden" name="membership_id" id="membership_id">
                <div class="modal-body">
                    <div class="modal-info">
                        <div class="wallet-add">
                            <p class="mb-0 text-center-">
                                <span class="orange-text fw-bold h3">Attention !</span>
                                <br><br>Etes-vous sur de vouloir annuler votre abonnement ? <br>
                                Cette action annulera votre abonnement et vous ne pourrez plus l'utiliser.
                            </p>
                        </div>
                    </div>

                    <div class="doc-btn text-end">
                        <a data-bs-dismiss="modal" class="btn btn-gray">Annuler</a>
                        <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Je confirme</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade edit-proposal-modal" id="write-review">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Laisser un commentaire</h4>
                <span class="modal-close"><a href="javascript:void(0);" data-bs-dismiss="modal"
                        aria-label="Close"><i class="feather-x"></i></a></span>
            </div>
            <div class="modal-body">
                <form action="{{ route('freelancers.reviews') }}" method="POST">
                    @csrf
                    <input type="hidden" name="project_id" id="project_id">
                    <input type="hidden" name="freelancer_id" id="freelancer_id">

                    <div class="modal-info">
                        <div class="reviewed-user">
                            <img src="{{ asset('profil_default.svg') }}" class="img-fluid avatar"
                                id="freelancer_avatar" alt="Img">
                            <span id="freelancer_name">--</span>
                        </div>
                        <div class="input-block form-info">
                            <label class="col-form-label mb-0 mt-2">Note</label>
                            <fieldset>
                                <span class="star-cb-group">

                                    <input type="radio" id="rating-5" name="rating" value="5" />
                                    <label for="rating-5">5</label>

                                    <input type="radio" id="rating-4" name="rating" value="4" />
                                    <label for="rating-4">4</label>

                                    <input type="radio" id="rating-3" name="rating" value="3"
                                        checked="checked" />
                                    <label for="rating-3">3</label>

                                    <input type="radio" id="rating-2" name="rating" value="2" />
                                    <label for="rating-2">2</label>

                                    <input type="radio" id="rating-1" name="rating" value="1" />
                                    <label for="rating-1">1</label>

                                    <input type="radio" id="rating-0" name="rating" value="0"
                                        class="star-cb-clear" />
                                    <label for="rating-0">0</label>
                                </span>
                            </fieldset>
                        </div>
                        <div class="input-block">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="comment" required rows="8"></textarea>
                        </div>
                    </div>
                    <div class="submit-section text-end">
                        <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-cancel">Fermer</a>
                        <button type="submit" class="btn btn-primary submit-btn">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="change_project_status_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Confirmation</h4>
                <span class="modal-close">
                    <a href="javascript:void(0);" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa fa-times orange-text"></i>
                    </a>
                </span>
            </div>
            <form action="{{ route('change_project_status') }}" method="POST">
                @csrf
                <input type="hidden" name="change_project_status_id" id="change_project_status_id">
                <input type="hidden" name="change_project_status" id="change_project_status">
                <div class="modal-body">
                    <div class="modal-info">
                        <div class="wallet-add">
                            <p class="mb-0 text-center-">
                                <span class="orange-text fw-bold h3">Attention !</span>
                                <br>
                                <span id="project_status"></span>
                            </p>
                        </div>
                    </div>

                    <div class="doc-btn text-end">
                        <a data-bs-dismiss="modal" class="btn btn-gray">Annuler</a>
                        <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Je confirme</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="wallet_add_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Recharge de portefeuille</h4>
                <span class="modal-close">
                    <a href="javascript:void(0);" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times orange-text"></i>
                    </a>
                </span>
            </div>
            
            <form action="{{ route('wallet_transactions.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="modal-info">
                        <div class="wallet-add">
                            <div class="row mb-2">
                                <div class="col-12">
                                    <div class="input-block">
                                        <label for="amount" class="form-label">Montant</label>
                                        <input type="number" name="amount" id="amount" class="form-control"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-12">
                                    <div class="input-block">
                                        <label class="form-label">Veuillez choisir un mode de
                                            paiement
                                        </label>
                                        
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="bank-selection border p-2 rounded">
                                        <input type="radio" value="sank_money" id="rolelink_wallet"
                                            name="payment_method_wallet">
                                        <label for="rolelink_wallet">
                                            <img class="" width="90"
                                                src="{{ asset('assets/img/sm.png') }}" alt="Paypal">
                                            <span class="role-check">
                                                <i class="fa-solid fa-circle-check"></i>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="bank-selection border p-2 rounded">
                                        <input type="radio" value="orange_money" id="rolelink1_wallet"
                                            name="payment_method_wallet" checked>
                                        <label for="rolelink1_wallet">
                                            <img width="90" src="{{ asset('assets/img/om.png') }}"
                                                alt="Stripe">
                                            <span class="role-check"><i class="fa-solid fa-circle-check"></i></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="bank-selection border p-2 rounded">
                                        <input type="radio" value="moov_money" id="rolelink2_wallet"
                                            name="payment_method_wallet">
                                        <label for="rolelink2_wallet">
                                            <img width="90" src="{{ asset('assets/img/mm.png') }}"
                                                alt="image">
                                            <span class="role-check"><i class="fa-solid fa-circle-check"></i></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="doc-btn text-end">
                        <a data-bs-dismiss="modal" class="btn btn-gray">Annuler</a>
                        <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Recharger
                            Maintenant</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="change_stape_cle_status_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Confirmation</h4>
                <span class="modal-close">
                    <a href="javascript:void(0);" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times orange-text"></i>
                    </a>
                </span>
            </div>
            <form action="{{ route('change_stape_cle_status') }}" method="POST">
                @csrf
                <input type="hidden" name="etape_cle_status_id" id="etape_cle_status_id">
                <input type="hidden" name="etape_cle_status" id="etape_cle_status">
                <div class="modal-body">
                    <div class="modal-info">
                        <div class="wallet-add">
                            <p class="mb-0 text-center-">
                                <span class="orange-text fw-bold h3">Attention !</span>
                                <br>Etes-vous sûr de vouloir marqué cette étape comme <span class="fw-bold"
                                    id="etape_status"> en
                                    attente</span> ?

                            </p>
                        </div>
                    </div>

                    <div class="doc-btn text-end">
                        <a data-bs-dismiss="modal" class="btn btn-gray">Annuler</a>
                        <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Je confirme</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="change_task_status_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Confirmation</h4>
                <span class="modal-close">
                    <a href="javascript:void(0);" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times orange-text"></i>
                    </a>
                </span>
            </div>
            <form action="{{ route('change_task_status') }}" method="POST">
                @csrf
                <input type="hidden" name="task_status_id" id="task_status_id">
                <input type="hidden" name="task_status" id="task_status">
                <div class="modal-body">
                    <div class="modal-info">
                        <div class="wallet-add">
                            <p class="mb-0 text-center-">
                                <span class="orange-text fw-bold h3">Attention !</span>
                                <br>Etes-vous sûr de vouloir marqué cette tâche comme <span class="fw-bold"
                                    id="task_status_text"> en
                                    attente</span> ?

                            </p>
                        </div>
                    </div>

                    <div class="doc-btn text-end">
                        <a data-bs-dismiss="modal" class="btn btn-gray">Annuler</a>
                        <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Je confirme</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="user_payment_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Confirmation de paiement</h4>
                <span class="modal-close">
                    <a href="javascript:void(0);" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times orange-text"></i>
                    </a>
                </span>
            </div>
            <form action="{{ route('user_payments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="etape_cle_payment_id" id="etape_cle_payment_id">
                <input type="hidden" name="user_payment_project_id" id="user_payment_project_id">

                <div class="modal-body">
                    <div class="modal-info">
                        <div class="wallet-add">
                            <p class="mb-0 text-center-">
                                <span class="orange-text fw-bold h3">Attention !</span>
                                <br>Confirmez-vous le paiement d'une somme de
                                <span class="fw-bold orange-text number" id="payment_amount"></span> <span
                                    class="fw-bold orange-text">CFA</span> au freelancer <span
                                    class="fw-bold orange-text" id="user_payment_freelancer_name"></span> ?

                            </p>
                        </div>
                    </div>

                    <div class="doc-btn text-end">
                        <a data-bs-dismiss="modal" class="btn btn-gray">Annuler</a>
                        <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Je confirme</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
