<?php

namespace App\Http\Controllers\Admin;

use App\Models\AddsPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AddsPageController extends Controller
{
    public function save(Request $request, AddsPage $addsPage = null)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string|max:255',
            'header_additions' => 'nullable|string',
            'body_additions' => 'nullable|string',
            'script_additions' => 'nullable|string',
            'enabled' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->only(['description', 'header_additions', 'body_additions', 'script_additions', 'enabled']);

        if ($addsPage) {
            $addsPage->update($data);
            $message = 'Добавление обновлено успешно';
        } else {
            AddsPage::create($data);
            $message = 'Добавление создано успешно';
        }

        return response()->json(['message' => $message]);
    }

    public function index()
    {
        $addsPages = AddsPage::all(); // Можно также фильтровать по enabled, если нужно
        return view('admin.adds.index', compact('addsPages'));
    }

    public function createOrEdit(AddsPage $addsPage = null)
    {
        return view('admin.adds.save', compact('addsPage'));
    }

    public function destroy($id)
    {
        // Находим запись по идентификатору
        $addsPage = AddsPage::findOrFail($id);

        // Удаляем запись
        $addsPage->delete();

        // Перенаправляем с сообщением об успешном удалении
        return redirect()->route('adds_pages_index')
            ->with('success', 'Добавление успешно удалено');
    }
}
