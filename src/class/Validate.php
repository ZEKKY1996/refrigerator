<?php

class Validate{
    public function __construct(){

    }
    public function validateUserInfo($id,$pass,$mail,$passConf){
        $errors = [];

    if(!strlen($id)){
        $errors['id'] = 'ユーザーIDを入力してください。'.PHP_EOL;
    }elseif(!preg_match('/^[a-zA-Z0-9]+$/',$id)){
        $errors['id'] = 'ユーザーIDは半角英数字で入力してください。'.PHP_EOL;
    }elseif(strlen($id)>20){
        $errors['id'] = 'ユーザーIDは20文字以内で入力してください。'.PHP_EOL;
    }

    if(!strlen($mail)){
        $errors['mail'] = 'メールアドレスを入力してください。'.PHP_EOL;
    }elseif(!preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/',$mail)){
        $errors['mail'] = '正しいメールアドレスを入力してください。'.PHP_EOL;
    }

    if(!strlen($pass)){
        $errors['pass'] = 'パスワードを入力してください。'.PHP_EOL;
    }elseif(!preg_match('/^(?=.+\d)(?=.*[A-Za-z])[0-9A-Za-z]{4,12}$/',$pass)){
        $errors['pass'] = 'パスワードは1つ以上の数字とアルファベットをいれて4字～12字で入力してください。'.PHP_EOL;
    }

    if($pass != $passConf){
        $errors['pass_conf'] = '確認用パスワードに誤りがあります。'.PHP_EOL;
    }

    return $errors;
    }
    public function validateLoginUserInfo($id,$pass){
        $errors = [];

        if(!strlen($id)){
            $errors['id'] = 'ユーザーIDを入力してください。'.PHP_EOL;
        }elseif(!preg_match('/^[a-zA-Z0-9]+$/',$id)){
            $errors['id'] = 'ユーザーIDは半角英数字で入力してください。'.PHP_EOL;
        }elseif(strlen($id)>20){
            $errors['id'] = 'ユーザーIDは20文字以内で入力してください。'.PHP_EOL;
        }

        if(!strlen($pass)){
            $errors['pass'] = 'パスワードを入力してください。'.PHP_EOL;
        }elseif(!preg_match('/^[a-zA-Z0-9]+$/',$pass)){
            $errors['pass'] = 'パスワードは半角英数字で入力してください。'.PHP_EOL;
        }elseif(strlen($pass)>20){
            $errors['pass'] = 'パスワードは20文字以内で入力してください。'.PHP_EOL;
        }

        return $errors;
    }
}
