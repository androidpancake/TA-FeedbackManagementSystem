<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\AdditionalResponse;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.setting.index');
    }

    public function survey()
    {
        $additional = AdditionalResponse::all();
        return view('admin.setting.survey.survey', [
            'additional' => $additional
        ]);
    }

    public function category()
    {
        $category = Category::all();
        return view('admin.setting.category', [
            'category' => $category
        ]);
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.setting.edit', [
            'category' => $category
        ]);
    }

    public function update(CategoryRequest $request, $id)
    {
        $data = $request->all();
        
        if($request->hasFile('label')){
            $data['label'] = $request->file('label')->store(
                'category', 'public'
            );
        }

        $category = Category::findOrFail($id);
        $category->update($data);

        // dd($data);

        return redirect()->route('admin.setting.category');
    }

    public function delete($id)
    {
        $data = Category::findOrFail($id);

        $currentPhotoPath = $data->profile_photo;

        // Menghapus foto saat ini dari sistem penyimpanan
        if ($currentPhotoPath) {
            Storage::delete('public/category/' . $currentPhotoPath);
        }

        // Menghapus referensi foto dari model User
        $data->update([
            'label' => null
        ]);
       
        $data->delete();

        
        return redirect()->route('mahasiswa.feedback.index');
    }

}
