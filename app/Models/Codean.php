<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Codean extends Model
{
    use HasFactory;

    protected $table = 'codeans';

    protected $fillable = [
        'id',
        'user_id',
        'code',
        'articles_id'
    ];

    static function GetCodeanId($request,$article_id): string
    {
        $codean = Codean::updateorCreate(
            ['user_id'=> $request->user_id,'code' => $request->codean],
            ['articles_id' => $article_id]
        );
        return $codean->id;
    }

    static function GetCodeanList($article_id)
    {
        return Codean::where('articles_id',$article_id)
                     ->select('codeans.code')
                     ->get();
    }
}
