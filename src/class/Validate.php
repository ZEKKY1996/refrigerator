<?php

namespace Refrigerator;

class Validate
{
    public function __construct()
    {
    }

    public function validateUserInfo(string $id, string $pass, string $mail, string $passConf): array
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

    public function validateLoginUserInfo(string $id, string $pass): array
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

    public function validateItemInfo(array $item): array
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
        $parchaseDate = explode('-', $item['parchase_date']);
        if (!strlen($item['parchase_date'])) {
            $errors['parchase_date'] = '購入日を入力してください。' . PHP_EOL;
        } elseif (count($parchaseDate) !== 3) {
            $errors['parchase_date'] = '購入日を正しい形式で入力してください。' . PHP_EOL;
        } elseif (!checkdate($parchaseDate[1], $parchaseDate[2], $parchaseDate[0])) {
            $errors['parchase_date'] = '購入日を正しい日付で入力してください。' . PHP_EOL;
        }
        $limitDate = explode('-', $item['limit_date']);
        if (!strlen($item['limit_date'])) {
            $errors['limit_date'] = '期限日を入力してください。' . PHP_EOL;
        } elseif (count($parchaseDate) !== 3) {
            $errors['parchase_date'] = '期限日を正しい形式で入力してください。' . PHP_EOL;
        } elseif (!checkdate($limitDate[1], $limitDate[2], $limitDate[0])) {
            $errors['limit_date'] = '期限日を正しい日付で入力してください。' . PHP_EOL;
        } elseif ($item['limit_date'] < $item['parchase_date']) {
            $errors['limit_date'] = '期限日は購入日以降の日付としてください。' . PHP_EOL;
        }
        return $errors;
    }

    public function validateVolume(float $itemVolume)
    {
        if ($itemVolume <= 0) {
            $errors = '数量は小数第1位までの正の数値で入力してください。' . PHP_EOL;
            return $errors;
        }
    }
}
