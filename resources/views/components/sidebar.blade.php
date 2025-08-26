<div class="mn-sidebar-overlay"></div>
<div class="mn-sidebar">
    <div class="mn-sidebar-body">
        <button type="button" class="side-close" title="Close"></button>
        <ul class="mn-sb-list">
            @foreach($categories as $category)
                <li class="mn-sb-item sb-drop-item">
                    @if($category->children->count())
                        <a href="javascript:void(0)" class="mn-drop-toggle parent-toggle">
                            @if($category->icon_url)
                                <img src="{{ $category->icon_url }}" alt="{{ $category->name }}">
                            @else
                                <img src="/assets/img/icons/category.svg" alt="{{ $category->name }}">
                            @endif
                            <span class="condense">
                                {{ $category->name }}
                                <i class="drop-arrow ri-arrow-down-s-line"></i>
                            </span>
                        </a>
                        <ul class="mn-sb-drop" style="display:none;">
                            @foreach($category->children as $sub)
                                <li class="list">
                                    <a href="{{ route('website.products', ['category' => $sub->id]) }}" class="mn-page-link drop">
                                        @if($sub->icon_url)
                                            <img src="{{ $sub->icon_url }}" alt="{{ $sub->name }}" style="width:18px;height:18px;">
                                        @else
                                            <img src="/assets/img/icons/category.svg" alt="{{ $sub->name }}"
                                                style="width:18px;height:18px;">
                                        @endif
                                        {{ $sub->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <a href="{{ route('website.products', ['category' => $category->id]) }}" class="mn-drop-toggle">
                            @if($category->icon_url)
                                <img src="{{ $category->icon_url }}" alt="{{ $category->name }}">
                            @else
                                <img src="/assets/img/icons/category.svg" alt="{{ $category->name }}">
                            @endif
                            <span class="condense">{{ $category->name }}</span>
                        </a>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>