<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Cache;
use App\Models\Category;

class Sidebar extends Component
{
    public $categories;

    public function __construct($categories = null)
    {
        // If not provided, load (and cache) them here
        $this->categories = $categories ?: Cache::remember('sidebar.categories', now()->addMinutes(30), function () {
            return Category::with([
                'children' => function ($q) {
                    $q->orderBy('name');
                }
            ])
                ->whereNull('parent_category_id')   // only top-level
                ->orderBy('name')
                ->get();
        });
    }

    public function render()
    {
        return view('components.sidebar');
    }
}