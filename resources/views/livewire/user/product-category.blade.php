<div>
    <section style="background-color: #eee;">
        <div class="container py-5">
            @foreach ($categories as $cat)
                <h1 class="mb-4 {{ $cat->getproduct->isNotEmpty() ? '' : 'd-none' }}">{{ $cat->name ?? '' }}</h1>
                <div class="row">
                    @foreach ($cat->getproduct as $pro)
                        <div class="col-md-12 col-lg-4 mb-lg-0">
                            <div class="card" style="margin-bottom: 15%">
                                <div class="d-flex justify-content-between p-3">
                                    <p class="lead mb-0">Today's Combo Offer</p>
                                    <div class="bg-info rounded-circle d-flex align-items-center justify-content-center shadow-1-strong" style="width: 35px; height: 35px;">
                                        <p class="text-white mb-0 small">x4</p>
                                    </div>
                                </div>
                                <img class="pro-img card-img-top" src="{{ asset('storage/products/'. $pro->image) }}" wire:click="productdetails({{ $pro->id }})" alt="Product Image" />
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="small"><a href="#!" class="text-muted">{{ $pro->type }}</a></p>
                                    </div>

                                    <div class="d-flex justify-content-between mb-3">
                                        <h5 class="mb-0">{{ $pro->name }}</h5>
                                        <h5 class="text-dark mb-0">{{ number_format($pro->price, 2) }} PKR</h5>
                                    </div>

                                    <div class="d-flex justify-content-between mb-2">
                                        <p class="text-muted mb-0">Available: <span class="fw-bold">{{ $pro->qty }}</span></p>
                                        <div class="ms-auto text-warning">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>

                                    <!-- Buy Now & Add to Cart Buttons -->
                                    <div class="d-flex justify-content-between mt-3">
                                        <button class="btn btn-success btn-sm" wire:click="buyNow({{ $pro->id }})">Buy Now</button>
                                        <button class="btn btn-primary btn-sm" wire:click="addToCart({{ $pro->id }})">Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </section>

    <!-- Cart Modal -->
    @if ($openmodal)
        <div class="modal fade show d-block" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true" style="background: rgba(0, 0, 0, 0.5);">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cartModalLabel">Shopping Cart</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closemodal"></button>
                    </div>
                    <div class="modal-body">
                        @foreach ($cart as $item)
                            <div class="cart-items">
                                <div class="d-flex align-items-center mb-3 border-bottom pb-3 justify-content-between">
                                    <img src="{{ asset('storage/products/'. $item['image']) }}" class="img-fluid rounded" alt="Product Image" style="width: 80px; height: 80px; object-fit: cover;">
                                    <div class="ms-1 d-flex carditem justify-content-between w-100">
                                        <h6 class="mb-0">{{ $item['name'] }}</h6>
                                        <p class="mb-1 text-muted">₨{{ number_format($item['price'], 2) }}</p>

                                        <div class="d-flex align-items-center justify-content-between innercard w-30" style="width: 30%">
                                            <button class="btn btn-sm btn-outline-secondary me-2" wire:click="decreaseQuantity({{ $item['id'] }})">-</button>
                                            <input type="text" class="form-control text-center" value="{{ $item['qty'] }}" min="1" style="width: 60px;">
                                            <button class="btn btn-sm btn-outline-secondary ms-2" wire:click="increaseQuantity({{ $item['id'] }})">+</button>
                                            <button class="btn btn-danger btn-sm ms-3" wire:click="removeItem({{ $item['id'] }})">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Subtotal -->
                        <div class="d-flex justify-content-between mt-3">
                            <h5>Subtotal:</h5>
                            <h5>₨{{ number_format($totalPrice, 2) }}</h5>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closemodal">Close</button>
                        <a href="/cart" class="btn btn-primary">View Cart</a>
                        <a wire:click="checkout" class="btn btn-success">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
