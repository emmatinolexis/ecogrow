{{-- Product Filters Sidebar Component --}}
<div class="mn-sidebar-wrap">
    <form method="GET" action="{{ route('website.products') }}" id="filterForm">
        <!-- Category Filter -->
        <div class="mn-sidebar-block">
            <div class="mn-sb-title">
                <h3 class="mn-sidebar-title">Category</h3>
            </div>
            <div class="mn-sb-block-content">
                <div class="category-list">
                    <div class="mn-sidebar-block-item">
                        <input type="radio" name="category" value="" id="cat_all" onchange="this.form.submit()"
                            {{ !request('category') ? 'checked' : '' }}>
                        <label for="cat_all">All Categories</label>
                    </div>
                    @foreach($categories as $cat)
                    <div class="mn-sidebar-block-item ms-0">
                        <input type="radio" name="category" value="{{ $cat->id }}" id="cat_{{ $cat->id }}"
                            onchange="this.form.submit()" {{ request('category') == $cat->id ? 'checked' : '' }}>
                        <label for="cat_{{ $cat->id }}">{{ $cat->name }}</label>
                    </div>
                    @if(isset($cat->children) && $cat->children->count())
                    @foreach($cat->children as $subcat)
                    <div class="mn-sidebar-block-item ms-3">
                        <input type="radio" name="category" value="{{ $subcat->id }}" id="cat_{{ $subcat->id }}"
                            onchange="this.form.submit()" {{ request('category') == $subcat->id ? 'checked' : '' }}>
                        <label for="cat_{{ $subcat->id }}">&mdash; {{ $subcat->name }}</label>
                    </div>
                    @endforeach
                    @endif
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Price Filter -->
        <div class="mn-sidebar-block">
            <div class="mn-sb-title">
                <h3 class="mn-sidebar-title">Price</h3>
            </div>
            <div class="mn-sb-block-content mn-price-range-slider es-price-slider">
                <div class="mn-price-filter">
                    <div class="mn-price-input d-flex align-items-center">
                        <label class="filter__label me-2">
                            From <input type="number" name="price_min" class="filter__input"
                                value="{{ request('price_min') }}" min="0" style="width:70px;">
                        </label>
                        <span class="mn-price-divider mx-2">-</span>
                        <label class="filter__label">
                            To <input type="number" name="price_max" class="filter__input"
                                value="{{ request('price_max') }}" min="0" style="width:70px;">
                        </label>
                        <button type="submit" class="btn btn-sm btn-primary ms-2">Go</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <a href="{{ route('website.products') }}" class="btn btn-outline-secondary btn-sm w-100">Reset Filters</a>
        </div>
    </form>
</div>