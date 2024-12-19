<?php
namespace App\Controllers;

use App\Models\User;
use App\Providers\View;
use App\Providers\Validator;

class AuthController {

    public function index(){
        LogController::logVisit("Login Page"); // Log the visit
        return View::render('login'); // Render login page
    }

    public function store($data){
        $validator = new Validator;
        $validator->field('username', $data['username'])->min(2)->max(50);
        $validator->field('password', $data['password'])->min(6)->max(20);

        if($validator->isSuccess()){
            $user = new User;
            $checkuser = $user->checkuser($data['username'], $data['password']);
            if($checkuser){
                return View::redirect('clients'); // Redirect if credentials are valid
            }else{
                $errors['message'] = "Please check your credentials"; // Set error message
                return View::render('login', ['errors'=>$errors, 'inputs'=>$data]);
            }
        }else{
            $errors = $validator->getErrors(); // Get validation errors
            return View::render('login', ['errors'=>$errors, 'inputs'=>$data]);
        }
    }

    public function delete(){
        session_destroy(); // End session
        return View::redirect('login'); // Redirect to login
    }
}
?>
