<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use App\Models\FaqItem;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    // Categories
    public function categories()
    {
        $categories = FaqCategory::withCount('faqItems')->orderBy('sort_order')->get();
        return view('admin.faq.categories', compact('categories'));
    }

    public function createCategory()
    {
        return view('admin.faq.create-category');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);

        FaqCategory::create($request->all());

        return redirect()->route('admin.faq.categories')->with('success', 'Categorie succesvol aangemaakt!');
    }

    // FAQ Items
    public function items()
    {
        $items = FaqItem::with('category')->orderBy('faq_category_id')->orderBy('sort_order')->get();
        return view('admin.faq.items', compact('items'));
    }

    public function createItem()
    {
        $categories = FaqCategory::orderBy('name')->get();
        return view('admin.faq.create-item', compact('categories'));
    }

    public function storeItem(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'faq_category_id' => 'required|exists:faq_categories,id',
            'sort_order' => 'nullable|integer',
        ]);

        FaqItem::create($request->all());

        return redirect()->route('admin.faq.items')->with('success', 'FAQ item succesvol aangemaakt!');
    }
}
