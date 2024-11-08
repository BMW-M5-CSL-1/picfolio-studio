{{-- <div class="container">
    <!-- Product Images Carousel -->
    <div id="productCarouselModal" class="swiper">
        <div class="swiper-wrapper">
            @foreach ($images as $image)
                <div class="swiper-slide">
                    <img src="{{ $image }}" class="img-fluid" alt="Product Image">
                </div>
            @endforeach
        </div>
        <!-- Swiper Pagination & Navigation -->
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

    <!-- Product Details -->
    <div class="product-details mt-4">
        <h5 class="product-description">{{ $description }}</h5>
        <p class="product-price">{{ $price }} Rs.</p>
    </div>
</div> --}}

<div class="container">
    <!-- Product Images Carousel -->
    <div id="productCarouselModal" class="swiper">
        <div class="swiper-wrapper">
            @foreach ($images as $image)
                <div class="swiper-slide">
                    <img src="{{ $image }}" class="img-fluid" alt="Product Image">
                </div>
            @endforeach
        </div>
        <!-- Swiper Pagination & Navigation -->
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

    <!-- Product Details -->
    <div class="product-details mt-4">
        <h5 class="product-description">{{ $description }}</h5>
        <p class="product-price">Price: <b>{{ $price }} Rs.</b></p>
        <p class="product-price">Quantity: <b>{{ $stock }}</b></p>
    </div>

    <!-- Order Form -->
    <form id="orderForm">
        @csrf
        <input type="hidden" name="product_id" value="{{ $id }}">
        <input type="hidden" id="availableStock" value="{{ $stock }}">

        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
        </div>

        <div class="mb-3">
            <label for="delivery_address" class="form-label">Delivery Address</label>
            <textarea class="form-control" id="delivery_address" name="delivery_address" rows="3" required
                placeholder="Enter Location Coordinates"></textarea>
        </div>

        <button type="button" class="btn btn-primary" onclick="placeOrder()">Place Order</button>
    </form>
</div>
