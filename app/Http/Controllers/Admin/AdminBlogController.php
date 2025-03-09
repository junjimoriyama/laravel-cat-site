<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\storeBlogRequest;
use App\Http\Requests\Admin\UpdateBlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminBlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest('updated_at')->simplePaginate(10);
        return view('admin.blogs.index', ['blogs' => $blogs]);
    }

    public function create()
    {
        return view('admin.blogs.create');
    }
    // バリデーションのstoreBlogRequestを引き継ぐ
    public function store(storeBlogRequest $request)
    {
        // storeの第二引数によりstorage/app/public/blogs/に保存され、public配下に置くことでweb上に画像を表示するためにアクセスができる
        $saveImagePath = $request->file('image')->store('blogs', 'public');
        // モデルを使えるようにする
        $blog = new Blog($request->validated());
        $blog->image = $saveImagePath;
        // ブログを保存実行
        $blog->save();

        // withは第一引数をkeyにしてテキストを渡す
        return to_route('admin.blogs.index')->with('success', 'ブログを投稿しました');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', ['blog' => $blog]);
    }

    public function update(UpdateBlogRequest $request, string $id)
    {
        // 指定されたidのブログをBlogモデルから取得、存在しなければ404ページ
        $blog = Blog::findOrFail($id);
        // 更新に使うすべてのデータ
        $updateData = $request->validated();
        // 画像ファイルを更新する場合
        if($request->has('image')) {
            // storage/app/publicにあるデータを探し、blogテーブルのimageカラムに保存されているパスのファイル削除
            Storage::disk('public')->delete($blog->image);
            //
            $updateData['image'] = $request->file('image')->store('blogs', 'public');
            // $path = $request->file('image')->store('blogs', 'public');
        }
        // 内容の更新
        $blog->update($updateData);
        // admin.blogs.indexへ遷移　セッションに更新成功のデータ渡す
        return to_route('admin.blogs.index')->with('success', '更新完了しました。');
    }

    public function destroy(string $id)
    {
        // 削除対象のブログを取得
        $blog = Blog::findOrFail();
        // 削除実行
        $blog->delete();
        // 画像の削除
        Storage::disk('public')->delete($blog->image);
        // トップ画面遷移
        return to_route('admin.blogs.index')->with("success", "削除しました。");
    }


}

// インスタンスメソッド (delete();) → new で作られたオブジェクトに対して実行
// クラスメソッド (destroy($id);) → インスタンスなしでクラスから直接実行

































// public function destroy(string $id)
// {
//     $blog = Blog::findOrFail($id);

//     $blog->delete();

//     Storage::disk('public')->delete($blog->image);

//     return to_route('admin.blogs.index')->with('success', '削除しました。');
// }
