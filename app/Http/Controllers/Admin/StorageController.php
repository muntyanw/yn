<?php
// app/Http/Controllers/StorageController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StorageController extends AdminBaseController
{
    public function index()
    {
        $directories = Storage::directories('public');
        $files = [];

        foreach ($directories as $directory) {
            $fileList = Storage::files($directory);
    
            // Сортировка по времени последней модификации
            usort($fileList, function ($a, $b) {
                return Storage::lastModified($b) - Storage::lastModified($a);
            });
    
            $files[$directory] = $fileList;
        }

        return view('admin.storage.index', compact('files'));
    }

    public function upload_images(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if (!Storage::exists('public/common')) {
            Storage::makeDirectory('public/common');
        }

        $path = $request->file('image')->store('public/common');

        return response()->json(['success' => true, 'path' => Storage::url($path)]);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'path' => 'required|string',
        ]);

        $path = str_replace('/storage/', 'public/', $request->path);

        if (Storage::exists($path)) {
            Storage::delete($path);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => __('File not found')]);
    }

    public function downloadImages(Request $request)
    {
        // Получаем строку URL-адресов
        $urlsString = $request->input('urls');

        // Разделяем строку на массив URL-адресов
        $urls = explode(',', $urlsString);

        $savedFiles = [];

        // Проходим по каждому URL-адресу
        foreach ($urls as $url) {
            $url = trim($url); // Удаляем пробелы в начале и в конце
            $contents = @file_get_contents($url); // Получаем содержимое файла
            if ($contents !== false) {
                $name = basename($url); // Получаем имя файла из URL
                $path = 'public/common/' . $name; // Указываем путь для сохранения
                Storage::put($path, $contents); // Сохраняем файл
                $savedFiles[] = $path; // Добавляем путь к сохраненному файлу в массив
            } else {
                // Если файл не удалось загрузить, возвращаем сообщение об ошибке
                return back()->with('status', __('Failed to download image: ') . $url);
            }
        }

        // Возвращаемся на предыдущую страницу с сообщением об успехе
        return back()->with('status', __('Images downloaded successfully'))->with('files', $savedFiles);
    }

    public function upload(Request $request) {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $path = $file->store('uploads', 'public');
    
            return response()->json([
                'url' => asset('storage/' . $path)
            ]);
        }
    
        return response()->json(['error' => 'No file uploaded.'], 400);
    }
}
