
<div>
    <section class="py-5">
        <div class="container">
          <div class="row gx-5">
            <aside class="col-lg-6">
              <div class="maindiv border rounded-4 mb-3 d-flex justify-content-center align-items-center">
                <a data-fslightbox="mygalley"   class="rounded-4 innnerdiv " target="_blank" data-type="image" href="{{ asset('storage/products/'. $product->image) }}">
                    <img style="width: 700px; height: 600px;  object-fit: cover; margin: auto; padding: 2%;" 
                    class="rounded-4 innnerimg" 
                    src="{{ asset('storage/products/'. $product->image) }}" />
                </a>
              </div>
            </aside>
            <main class="col-lg-6">
              <div class="ps-lg-3">
                <h4 class="title text-dark">{{ $product->name }}</h4>
                <div class="d-flex flex-row my-3">
                  <div class="text-warning mb-1 me-2">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                    <span class="ms-1">
                      4.5
                    </span>
                  </div>
                  {{-- <span class="text-muted"><i class="fas fa-shopping-basket fa-sm mx-1"></i>154 orders</span> --}}
                  {{-- <span class="text-success ms-2">In stock</span> --}}
                </div>
      
                <div class="mb-3">
                  <span class="h5">{{ number_format($product->price, 2) }}</span>
                  <span class="text-muted">/per box</span>
                </div>
      
                <p>{{ $product->description }}</p>
      
                <div class="row">
                  <dt class="col-3">Type:</dt>
                  <dd class="col-9">{{ $product->type }}</dd>
      
                  <dt class="col-3">Color</dt>
                  <dd class="col-9">{{ $product->color }}</dd>
      
                  <dt class="col-3">Material</dt>
                  <dd class="col-9">{{ $product->material }}</dd>
      
                  <dt class="col-3">Brand</dt>
                  <dd class="col-9"> {{ $product->brand }}</dd>
                </div>
      
                <hr />
      
                <div class="container mt-5">
                    <div class="row mb-4">
                        <div class="col-md-4 col-6 mb-3">
                            <label class="mb-2 d-block">Quantity</label>
                            <div class="input-group" style="width: 170px;">
                                <button class="btn btn-outline-secondary px-3" type="button" id="decrement">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="text" class="form-control text-center" id="quantity" value="1" readonly />
                                <button class="btn btn-outline-secondary px-3" type="button" id="increment">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                <a href="#" wire:click="buyNow({{ $product->id }})" class="btn btn-warning shadow-0"> Buy now </a>
                <a href="#" onclick="addToCart({{ $product->id }})" class="btn btn-primary shadow-0">
                    <i class="me-1 fa fa-shopping-basket"></i> Add to cart
                </a>
                {{-- <a href="#" class="btn btn-light border border-secondary py-2 icon-hover px-3"> <i class="me-1 fa fa-heart fa-lg"></i> Save </a> --}}
              </div>
            </main>
          </div>
        </div>
      </section>
      @if ($openmodal)
<div class="modal fade show d-block " id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true" style="background: rgba(0, 0, 0, 0.5);">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="cartModalLabel">Shopping Cart</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closemodal"></button>
          </div>
          <div class="modal-body">
            @foreach ($cartitem as $item)
              <div class="cart-items">
                  <!-- Loop through cart items -->
                  
                  {{-- @dd($item->getproduct->image); --}}
                  <div class="d-flex align-items-center mb-3 border-bottom pb-3 justify-content-between ">
                    
                      <img src="{{ asset('storage/products/'. $item->getproduct->image)  }}"  class="img-fluid rounded" alt="Product Image" style="width: 80px; height: 80px; object-fit: cover;">
                      <div class="ms-1  d-flex carditem justify-content-between w-100" >
                          <h6 class="mb-0">{{ $item->getproduct->name}}</h6>
                          <p class="mb-1 text-muted">₨{{ number_format($item->getproduct->price, 2) }}</p>

                          <div class="d-flex align-items-center justify-content-between innercard w-30" style="width: 30%">
                              <button class="btn btn-sm btn-outline-secondary me-2" wire:click="decreaseQuantity({{ $item->id }})">-</button>
                              {{-- @dd($item->name); --}}
                              <input type="text" class="form-control  text-center" 
       value="{{ $item->qty ?? 1 }}" min="1" 
       style="width: 60px;">
                              <button class="btn btn-sm btn-outline-secondary ms-2" wire:click="increaseQuantity({{ $item->id }})">+</button>
                              <button class="btn btn-danger btn-sm ms-3" wire:click="removeItem({{ $item->id }})">Remove</button>
                          </div>
                      </div>
                  </div>

              </div>
              @endforeach
              <!-- End Loop -->
              <div class="d-flex justify-content-between mt-3">
                  <h5>Subtotal:</h5>
                  <h5>₨{{ number_format($totalPrice, 2) ?? '_' }}</h5>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closemodal">Close</button>
              <a href="/cart" class="btn btn-primary">View Cart</a>
              <a wire:click="checkout" class="btn btn-success color-light">Checkout</a>
          </div>
      </div>
  </div>
</div>
@endif
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
        const minusButton = document.getElementById("decrement");
        const plusButton = document.getElementById("increment");
        const quantityInput = document.getElementById("quantity");

        // Decrement button
        minusButton.addEventListener("click", function () {
            let value = parseInt(quantityInput.value) || 1;
            if (value > 1) {
                quantityInput.value = value - 1;
            }
        });

        // Increment button
        plusButton.addEventListener("click", function () {
            let value = parseInt(quantityInput.value) || 1;
            quantityInput.value = value + 1;
        });
    });

    function addToCart(productId) {
        let quantity = document.getElementById("quantity").value;
        Livewire.emit('addToCart', productId, quantity); // Livewire event emit karega
    }
</script>

  