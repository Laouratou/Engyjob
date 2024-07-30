<div class="modal fade" id="idVerificationModal" tabindex="-1" role="dialog" data-bs-backdrop="static"
    data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmation</h4>
                <span class="modal-close"><a href="javascript:void(0);" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa fa-times orange-text"></i></a></span>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="id_verification">
                @lang('Quelle action voulez-vous effectuer ?')
            </div>
            <div class="modal-footer">
                <button type="button"
                    class="btn btn-danger btn-round waves-effect btn_reject_verification">@lang('Rejeter')</button>
                <button type="button"
                    class="btn btn-success btn-round waves-effect btn_validate_verification">@lang('Valider')</button>
            </div>
        </div>
    </div>
</div>
