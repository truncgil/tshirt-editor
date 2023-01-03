<?php use App\Contents; 
$title = "Submit Now";
$description = "Submit Now";
$keywords = "submit, submit now, submission";

?>

@extends('layouts.app')

@section("title",$title)
@section("description",$description)
@section("keywords",$keywords)


@section('content')
<div class="container">
<div class="block text-align-center mt-5 mb-5">
    <div class="row">
        <div class="col-md-6 mx-auto" style="    border: solid 1px #cbcbcb;
    padding: 20px;
    border-radius: 5px;
  
">
            <h1>Reset Password</h1>
            <?php if(getisset("reset")) {
                $user = db("users")->where("email",post("mail"))->first();
               
                if($user) {
                    $password = rand(111111,999999);
                    db("users")->where("id",$user->id)
                    ->update(
                            [
                                'password' => Hash::make($password),
                                'recover' => $password
                            ]
                    );
                    $userArray = (array) $user;
                    $userArray['password'] = $password;
                    mailtemp($user->email,"Reset Password", $userArray);
                    yonlendir("submission?email={$_POST['mail']}&alert=Your new password has been sent to your e-mail address.");
                    
                } else {
                    bilgi("A user belonging to the e-mail address could not be found in the system.","danger");
                }

            } ?>
            <form action="?reset" method="post">
                <label for="">E-Mail: </label><input type="text" name="mail" id="" value="" class="form-control">
               @csrf
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary mt-2">Reset Password</button>

                        <div class="pull-right">
                            <a href="create">Create An Account</a><br><a href="submission">Login</a></div>
                    </div>
                </div>

            </form>
        </div>
       
    </div>
</div>
</div>
@endsection
