<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use Validator;

class DeviceController extends Controller
{
    //
    function list($id=null){
        return $id ? Device::find($id) : Device::all();
    }
    function add(Request $req){
        $rules = array('id_member'=>'required','name'=>'min:3');
        $validator= Validator::make($req->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->errors(),401);
        }
        else{
            $device = new Device;
            $device->name = $req->name;
            $device->id_member = $req->id_member;
            $result = $device->save();
            if($result){
                return ['msg'=>'Guardado con exito'];
            }
            else{
                return ['msg'=>'Error al guardar'];
            }
        }
        
    }
    function edit($id=null, Request $req){
        if($id){
            $device = Device::find($id);
            if($device){
                $device->name = $req->name;
                $device->id_member=$req->id_member;
                $result=$device->save();
                if($result){
                    return ['msg'=>'Dispositivo editado exitosamente']; 
                }
                else{
                    return ['msg'=>'Error al editar'];
                }
            }else{
                return ['msg'=>'Dispositivo no encuentrado'];
            }

        }else{
            return ['msg'=>'Por favor, ingrese un id'];
        }
        
        
    }
    function search($name=null){
        if($name){
            $device = Device::where('name','like',"%$name%")->get();
            return $device;
        }else{
            return ['msg'=>'Por favor ingrese un nombre'];
        }
    }
    function delete($id=null){
        if($id){
            $device = Device::find($id);
            if($device){
                $result=$device->delete();
                if($result){
                    return ['msg'=>'Dispositivo eliminado exitosamente'];
                }else{
                    return ['msg'=>'La operación de eliminar falló'];
                }
            }else{
                return ['msg'=>'No se encontró el dispositovo a eliminar '];
            }
        }else{
            return ['msg'=>'Por favor, ingrese un id'];
        }
        
       
    }
}
