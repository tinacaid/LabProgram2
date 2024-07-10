<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class students extends Model
{
    use HasFactory;

    // 定义表名
    protected $table = 'students';

    // 定义可以批量赋值的字段
    protected $fillable = [
        'account',
        'password',
        'grade',
        'major',
        'class',
        'name',
        'email'
    ];

    // 隐藏密码字段
    protected $hidden = [
        'password',
    ];

    // 修改器：在设置密码时自动进行哈希加密
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    // 验证凭证的静态方法
    public static function validateCredentials($account, $password)
    {
        try {
            // 查找用户
            $user = self::where('account', $account)->first();

            // 检查用户是否存在以及密码是否正确
            if ($user && Hash::check($password, $user->password)) {
                // 如果密码正确，返回 true
                return true;
            }

            // 如果用户不存在或密码不正确，返回 false
            return false;

        } catch (Exception $e) {
            // 处理异常，记录日志或返回错误信息
            // Log::error('Error validating credentials: ' . $e->getMessage());
            return false;
        }
    }
//使用模型工厂来创建模型实例

    public function getJWTIdentifier()
    {
        //getKey() 方法用于获取模型的主键值
        return $this->getKey();
    }
    public function getJWTCustomClaims(): array
    {
        return ["role" => "student"];////关于登录登出
    }

    public static function charu($dam)
    {
        try {
            $dm = students::where('name', $dam['name'])
                -> where('major',$dam['major'])
                -> where('class',$dam['class'])
                ->where('grade',$dam['grade'])
               // 明确指定列名
                ->first();
            return $dm;
        } catch (Exception $e) {
            return 'error' . $e->getMessage();
        }
    }
}
