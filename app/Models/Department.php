<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    /**
     * 
     * @var string
     * 
     */
    
    protected $table = 'departments';

    protected $fillable=[
        'id',
        'user_id',
        'code',
        'description'        
    ];

    static function InsertDepartment($request):void
    {
        Department::updateorCreate(
            ['user_id'=> $request->user_id,'code' => $request->codrep],
            ['description' => $request->desrep]
        );
    }

    static function GetDepartmentId($request){
        $department = Department::where('user_id',$request->user_id)
                                ->where('code',$request->codrep)
                                ->first();
        return $department <> null ? $department->id : '0';
    }
}
