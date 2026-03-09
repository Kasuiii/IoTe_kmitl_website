<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReservableItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index()
    {
        $items = ReservableItem::withCount([
            'reservations as active_count' => fn($q) => $q->whereIn('status', ['approved', 'borrowed']),
        ])->orderBy('category')->orderBy('name')->get();

        return view('admin.items.index', compact('items'));
    }

    public function create()
    {
        return view('admin.items.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'            => 'required|string|max:255',
            'category'        => 'required|string|max:100',
            'description'     => 'nullable|string',
            'faculty_access'  => 'required|in:all,engineering,science',
            'quantity_total'  => 'required|integer|min:1',
            'max_borrow_days' => 'required|integer|min:1|max:30',
            'is_active'       => 'boolean',
            'image'           => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('items', 'public');
            $data['image_url'] = '/storage/' . $path;
        }

        $data['quantity_available'] = $data['quantity_total'];
        $data['is_active']          = $request->boolean('is_active', true);

        ReservableItem::create($data);

        // BUG FIX: route name is now 'admin.items.index' (matched by web.php prefix group)
        return redirect()->route('admin.items.index')->with('success', 'เพิ่มอุปกรณ์สำเร็จ!');
    }

    public function edit(ReservableItem $item)
    {
        return view('admin.items.form', compact('item'));
    }

    public function update(Request $request, ReservableItem $item)
    {
        $data = $request->validate([
            'name'            => 'required|string|max:255',
            'category'        => 'required|string|max:100',
            'description'     => 'nullable|string',
            'faculty_access'  => 'required|in:all,engineering,science',
            'quantity_total'  => 'required|integer|min:1',
            'max_borrow_days' => 'required|integer|min:1|max:30',
            'is_active'       => 'boolean',
            'image'           => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($item->image_url) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $item->image_url));
            }
            $path = $request->file('image')->store('items', 'public');
            $data['image_url'] = '/storage/' . $path;
        }

        $data['is_active'] = $request->boolean('is_active');
        $item->update($data);

        return redirect()->route('admin.items.index')->with('success', 'แก้ไขอุปกรณ์สำเร็จ!');
    }

    public function destroy(ReservableItem $item)
    {
        if ($item->image_url) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $item->image_url));
        }
        $item->delete();

        return redirect()->route('admin.items.index')->with('success', 'ลบอุปกรณ์สำเร็จ!');
    }
}
