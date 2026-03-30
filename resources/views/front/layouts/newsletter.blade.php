<!-- Newsletter Section -->
<section class="newsletter py-5 bg-success text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h3 class="fw-bold mb-2">Subscribe to Our Newsletter</h3>
                <p class="mb-0">Get the latest updates on new products and upcoming sales</p>
            </div>
            <div class="col-lg-6">
                <form action="{{ route('subscriber_send_email') }}" method="post">
                    @csrf
                    <div class="input-group">
                        <input name="email" type="text" class="form-control form-control-lg" placeholder="Enter your email address">
                        <button class="btn btn-primary btn-lg px-4" type="submit">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>