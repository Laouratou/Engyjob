<div class="modal fade custom-modal" id="success">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content proposal-modal-info">
            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center modal-body-content pt-0">
                    <h5 class="modal-title">Message</h5>
                    <p class="my-3">{{ session()->get('success') }}</p>
                </div>
                <div class="col-md-12 submit-section text-center">
                    <a data-bs-dismiss="modal" href="#" class="btn btn-primary submit-btn">Fermer</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade custom-modal" id="error">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content proposal-modal-info">
            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center modal-body-content pt-0">
                    <h5 class="modal-title">Ooops!</h5>
                    <p>{{ session()->get('error') }}</p>
                </div>
                <div class="col-md-12 submit-section text-center">
                    <a data-bs-dismiss="modal" href="#" class="btn btn-primary submit-btn">Fermer</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade custom-modal" id="errors">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content proposal-modal-info">
            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center- modal-body-content pt-0">
                    <h5 class="modal-title">Ooops!</h5>
                    <ol>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ol>
                </div>
                <div class="col-md-12 submit-section text-center">
                    <a data-bs-dismiss="modal" href="#" class="btn btn-primary submit-btn">Fermer</a>
                </div>
            </div>
        </div>
    </div>
</div>
