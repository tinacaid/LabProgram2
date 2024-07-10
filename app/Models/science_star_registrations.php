<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;//引用Authenticatable类使得DemoModel具有用户认证功能
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Exception;
use Carbon\Carbon;

class science_star_registrations extends Authenticatable implements JWTSubject
{//
    protected $table = "science_star_registrations";
    public $timestamps = false;//时间戳
    protected $primaryKey = "id";
    protected $guarded = [];

    //不知道有什么用
    use HasFactory;

    //使用模型工厂来创建模型实例

    public function getJWTIdentifier()
    {
        //getKey() 方法用于获取模型的主键值
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return ['role => science_star_registrations'];
    }
    public  static function xiugai($data)
    {
            try {
                $dat = DB::table('science_star_registrations')
                    ->update([
                        'grade' =>$data['grade'],
                        'major'=>$data['major'],
                        'class'=>$data['class'],
                        'name' =>$data['name'],
                        'project_category'=>$data['project_category'],
                        'project_name'=>$data['Project_name'],
                        'approval_time'=>now(),
                        'certificate'=>$data['certificate'],
                        'rejection_reason'=>'0',
                        'status'=>'0',
                        'total_people'=>'0',
                        'ranking'=>'0',
                        'updated_at'=>now(),
                    ]);
                return $dat;
            } catch (Exception $e) {
                return 'error' . $e->getMessage();
            }
        }
}
