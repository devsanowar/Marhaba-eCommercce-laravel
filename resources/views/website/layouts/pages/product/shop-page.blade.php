@include('website.layouts.inc.header')



<!-- ==================== Breadcumb Start Here ==================== -->
<section class="breadcumb py-120 bg-img"
    style="background-image: url({{ asset('frontend') }}/assets/images/thumbs/breadcumb-img.png)">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="breadcumb__wrapper">
                    <h1 class="breadcumb__title">Shop</h1>
                    <ul class="breadcumb__list">
                        <li class="breadcumb__item">
                            <a href="index.html" class="breadcumb__link">
                                <i class="las la-home"></i> Home</a>
                        </li>
                        <li class="breadcumb__item">/</li>
                        <li class="breadcumb__item">
                            <span class="breadcumb__item-text">Shop </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================product category two section start here ==============================-->
<div class="product-category-two" style="background-color: #f8f9fa">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="left-sidebar">
                    <div>
                        <span class="close-sidebar d-lg-none d-block">
                            <i class="las la-times"></i>
                        </span>
                        <h6 class="sidebar-item__title">Category</h6>
                        <div class="sidebar-item">
                            @forelse ($categories as $category)
                                <div class="form-check form--check mb-4">
                                    <input
                                        class="form-check-input category-checkbox"
                                        type="checkbox"
                                        value="{{ $category->id }}"
                                        id="category-{{ $category->id }}"
                                    />
                                    <label class="form-check-label" for="category-{{ $category->id }}">
                                        {{ $category->category_name }}
                                    </label>
                                </div>
                            @empty
                                <div class="form-check form--check">
                                    <h4>Category not found!!</h4>
                                </div>
                            @endforelse

                        </div>
                    </div>
                    <div class="sidebar-item widget_list widget_filter">
                        <h5 class="sidebar-item__title">Filter by Price</h5>

                        <form id="price-filter-form">
                            <div class="custom--range">
                                <div id="slider-range" class="custom--range__range"></div>
                                <div class="custom--range__content d-flex flex-wrap justify-content-betwwen">

                                    <input type="text" id="selected-price-range" class="custom--range__prices"
                                        id="amount" readonly />
                                    <!-- Hidden fields for real values -->
                                    <input type="hidden" id="filter-min-price" name="min_price">
                                    <input type="hidden" id="filter-max-price" name="max_price">
                                </div>
                            </div>
                        </form>

                    </div>



                    {{-- <div class="sidebar-item">
                        <h6 class="sidebar-item__title">Best Seller</h6>
                        <div>
                            <div class="seller-item">
                                <a href="product-two-details-2.html" class="seller-item__thumb">
                                    <img src="assets/images/thumbs/arrival-two02.png" alt="" />
                                </a>
                                <div class="seller-item__title">
                                    <a href="product-two-details-2.html" class="seller-item__link">Impulse
                                        Duffle</a>
                                    <h6 class="seller-item__price">
                                        $210 <span class="seller-item__price-new">$150</span>
                                    </h6>
                                </div>
                            </div>
                            <div class="seller-item">
                                <a href="product-two-details-2.html" class="seller-item__thumb">
                                    <img src="assets/images/thumbs/product/product08.png" alt="" />
                                </a>
                                <div class="seller-item__title">
                                    <a href="product-two-details-2.html" class="seller-item__link">
                                        Driven Backpack
                                    </a>
                                    <h6 class="seller-item__price">
                                        $210 <span class="seller-item__price-new">$150</span>
                                    </h6>
                                </div>
                            </div>
                            <div class="seller-item">
                                <a href="product-two-details-2.html" class="seller-item__thumb">
                                    <img src="assets/images/thumbs/tp04.png" alt="" />
                                </a>
                                <div class="seller-item__title">
                                    <a href="product-two-details-2.html" class="seller-item__link">
                                        Affirm cat food
                                    </a>
                                    <h6 class="seller-item__price">
                                        $210 <span class="seller-item__price-new">$150</span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="sidebar-item">
                        <h6 class="sidebar-item__title">Brand</h6>
                        @forelse ($brands as $brand)
                        <div class="form-check form--check">
                            <input class="form-check-input brand-checkbox" type="checkbox" value="{{ $brand->id }}" id="brand-{{ $brand->id }}" />
                            <label class="form-check-label" for="brand-{{ $category->id }}">
                                {{ $brand->brand_name }} ({{ $brand->products->count() }})
                            </label>
                        </div>
                        @empty
                        <div class="form-check form--check">
                            <h4>Brand not found!!</h4>
                        @endforelse

                    </div>

                </div>
            </div>
            <div class="col-lg-9">
                <div class="product-sidebar-filter d-lg-none d-block">
                    <button class="product-sidebar-filter__button">
                        <i class="las la-filter"></i>
                        <span class="text"> Filter </span>
                    </button>
                </div>
                <div id="product-list" class="row justify-content-center shop_wrapper product-list gy-4">

                    @forelse ($products as $product)
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xsm-6 mob-version-product">
                            <div class="product-item">
                                <div class="product-item__thumb">
                                    <a href="{{ route('product_single.page', $product->id) }}"
                                        class="product-item__thumb-link">
                                        <img src="{{ asset($product->thumbnail) }}" alt="" />
                                    </a>
                                    <button class="product-item__icon">
                                        <span class="product-item__icon-style">
                                            <i class="las la-heart"></i>
                                        </span>
                                    </button>
                                    <div class="product-item__badge">
                                        <span class="badge badge--base">Sale</span>
                                    </div>
                                </div>
                                <div class="product-item__content">
                                    <h5 class="product-item__title">
                                        <a href="{{ route('product_single.page', $product->id) }}"
                                            class="product-item__title-link">
                                            {{ $product->product_name }}
                                        </a>
                                    </h5>

                                    <h6 class="product-item__price">
                                        @if ($product->discount_price && $product->discount_type === 'flat')
                                            @php
                                                $product_discount_price =
                                                    $product->regular_price - $product->discount_price;
                                            @endphp
                                            <span
                                                class="product-item__price-new">৳{{ number_format($product_discount_price, 2) }}</span>
                                            <span
                                                class="text-decoration-line-through">৳{{ number_format($product->regular_price, 2) }}</span>
                                        @elseif ($product->discount_price && $product->discount_type === 'percent')
                                            @php
                                                $discount_amount =
                                                    ($product->regular_price * $product->discount_price) / 100;
                                                $product_discount_price = $product->regular_price - $discount_amount;
                                            @endphp
                                            <span
                                                class="product-item__price-new">৳{{ number_format($product_discount_price, 2) }}</span>
                                            <span
                                                class="text-decoration-line-through">৳{{ number_format($product->regular_price, 2) }}</span>
                                        @else
                                            <span
                                                class="">৳{{ number_format($product->regular_price, 2) }}</span>
                                        @endif
                                    </h6>
                                    <form class="add-to-cart-form">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="order_qty" value="1">
                                        <button type="submit" class="btn btn--base pill btn--sm btn-buy">
                                            Add to Cart
                                            <span class="spinner-border spinner-border-sm d-none"></span>
                                        </button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty

                        <h4>Product not found!!</h4>
                    @endforelse

                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#">01</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">02</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">03</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#"><i class="fas fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('submit', '.add-to-cart-form', function(e) {
                e.preventDefault();

                let form = $(this);
                let formData = form.serialize();

                let button = form.find('.btn-buy');
                let spinner = button.find('.spinner-border');

                button.prop('disabled', true);
                spinner.removeClass('d-none');

                $.ajax({
                    url: "{{ route('addToCart') }}",
                    method: "POST",
                    data: formData,
                    success: function(response) {
                        toastr.success(response.message, '', {
                            timeOut: 1500
                        });
                        $('#cart-count').text(response.cart_count);

                        // Optionally display the updated cart content if needed
                        console.log(response.cart_contents);

                        spinner.addClass('d-none');
                        button.prop('disabled', false);

                        $('#cart-count').text(response.itemCount);
                    },
                    error: function() {
                        toastr.error('Failed to add product.', '', {
                            timeOut: 2000
                        });
                        spinner.addClass('d-none');
                        button.prop('disabled', false);
                    }
                });
            });
        });
    </script>

    {{-- price filter script --}}
    <script>
        $(document).ready(function() {
            // Initialize price slider
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: 5000,
                values: [0, 5000],
                slide: function(event, ui) {
                    $("#selected-price-range").val('Tk. ' + ui.values[0] + ' - Tk. ' + ui.values[1]);
                    $("#filter-min-price").val(ui.values[0]);
                    $("#filter-max-price").val(ui.values[1]);
                },
                change: function(event, ui) {
                    // When user stops sliding, filter is triggered
                    filterProducts(ui.values[0], ui.values[1]);
                },
                create: function(event, ui) {
                    const values = $(this).slider("values");
                    $("#selected-price-range").val('Tk. ' + values[0] + ' - Tk. ' + values[1]);
                    $("#filter-min-price").val(values[0]);
                    $("#filter-max-price").val(values[1]);
                }
            });

            // Filter function extracted for reuse
            function filterProducts(min_price, max_price) {
                $.ajax({
                    url: "{{ route('website.price.filter') }}",
                    method: "GET",
                    data: {
                        min_price,
                        max_price
                    },
                    success: function(response) {
                        $('.shop_wrapper').html('').append(response);
                    },
                    error: function() {
                        toastr.error('Failed to filter products.', 'Error', {
                            timeOut: 1500,
                            positionClass: "toast-top-right"
                        });
                    }
                });
            }
        });


        // Product search by category

        $(document).on('change', '.category-checkbox', function () {
            let selectedCategories = [];

            $('.category-checkbox:checked').each(function () {
                selectedCategories.push($(this).val());
            });

            $.ajax({
                url: "{{ route('category_product.filter.multi') }}", // নিচে দেখো এই রুট
                type: "GET",
                data: {
                    category_ids: selectedCategories
                },
                success: function (response) {
                    $('#product-list').html(response.html); // এখানে প্রোডাক্ট বসবে
                },
                error: function () {
                    alert("কিছু ভুল হয়েছে!");
                }
            });
        });


        // Product search by brand

        $(document).on('change', '.brand-checkbox', function () {
            let selectedBrands = [];

            $('.brand-checkbox:checked').each(function () {
                selectedBrands.push($(this).val());
            });

            $.ajax({
                url: "{{ route('brand_product.filter.multi') }}", // নিচে দেখো এই রুট
                type: "GET",
                data: {
                    brand_ids: selectedBrands
                },
                success: function (response) {
                    $('.product-list').html(response.html); // এখানে প্রোডাক্ট বসবে
                },
                error: function () {
                    alert("কিছু ভুল হয়েছে!");
                }
            });
        });



    </script>
@endpush

@include('website.layouts.inc.footer')
