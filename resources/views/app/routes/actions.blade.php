<a href="#offcanvasAddUser" data-bs-toggle="offcanvas" data-bs-target="#create_paper_type" class="dropdown-item"
    onclick="editLocation({{ $routes->id }})">
    <i class="ti ti-edit"></i> &nbsp;
    Edit
</a>
<hr>
<a href="javascript:void(0)" onclick="deleteRoute({{ $routes->id }})" class="dropdown-item text-danger">
    <i class="ti ti-trash"></i> &nbsp;
    Delete
</a>
