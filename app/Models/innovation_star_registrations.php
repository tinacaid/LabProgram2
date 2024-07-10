<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;//引用Authenticatable类使得DemoModel具有用户认证功能
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Exception;
use Carbon\Carbon;

class innovation_star_registrations extends Authenticatable implements JWTSubject
{//
    protected $table = "innovation_star_registrations";
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
        return ["role" => "innovation_star_registrations"];
    }
    public  static function zengtian($data)
    {
        try {
            $dat = DB::table('innovation_star_registrations')
                ->insert([
                    'grade' =>$data['grade'],
                    'major'=>$data['major'],
                    'class'=>$data['class'],
                    'name' =>$data['name'],
                    'entity_type'=>$data['entity_type'],//实体，虚体
                    'company_name'=>$data['company_name'],//公司名称
                    'registration_time'=>now(),//公司注册时间
                    'certificate'=>$data['certificate'],//证书链接
                    'applicant_ranking'=> 0,//申请人排名
                    'company_scale'=> 0,
                    'status'=> 0,//无关紧要的先设置为0
                    'rejection_reason'=> 0,
                    'student_id'=>$data['student_id'],
                    'created_at'=>now(),
                    'updated at'=>now(),
                ]);
            return $dat;
        } catch (Exception $e) {
            return 'error' . $e->getMessage();
        }
    }
    public  static function shuliang($data)
    {
        try {
            $tt=innovation_star_registrations::where('student_id', $data['student_id'])
                ->select(['student_id'])
                ->count();           // 明确指定列名
                return $tt;
        } catch (Exception $e) {

            return 'error' . $e->getMessage();
        }
    }
}
