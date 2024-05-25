@if ($edit_permission || $delete_permission)
    @if ($edit_permission)
        <a href="#offcanvasAddUser" data-bs-toggle="offcanvas" class="dropdown-item"
            onclick="edit_stakeholder({{ $user->id }})">
            <i class="ti ti-edit"></i> &nbsp;
            Edit
        </a>
    @endif

    @if ($delete_permission)
        <hr>
        <a href="javascript:void(0)" onclick="destroy_stakeholder({{ $user->id }})" class="dropdown-item text-danger">
            <i class="ti ti-trash"></i> &nbsp;
            Delete
        </a>
    @endif
@else
    <a href="javascript:void(0)" class="dropdown-item text-warning">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-exclamation-mark" width="24"
            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
            stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M12 19v.01" />
            <path d="M12 15v-10" />
        </svg>
        &nbsp;
        Not Allowed
    </a>
@endif
