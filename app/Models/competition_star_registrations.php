<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Support\Facades\DB;

class competition_star_registrations extends Model
{
    use HasFactory;

    // 定义表名
    protected $table = 'competition_star_registrations';

    // 定义可以批量赋值的字段
    protected $fillable = [
        'student_id',
        'grade',
        'major',
        'class',
        'name',
        'competition_name',
        'registration_time',
    ];
    //使用模型工厂来创建模型实例

    public function getJWTIdentifier()
    {
        //getKey() 方法用于获取模型的主键值
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return ['role => competition_star_registrations'];
    }
    public  static function xiugai1($data)
    {
        try {
            $dat = DB::table('competition_star_registrations')
                ->update([
                    'grade' =>$data['grade'],
                    'major'=>$data['major'],
                    'class'=>$data['class'],
                    'name' =>$data['name'],
                    'project_category'=>$data['project_category'],
                    'approval_time'=>now(),//修改时间
                    'certificate'=>$data['certificate'],//证书链结
                    'status'=> 0,
                    'rejection_reason'=> 0,
                    'updated_at'=>now(),
                ]);
            return $dat;
        } catch (Exception $e) {
            return 'error' . $e->getMessage();
        }
    }
}
