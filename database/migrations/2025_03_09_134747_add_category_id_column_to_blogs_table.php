<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::table('blogs', function (Blueprint $table) {
    //         $table->foreignId('category_id')->after('id')->constrained();
    //     });
    // }

    // up()はマイグレーション適用時に実行される処理
    public function up(): void
    {
        // 既存テーブル変更メソッドでblogsテーブルに変更加えることを伝える
        Schema::table('blogs', function(Blueprint $table)
        {
            // blogs テーブルに category_id を追加
            // category_id は id の隣に配置
            // category_id は categories.id に紐づく外部キー
            $table->foreignId('category_id')->after('id')->costrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            //
        });
    }
};
