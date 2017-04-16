<?php
session_start();


require_once '../libs/phpmailer/PHPMailerAutoload.php';



$errors =[];



if(isset($_POST['email'])){

    $fields = [

        'email' => $_POST['email']
    ];



    foreach ($fields as $field => $data) {

        if (empty($data)) {

            $errors[] = 'The '. $field .' field is required.';

        }

    }



    if (empty($errors)) {

        $m = new PHPMailer;



        $m->isSMTP();

        $m->SMTPAuth = true;



        $m->Host = 'smtp.gmail.com';

        $m->Username = 'bizarregamestudios@gmail.com';

        $m->Password = 'youdidthistoher';

        $m->SMTPSecure = 'ssl';

        $m->Port = 465;



        $m->isHTML();



        $m->Subject = 'Query!';

        $m->Body = '<p>Email: ' .$fields['email']. '</p>';



        $m->FromName = "Contact Form";



        $m->AddAddress('bizarregamestudios@gmail.com','Suryank Tiwari');



        if ($m->send()) {
            header('Location: ../index.html');

        }else{
            $errors[] = 'Sorry, could not send the email. Please try again later.';
            var_dump($errors);
            die();
        }

    }

}

else{

    $errors[] = "There's something wrong!";

}


header('Location: ../index.html');

?>