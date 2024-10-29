<div class="card mb-3">
    <h4 class="card-header">Edit Product</h4>
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
        </div>
    </div>
</div>
