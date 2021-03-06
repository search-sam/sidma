<?php

class ClassroomController extends BaseController {

    public function inicio() {
        $classrooms = Classroom::all();
        return View::make('classroom.classroom')->with('classrooms', $classrooms);
    }
    
    
    public function NewOrEdit(){
        $input = Input::all();
        if(isset($input['cod_classroom'])){
          $classroom = Classroom::find($input['cod_classroom']) ; 
        }else{
           $classroom = new Classroom;  
           $classroom->create_date= date('y-m-d h:i:s');
        }         
        $classroom->classroom_name = $input['nombreaula'];
        $classroom->building = $input['edificio'];
        $classroom->capacity = $input['capacidad'];
        $classroom->description = $input['descripcion'];
        $classroom->save();
        $msg = 'Se ha registrado correctamente una nueva aula de clase al sistema :: <b>' . $classroom->classroom_name . '</b>';
        if (isset($input['cod_classroom'])) {
            $msg = 'Aula de clase <b>'.$classroom->classroom_name.'</b> :: Se han guardado correctamente los cambios realizados.';
        }
       return Redirect::action('AdmonacademicaController@inicio',array('#classrooms'))->with('message_classroom',$msg);

    }
    
    public function editar(){
        $input = Input::all();
         if(isset($input['cod_classroom'])){
             $classroom = Classroom::find($input['cod_classroom']);
            
         }else{
             $classroom = New Classroom;
         }
        return View::make('classroom.editar')->with('classroom', $classroom);
        
  
         //return Redirect::action('AdmonacademicaController@inicio');
    }
    
     public function borrarclase(){
        $input = Input::all();
        $classroom = Classroom::find($input["cod_classroom"]);
        $classroom->grupo->delete();
        
        $classroom->delete();
        return Redirect::action('AdmonacademicaController@inicio');
    }
    
    public function borrar(){
        $input = Input::all();
        $classroom = Classroom::find($input["current_classroom"]);
        return View::make('classroom.borrar')->with('classroom', $classroom);
           }

   

}
