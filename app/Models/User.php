<?php

// 名前空間の宣言
// このファイルの場所を示す
// このファイルの場所は、app/Models
// 別のファイルからこのファイルにあるクラスを使う時にパスを省略できる
namespace App\Models;

// Illuminate配下には、Laravelの機能が入っている(クラス、インターフェース、トレイト)
// トレイトは、特定の機能や振る舞いを複数のクラス間で共有するためにトレイトが使われる(デフォルトで準備されているデフォルトの拡張機能的な？)

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


// Authenticateは、認証機能を持ったクラス。ユーザー認証に関連するモデルのみに使用される
// 基本はModel
class User extends Authenticatable
{

    public $timestamps = false;

    protected $table = 'test_users';
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'age' => 'integer',
    ];
}
