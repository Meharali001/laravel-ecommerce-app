<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-body">
            <h1 class="text-center text-primary fw-bold mb-4">🎉 Thanks for Shopping! 🎉</h1>

            @if($orders->isNotEmpty())
                @foreach($orders as $order)
                    <div class="alert alert-light border rounded p-3 mb-4">
                        <p class="fw-semibold mb-1">Order ID: 
                            <span class="text-primary">{{ $order->id }}</span>
                        </p>
                        <p class="fw-semibold mb-1">Order Date: 
                            <span class="text-primary">{{ $order->created_at->format('d M, Y') }}</span>
                        </p>
                        <p class="fw-semibold mb-1">Total Amount: 
                            <span class="text-success fw-bold">${{ number_format($order->total_amount, 2) }}</span>
                        </p>
                        <p class="fw-semibold">Status: 
                            <span class="badge bg-success">Completed ✅</span>
                        </p>
                    </div>

                    <h4 class="text-dark fw-bold mb-3">🛍️ Your Purchased Items</h4>
                    <div class="row">
                        @foreach($orderdetal as $cart)
                            <div class="col-md-12 mb-3">
                                <div class="d-flex align-items-center border-bottom pb-3">
                                    <img src="{{ asset('storage/products/' . $cart->getproduct->image) }}" 
                                         alt="Product Image" 
                                         class="rounded" style="width: 70px; height: 70px; object-fit: cover;">
                                    <div class="ms-3">
                                        <p class="fw-semibold text-dark m-0">{{ $cart->getproduct->name }}</p>
                                        <p class="text-muted m-0">Quantity: {{ $cart->qty }}</p>
                                        <p class="fw-bold text-primary m-0">Price: ${{ number_format($cart->getproduct->price, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="alert alert-success text-center fw-bold mt-4">
                        Total Amount Paid: ${{ number_format($orderdetal->sum(fn($cart) => $cart->getproduct->price * $cart->quantity), 2) }}
                    </div>
                @endforeach
            @else
                <p class="text-center text-danger fw-bold">No order found!</p>
            @endif
        </div>
    </div>
</div>
