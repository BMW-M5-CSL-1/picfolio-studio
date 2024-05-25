<a href="#offcanvasAddUser" data-bs-toggle="offcanvas" data-bs-target="#create_paper_type" class="dropdown-item"
    onclick="editLocation({{ $location->id }})">
    <i class="ti ti-edit"></i> &nbsp;
    Edit
</a>
<hr>
<a href="{{ route('location.destroy', ['id' => $location->id]) }}" class="dropdown-item text-danger">
    <i class="ti ti-trash"></i> &nbsp;
    Delete
</a>
