@if(session('message'))

<div class="alert border-0 bg-light-success alert-dismissible show py-2 ">
    <div class="d-flex align-items-center">
        <div class="ms-3">
            <div class="text-success py-2">{{session('message')}}</div>
        </div>
        <button type="button" class="btn-close ms-3" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif
