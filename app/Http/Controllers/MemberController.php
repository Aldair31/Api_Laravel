<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Validator;
class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Member::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $rules = array('name'=>'min:3');
        $validator= Validator::make($req->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->errors(),401);
        }
        else{
            $member = new Member;
            $member->name = $req->name;
            $result = $member->save();
            if($result){
                return ['msg'=>'Guardado con exito'];
            }
            else{
                return ['msg'=>'Error al guardar'];
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id=null)
    {
        if($id != null){
            $member=  Member::find($id) ;
            if($member){
                return $member;
            }else{
                return ['msg'=>'Miembro no encontrado'];
            }
        }
        else{
            return  ['msg'=>'Por favor, ingrese un id'];
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id=null)
    {
        if($id){
            $member = Member::find($id);
            if($member){
                $result= $member->delete();
                if($result){
                    return ["msg"=>"Se elimino correctamente"];
                }else{
                    return ["msg"=>"Error en la operación de eliminar"];
                }
            }
            else{
                return ["msg"=>"Miembro no encontrador"];
            }
        }else{
            return ["msg"=>"Por favor, ingrese un id"];
        }
    }
}
