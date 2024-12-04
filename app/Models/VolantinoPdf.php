<?php

namespace App\Models;

use App\MyClass\MyLog;
use App\MyClass\Utility;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolantinoPdf extends Model
{
    use HasFactory;

    protected $table = 'volantinopdf';

    protected $fillable = [
        'id',        
        'attivo',
        'id_deposito',
        'nome',
        'path'
    ];

    static function GetList()
    {
        return VolantinoPdf::join('deposito','volantinopdf.id_deposito','=','deposito.id')
                            ->selectRaw('volantinopdf.nome,volantinopdf.id,deposito.descrizione as deposito,volantinopdf.path')
                            ->get();
    }

    static function GetListDeposito($id)
    {
        return VolantinoPdf::where('id_deposito',$id)->get();
    }

    static function VolantinoPDFInsert($data)
    {
        $result = [];
        try {
            $vol = VolantinoPdf::create([                    
                'nome' => $data->nome,  
                'id_deposito' => $data->id_deposito,
                'path' => ''
            ]);      
            if( $data->hasFile('path') ) {
                $vol->path = $data->file('path')->storeAs('pdf','volantino'.$vol->id.'.'.$data->path->extension());  
                $vol->save();
            }                                 
            $result['message'] = 'Volantino PDF Importato Correttamente';
            $result['error'] = 'false';             
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['error'] = 'true';
            MyLog::WriteLog($th->getMessage(),0);
        }
        return $result;
    }

    static function VolantinoPDFDelete($id)
    {
        $result = [];
        try {
            $vol = VolantinoPdf::where('id',$id)->first();
            Utility::DeleteIMG($vol->path);
            $vol->delete();
            $result['message'] = 'Volantino PDF Eliminato Correttamente';
            $result['error'] = 'false';             
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            $result['error'] = 'true';
            MyLog::WriteLog($th->getMessage(),0);
        }
        return $result;
    }

    static function Show($id)
    {
        return VolantinoPdf::where('id',$id)->first();
    }
}
