<div class="card mb-3">
    <h4 class="card-header">Product Details</h4>
    <div class="card-body">
        <div class="row">
            <div class="col-4 mb-3">
                <label for="name">Name <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control" required
                    value="{{ isset($product) ? $product->name : '' }}" placeholder="Enter Product Name">
            </div>

            <div class="col-4 mb-3">
                <label for="price">Price <span class="text-danger">*</span></label>
                <input type="number" name="price" id="price" class="form-control" required
                    value="{{ isset($product) ? $product->price : '' }}" placeholder="Enter Product Price">
            </div>

            <div class="col-4 mb-3">
                <label for="stock">Stock <span class="text-danger">*</span></label>
                <input type="text" name="stock" id="stock" class="form-control" required
                    value="{{ isset($product) ? $product->stock : '' }}" placeholder="Enter Product Stock">
            </div>

            <div class="col-12 mb-3">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter Description...">{{ isset($product) ? $product->description : '' }}</textarea>
            </div>

            <div class="col-12 mt-2">
                <label for="attachment">Attachment</label>
                <input type="file" class="form-control attachment" name="attachments[]" id="attachment" multiple>
            </div>
        </div>
    </div>

    {{-- <div class="card-body product_repeater">
        <div data-repeater-list="product_repeater">
            <div data-repeater-item>
                <div class="row">
                    <div class="col-11 mb-3">
                        <div class="row">
                            <div class="row">
                                <div class="col-4 mb-3">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control name" required
                                        value="{{ isset($product) ? $product->name : '' }}"
                                        placeholder="Enter Product Name">
                                </div>

                                <div class="col-4 mb-3">
                                    <label for="price">Price <span class="text-danger">*</span></label>
                                    <input type="number" name="price" id="price" class="form-control price" required
                                        value="{{ isset($product) ? $product->price : '' }}"
                                        placeholder="Enter Product Price">
                                </div>

                                <div class="col-4 mb-3">
                                    <label for="stock">Stock <span class="text-danger">*</span></label>
                                    <input type="number" name="stock" id="stock" class="form-control stock" required
                                        value="{{ isset($product) ? $product->stock : '' }}"
                                        placeholder="Enter Product Stock">
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter Description...">{{ isset($product) ? $product->description : '' }}</textarea>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <label for="attachment">Attachment</label>
                                <input type="file" class=" attachment" name="attachments[]" id="attachment" multiple>
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="d-flex">
                            <button data-repeater-delete
                                class="btn btn-outline-danger waves-effect waves-float waves-light btn-xs new-floor_btn"
                                id="" type="button">
                                <i class="ti ti-x"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-12">
                <button class="btn btn-outline-success waves-effect waves-float waves-light btn-xs new-floor_btn"
                    id="" type="button" data-repeater-create>
                    <i class="ti ti-plus"></i>
                </button>
            </div>
        </div>
    </div> --}}
</div>
