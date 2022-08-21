<?php

namespace Refrigerator;

class Validate
{
    public function __construct()
    {
    }

    public function validateUserInfo($id, $pass, $mail, $passConf)
    {
        $errors = [];

        if (!strlen($id)) {
            $errors['id'] = 'ユーザーIDを入力してください。' . PHP_EOL;
        } elseif (!preg_match('/^[a-zA-Z0-9]+$/', $id)) {
            $errors['id'] = 'ユーザーIDは半角英数字で入力してください。' . PHP_EOL;
        } elseif (strlen($id) > 20) {
            $errors['id'] = 'ユーザーIDは20文字以内で入力してください。' . PHP_EOL;
        }

        if (!strlen($mail)) {
            $errors['mail'] = 'メールアドレスを入力してください。' . PHP_EOL;
        } elseif (!preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $mail)) {
            $errors['mail'] = '正しいメールアドレスを入力してください。' . PHP_EOL;
        }

        if (!strlen($pass)) {
            $errors['pass'] = 'パスワードを入力してください。' . PHP_EOL;
        } elseif (!preg_match('/^(?=.+\d)(?=.*[A-Za-z])[0-9A-Za-z]{4,12}$/', $pass)) {
            $errors['pass'] = 'パスワードは1つ以上の数字とアルファベットをいれて4字～12字で入力してください。' . PHP_EOL;
        }

        if ($pass != $passConf) {
            $errors['pass_conf'] = '確認用パスワードに誤りがあります。' . PHP_EOL;
        }

        return $errors;
    }

    public function validateLoginUserInfo($id, $pass)
    {
        $errors = [];

        if (!strlen($id)) {
            $errors['id'] = 'ユーザーIDを入力してください。' . PHP_EOL;
        } elseif (!preg_match('/^[a-zA-Z0-9]+$/', $id)) {
            $errors['id'] = 'ユーザーIDは半角英数字で入力してください。' . PHP_EOL;
        } elseif (strlen($id) > 20) {
            $errors['id'] = 'ユーザーIDは20文字以内で入力してください。' . PHP_EOL;
        }

        if (!strlen($pass)) {
            $errors['pass'] = 'パスワードを入力してください。' . PHP_EOL;
        } elseif (!preg_match('/^(?=.+\d)(?=.*[A-Za-z])[0-9A-Za-z]{4,12}$/', $pass)) {
            $errors['pass'] = 'パスワードは1つ以上の数字とアルファベットをいれて4字～12字で入力してください。' . PHP_EOL;
        } elseif (strlen($pass) > 20) {
            $errors['pass'] = 'パスワードは20文字以内で入力してください。' . PHP_EOL;
        }
        return $errors;
    }

    public function validateItemInfo($item)
    {
        $errors = [];
        if (!strlen($item['name'])) {
            $errors['name'] = '品物名を入力してください。' . PHP_EOL;
        } elseif (strlen($item['name']) > 50) {
            $errors['name'] = '品物名は50文字以内で入力してください。' . PHP_EOL;
        }

        if (!strlen($item['volume'])) {
            $errors['volume'] = '数量を入力してください。' . PHP_EOL;
        } elseif (!is_float($item['volume']) | $item['volume'] == 0) {
            $errors['volume'] = '数量は小数第1位までの数値で入力してください。' . PHP_EOL;
        }
        if (!strlen($item['unit'])) {
            $errors['unit'] = '単位を入力してください。' . PHP_EOL;
        } elseif (strlen($item['unit']) > 10) {
            $errors['unit'] = '単位は10文字以内で入力してください。' . PHP_EOL;
        }
        $parchase_date = explode('-', $item['parchase_date']);
        if (!strlen($item['parchase_date'])) {
            $errors['parchase_date'] = '購入日を入力してください。' . PHP_EOL;
        } elseif (count($parchase_date) !== 3) {
            $errors['parchase_date'] = '購入日を正しい形式で入力してください。' . PHP_EOL;
        } elseif (!checkdate($parchase_date[1], $parchase_date[2], $parchase_date[0])) {
            $errors['parchase_date'] = '購入日を正しい日付で入力してください。' . PHP_EOL;
        }
        $limit_date = explode('-', $item['limit_date']);
        if (!strlen($item['limit_date'])) {
            $errors['limit_date'] = '期限日を入力してください。' . PHP_EOL;
        } elseif (count($parchase_date) !== 3) {
            $errors['parchase_date'] = '期限日を正しい形式で入力してください。' . PHP_EOL;
        } elseif (!checkdate($limit_date[1], $limit_date[2], $limit_date[0])) {
            $errors['limit_date'] = '期限日を正しい日付で入力してください。' . PHP_EOL;
        } elseif ($item['limit_date'] < $item['parchase_date']) {
            $errors['limit_date'] = '期限日は購入日以降の日付としてください。' . PHP_EOL;
        }
        return $errors;
    }

    public function validateVolume($itemVolume)
    {
        if ($itemVolume <= 0) {
            $errors = '数量は小数第1位までの正の数値で入力してください。' . PHP_EOL;
            return $errors;
        }
    }
}
