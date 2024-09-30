<div class="card mb-3">
    <h4 class="card-header">Event Details</h4>
    <div class="card-body">
        <div class="row">
            <div class="col-6 mb-3">
                <label for="type">Shoot For <span class="text-danger">*</span></label>
                <select name="type" id="type" class="select2 form-control" required>
                    <option value="">Please Select</option>
                    <option value="wedding" {{ isset($event) && $event->type == 'wedding' ? 'selected' : '' }}>Wedding
                    </option>
                    <option value="occassion" {{ isset($event) && $event->type == 'occassion' ? 'selected' : '' }}>
                        Occasion
                    </option>
                    <option value="business" {{ isset($event) && $event->type == 'business' ? 'selected' : '' }}>
                        Business
                    </option>
                </select>
            </div>

            <div class="col-6 mb-3">
                <label for="title">Title <span class="text-danger">*</span></label>
                <select name="title" id="title" class="select2 form-control">
                    <option value="">Please Select</option>
                </select>
            </div>

            <div class="col-6 mb-3">
                <label for="start_date">Start Date <span class="text-danger">*</span></label>
                <input type="text" name="start_date" id="start_date" class="form-control" required
                    value="{{ isset($event) ? $event->start_date : '' }}" placeholder="Enter Event Start Date">
            </div>

            <div class="col-6 mb-3">
                <label for="end_date">End Date <span class="text-danger">*</span></label>
                <input type="text" name="end_date" id="end_date" class="form-control" required
                    value="{{ isset($event) ? $event->end_date : '' }}" placeholder="Enter Event End Date">
            </div>

            <div class="col-6 mb-3">
                <label for="no_of_photographers">Required Photographers <span class="text-danger">*</span></label>
                <input type="number" name="no_of_photographers" id="no_of_photographers" class="form-control" required
                    step="1" min="1" value="{{ isset($event) ? $event->required_photographers : '' }}"
                    placeholder="Enter No. of Required Photographers">
            </div>

            <div class="col-6 mb-3">
                <label for="arieal_view">Drone View <span class="text-danger">*</span></label>
                <select name="arieal_view" id="arieal_view" class="select2 form-control" required>
                    <option value="no" {{ isset($event) && !$event->arieal_view ? 'selected' : '' }}>No</option>
                    <option value="yes" {{ isset($event) && $event->arieal_view ? 'selected' : '' }}>Yes</option>
                </select>
            </div>

            <div class="col-6 mb-3">
                <label for="location">Location <span class="text-danger">*</span></label>
                <textarea name="location" id="location" class="form-control" rows="3" required
                    placeholder="Enter Your Event Location...">{{ isset($event) ? $event->location : '' }}</textarea>
            </div>

            <div class="col-6">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter Description...">{{ isset($event) ? $event->description : '' }}</textarea>
            </div>
        </div>
    </div>
</div>
