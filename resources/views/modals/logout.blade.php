<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmation</h4>
                <span class="modal-close"><a href="javascript:void(0);" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa fa-times orange-text"></i></a></span>
            </div>
            <div class="modal-body">
                @lang('Etes-vous sûr de vouloir vous déconnecter ?')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger- btn-round waves-effect"
                    data-bs-dismiss="modal">@lang('Annuler')</button>

                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"
                    class="btn btn-primary btn-round waves-effect">@lang('Se déconnecter')</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
