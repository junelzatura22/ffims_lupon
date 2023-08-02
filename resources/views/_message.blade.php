@if (!empty(Session::has('success')))
    <div class="alert alert-success alert-dismissible" role="alert" id="success-alert">
        </strong> {{ session('success') }} <strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
@endif
@if (!empty(Session::has('error')))
    <div class="alert alert-danger alert-dismissible" role="alert" id="error-alert">
        <strong> {{ session('error') }} </strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (!empty(Session::has('edit_success')))
    <div class="alert alert-warning alert-dismissible" role="alert" id="warning-alert">
        </strong> {{ session('edit_success') }} <strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
@endif
@if (!empty(Session::has('delete_success')))
    <div class="alert alert-info alert-dismissible" role="alert" id="delete-alert">
        </strong> {{ session('delete_success') }} <strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
@endif

@if (!empty(Session::has('edit_success')))
    <div class="alert alert-warning alert-dismissible" role="alert" id="edit-alert">
        </strong> {{ session('edit_success') }} <strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
@endif