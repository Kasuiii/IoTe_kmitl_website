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
            // Storage::url() respects your filesystems.php config (local OR S3/cloud)
            $data['image_url'] = Storage::url($path);
        }

        $data['quantity_available'] = $data['quantity_total'];
        $data['is_active']          = $request->boolean('is_active', true);

        ReservableItem::create($data);
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
            // Delete old image file if it exists
            if ($item->image_url) {
                $oldPath = ltrim(parse_url($item->image_url, PHP_URL_PATH), '/');
                $oldPath = preg_replace('#^storage/#', '', $oldPath);
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('image')->store('items', 'public');
            $data['image_url'] = Storage::url($path);
        }

        $data['is_active'] = $request->boolean('is_active');
        $item->update($data);

        return redirect()->route('admin.items.index')->with('success', 'แก้ไขอุปกรณ์สำเร็จ!');
    }

    public function destroy(ReservableItem $item)
    {
        if ($item->image_url) {
            $oldPath = ltrim(parse_url($item->image_url, PHP_URL_PATH), '/');
            $oldPath = preg_replace('#^storage/#', '', $oldPath);
            Storage::disk('public')->delete($oldPath);
        }
        $item->delete();

        return redirect()->route('admin.items.index')->with('success', 'ลบอุปกรณ์สำเร็จ!');
    }
}
