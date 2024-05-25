<a href="#offcanvasAddUser" data-bs-toggle="offcanvas" data-bs-target="#create_paper_type" class="dropdown-item"
    onclick="editPaperType({{ $paper_type->id }})">
    <i class="ti ti-edit"></i> &nbsp;
    Edit
</a>
<hr>
<a href="{{ route('paper-type.destroy', ['id' => $paper_type->id]) }}" class="dropdown-item text-danger">
    <i class="ti ti-trash"></i> &nbsp;
    Delete
</a>
