<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Category;

class ProductFilter extends Component
{
    use WithPagination;

    public $categoryId = null;
    public $selectedCategory = null;
    public $categories = [];

    public function mount($categoryId = null)
    {
        $this->categories = Category::orderBy('name')->get();
        $this->selectedCategory = $categoryId;
    }

    public function selectCategory($catId)
    {
        $this->selectedCategory = $catId;
        $this->resetPage();
    }

    public function render()
    {
        $query = Product::query()->where('is_approved', 1);

        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }

        $products = $query->orderByDesc('id')->paginate(12);

        return view('livewire.product-filter', [
            'products' => $products,
            'categories' => $this->categories
        ]);
    }
}
