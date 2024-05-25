<div class="row mb-1">

    <div class="col-lg-6 col-md-6 col-sm-6 position-relative mb-1">
        <label class="form-label fs-6" for="role_name">Role Name<span class="text-danger">*</span></label>
        <input type="text" class="form-control form-control-md @error('role_name') is-invalid @enderror" id="role_name"
            name="role_name" placeholder="Role Name" value="{{ isset($data) ? $data->name : null }}" required />
        <small class="text-muted">Enter Role Name</small>
        @error('role_name')
            <div class="invalid-tooltip">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 position-relative mb-1">
        <label class="form-label fs-6" for="slug_name">Slug Name<span class="text-danger">*</span></label>
        <input type="text" class="form-control form-control-md @error('slug_name') is-invalid @enderror"
            id="slug_name" name="slug_name" placeholder="Role Name" value="{{ isset($data) ? $data->slug : null }}"
            required />
        <small class="text-muted">Enter Slug Name (Without Space Like: slug_name )</small>
        @error('slug_name')
            <div class="invalid-tooltip">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 position-relative">
        <label class="form-label fs-6" for="guard_name">Guard Name</label>
        <input type="text" class="form-control form-control-md bg-light text-dark " id="guard_name" name="guard_name"
            placeholder="web" readonly value="{{ isset($data) ? $data->guard_name : 'web' }}" required />
        @error('guard_name')
            <div class="invalid-tooltip">{{ $message }}</div>
        @enderror
    </div>
</div>

{{-- <div class="row mb-1">
    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="form-check form-check-inline">
            <input type="hidden" name="default" value="0" />
            <input class="form-check-input @error('default') is-invalid @enderror"
                {{ isset($role) && $role->default ? 'checked' : null }} type="checkbox" id="default" name="default"
                value="1" />
            <label class="form-check-label" for="default">Default</label>
        </div>
        @error('default')
            <div class="invalid-tooltip">{{ $message }}</div>
        @enderror
    </div>
</div> --}}
