<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
   public function getProfileAll(){

    $data = Profile::get()->all();

    return response([
        'message' => "OK",
        'data' => $data,
    ], 200);
   }

   public function getProfileById($id){

    $data = Profile::where('id', "=", $id)->get()->first();

    return response([
        'message' => "OK",
        'data' => $data,
    ], 200);
   }

   public function createProfile(Request $req){

        $validator = Validator::make($req->all(),[
            "user_fname" => 'required|string',
            "user_lname" => 'required|string',
            "user_age" => 'required',
            "user_birthday" => 'required',
            "user_tel" => 'required',
            "user_email" => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'invalid params',
                'errorMessage' => $validator->errors()
            ], 422);
        }

        try{
            $creating = new Profile();
    
            $creating->first_name =     $req->user_fname;
            $creating->last_name =      $req->user_lname;
            $creating->age =            $req->user_age;
            $creating->birthday =       $req->user_birthday;
            $creating->tel =            $req->user_tel;
            $creating->email =          $req->user_email;
            $creating->save();

            return response([
            'message' => "success",
            'description' => 'Created successfully'
            ], 200);
        }
        catch (Exception $e){
            return response([
                'message' => "error",
                'description' => 'Can not created properly',
                'errorsMessage' => $e->getMessage()
            ], 501);
        }
    }
    public function updateProfile(Request $req, $id){
            $validator = Validator::make($req->all(),[
                "id" => 'required',
                "user_fname" => 'required|string',
                "user_lname" => 'required|string',
                "user_age" => 'required',
                "user_birthday" => 'required',
                "user_tel" => 'required',
                "user_email" => 'required|email',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'invalid params',
                    'errorMessage' => $validator->errors()
                ], 422);
            }

        try{
            $edit = Profile::where('id', $id)->update([
                "first_name" => $req->user_fname,
                "last_name" => $req->user_lname,
                "age" => $req->user_age,
                "birthday" => $req->user_birthday,
                "tel" => $req->user_tel,
                "email" => $req->user_email,
                "updated_at" => date("Y-m-d H:i:s")
            ]);

            return response([
                'message' => "success",
                'description' => 'Created successfully'
            ], 200);

        }catch (Exception $e){
            return response([
                'message' => 'error',
                'errorMessage' => $e->getMessage()
            ], 501);
        }
    }

    public function deleteProfile($id){
        try{
            $delete = Profile::where('id', $id)->delete();

            return response([
            'message' => "success",
            'description' => 'Deleted successfully'
            ], 200);
        }
        catch (Exception $e){
            return response([
                'message' => "error",
                'description' => 'Can not created properly',
                'errorsMessage' => $e->getMessage()
            ], 501);
        }
    }
}

   
