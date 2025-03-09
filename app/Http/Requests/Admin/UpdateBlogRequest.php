<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:255'],
            'image' => [
                'nullable',
                'file', // ファイルがアップロードされている
                'image', // 画像ファイルである
                'max:2000', // ファイル容量が2000kb以下である
                'mimes:jpeg,jpg,png', // 形式はjpegかpng
                'dimensions:min_width=300,min_height=300,max_width=1200,max_height=1200', // 画像の解像度が300px * 300px ~ 1200px * 1200px
            ],
            'body' => ['required', 'max:20000'],
        ];
    }
}










// public function update(UpdateBlogRequest $request, string $id)
// {
//     // 存在するidのブログを取得
//     $blog = Blog::findOrFail($id);
//     // 更新に使うすべてのデータ
//     $updateData = $request->validated();
//     // 画像ファイルを更新する場合
//     if ($request->has('imaga')) {
//         // storage/app/publicにあるデータを探し、blogテーブルのimageカラムに保存されているパスのファイル削除
//         Storage::disk('public')->delete($blog->image);
//     }
//     // 内容の更新
//     $blog->update($updateData);
//     // admin.blogs.indexへ遷移　セッションに更新成功のデータ渡す
//     return to_route('admin.blogs.index')->with('success', 'ブログを更新しました。');
// }
