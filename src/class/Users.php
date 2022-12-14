<?php

namespace Refrigerator;

class Users
{
    public function __construct()
    {
    }

    public function checkOverlapId(object $link, string $id)
    {
        $sql = <<<EOT
        SELECT id
        FROM users
        WHERE id = "$id"
        EOT;
        $result = mysqli_query($link, $sql);
        if (!$result) {
            error_log('Error: fail to check user') . PHP_EOL;
            echo 'Debugging error:' . mysqli_error($link) . PHP_EOL;
        }
        if (mysqli_num_rows($result) === 1) {
            $error = '入力したユーザーIDは使用されています。';
            return $error;
        }
    }

    public function checkExistId(object $link, string $id): array
    {
        $errors = [];
        $sql = <<<EOT
        SELECT id
        FROM users
        WHERE id = "$id"
        EOT;
        $result = mysqli_query($link, $sql);
        if (!$result) {
            error_log('Error: fail to exist user') . PHP_EOL;
            echo 'Debugging error:' . mysqli_error($link) . PHP_EOL;
        }
        if (mysqli_num_rows($result) !== 1) {
            $errors['checkExistId'] = '入力したユーザーIDの登録情報が見つかりません。';
        }
        return $errors;
    }

    public function registerUser(object $link, string $id, string $mail, string $pass): void
    {
        $sql = <<<EOT
            INSERT INTO users (
                id,
                mail,
                password,
                status,
                sessionTime
            ) VALUES (
                "$id",
                "$mail",
                "$pass",
                "logout",
                0
            )
        EOT;
        $result = mysqli_query($link, $sql);
        if (!$result) {
            error_log('Error: fail to register user') . PHP_EOL;
            echo 'Debugging error:' . mysqli_error($link) . PHP_EOL;
        }
    }

    public function createRefrigeratorTable(object $link, string $id): void
    {
        $sql = <<<EOT
            CREATE TABLE $id (
                id INTEGER AUTO_INCREMENT NOT NULL PRIMARY KEY,
                name VARCHAR(50) NOT NULL,
                volume FLOAT NOT NULL,
                unit VARCHAR(10),
                parchase_date DATE,
                limit_date DATE,
                freezing VARCHAR(10)
            ) DEFAULT CHARACTER SET=utf8mb4;
        EOT;
        $result = mysqli_query($link, $sql);
        if (!$result) {
            error_log('Error: fail to create table') . PHP_EOL;
            echo 'Debugging error:' . mysqli_error($link) . PHP_EOL;
        }
    }

    public function checkMailAddress(object $link, string $id, string $mail): array
    {
        $errors = [];
        $sql = <<<EOT
        SELECT mail
        FROM users
        WHERE id = "$id"
        AND   mail = "$mail"
        EOT;
        $result = mysqli_query($link, $sql);
        if (!$result) {
            error_log('Error: fail to check mail address') . PHP_EOL;
            echo 'Debugging error:' . mysqli_error($link) . PHP_EOL;
        }
        if (mysqli_num_rows($result) !== 1) {
            $errors['checkMail'] = 'メールアドレスかユーザーIDに誤りがあります。';
        };
        return $errors;
    }

    public function checkUserLog(object $link, string $id): array
    {
        $errors = [];
        $sql = <<<EOT
        SELECT id
        FROM users
        WHERE id = "$id"
        AND status = "login"
        EOT;
        $result = mysqli_query($link, $sql);
        if (!$result) {
            error_log('Error: fail to check user') . PHP_EOL;
            echo 'Debugging error:' . mysqli_error($link) . PHP_EOL;
        }
        if (mysqli_num_rows($result) === 1) {
            $errors['checkUserLog'] = '入力されたユーザーIDはすでにログイン中です。';
        }
        return $errors;
    }

    public function getUserPass(object $link, string $id): array
    {
        $sql = <<<EOT
        SELECT password
        FROM users
        WHERE id = "$id"
        EOT;
        $result = mysqli_query($link, $sql);
        if (!$result) {
            error_log('Error: fail to get user pass') . PHP_EOL;
            echo 'Debugging error:' . mysqli_error($link) . PHP_EOL;
        }
        $hashPass = mysqli_fetch_assoc($result);
        return $hashPass;
    }

    public function resetUserPass(object $link, string $id, string $mail, string $pass): void
    {
        $sql = <<<EOT
            UPDATE users
            SET password = "$pass"
            WHERE id = "$id"
            AND mail = "$mail"
        EOT;
        $result = mysqli_query($link, $sql);
        if (!$result) {
            error_log('Error: fail to register user') . PHP_EOL;
            echo 'Debugging error:' . mysqli_error($link) . PHP_EOL;
        }
    }
}
