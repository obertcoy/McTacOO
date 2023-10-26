<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        @guest
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Buy Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center ">
                    <h3>Please Login</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href={{ route('login') }}>
                        <button type="button" class="btn btn-primary">Login</button>
                    </a>
                </div>
            </div>
        @endguest
    </div>
</div>
