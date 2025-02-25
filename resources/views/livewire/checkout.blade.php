<section class="h-100 h-custom" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card">
          <div class="card-body p-4">

            <div class="row">
              <div class="col-lg-7">
                <h5 class="mb-3">
                  <a href="#!" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping</a>
                </h5>
                <hr>

                <div class="d-flex justify-content-between align-items-center mb-4">
                  <div>
                    <p class="mb-1">Shopping cart</p>
                    <p class="mb-0">You have {{ count($cartitem) }} items in your cart</p>
                  </div>
                </div>
                @if ($cartitem->isEmpty())
                <h3>Your Cart is Empty</h3>
                <p>Continue shopping <a href="{{ route('user.ShopNow') }}">here</a></p>
            {{-- @else
                @foreach ($cartitem as $item)
                    <p>{{ $item->product->name }} - Quantity: {{ $item->quantity }}</p>
                @endforeach --}}
            @endif
            

                @foreach ($cartitem as $item)
                <div class="card mb-3">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="d-flex align-items-center">
                        <img src="{{ asset('storage/products/' . $item->getproduct->image) }}" 
                          class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                        <div class="ms-3">
                          <h5>{{ $item->getproduct->name }}</h5>
                          <p class="small mb-0">{{ $item->getproduct->color }}</p>
                        </div>
                      </div>
                      <div class="d-flex align-items-center">
                        <h5 class="fw-normal mb-0 mx-3">{{ $item->qty }}</h5>
                        <h5 class="mb-0">${{ number_format($item->getproduct->price, 2) }}</h5>
                        <a wire:click="removeItem({{ $item->id }})" style="color: #cecece; cursor:pointer;">
                          <i class="fas fa-trash-alt"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach

                <!-- Total Price -->
                <div class="text-end">
                  <h4>Total: ${{ number_format($cartitem->sum(fn($item) => $item->getproduct->price * $item->qty), 2) }}</h4>
                </div>
              </div>

              <!-- Payment Section -->
              <div class="col-lg-5">
                <form id="payment-form" class="mt-4">
                  <div data-mdb-input-init class="form-outline form-white mb-4">
                    <input type="text" id="cardholder-name" class="form-control form-control-lg"
                      placeholder="Cardholder's Name" required />
                    <label class="form-label" for="cardholder-name">Cardholder's Name</label>
                  </div>

                  <!-- Stripe Card Element -->
                  <div data-mdb-input-init class="form-outline form-white mb-4" id="card-element"></div>


                  <button type="submit" id="submit" class="btn btn-primary w-100 {{ $cartitem->isEmpty() ? 'disabled' : '' }}">Pay Now</button>
                </form>
              </div>
            </div>              

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="https://js.stripe.com/v3/"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var stripe = Stripe("{{ config('services.stripe.key') }}");
        var elements = stripe.elements();
        var card = elements.create('card', {
            style: {
                base: {
                    fontSize: '16px',
                    color: '#000',
                    '::placeholder': { color: '#888' }
                }
            }
        });
        card.mount('#card-element');

        document.getElementById('payment-form').addEventListener('submit', function (e) {
            e.preventDefault();
            document.getElementById('submit').disabled = true;
            var cardholderName = document.getElementById('cardholder-name').value;

            stripe.createToken(card).then(function (result) {
                if (result.error) {
                    toastr.error(result.error.message);
                    document.getElementById('submit').disabled = false;
                } else {
                    Livewire.emit('processPayment', result.token.id, cardholderName);
                }
            });
        });

        Livewire.on('toastr', function (data) {
            if (data.type === 'success') {
                toastr.success(data.message);
                document.getElementById('submit').disabled = false;
            } else {
                toastr.error(data.message);
                document.getElementById('submit').disabled = false;
            }
        });
    });
</script>
