<?php

namespace Refrigerator;

class Session
{
    public function __construct()
    {
    }

    public function setSessionTime(object $link, string $id, int $sessionTime): void
    {
        $sql = <<<EOT
        UPDATE users
        SET status = "login",
            sessionTime = "$sessionTime"
        WHERE id = "$id"
        EOT;
        $result = mysqli_query($link, $sql);
        if (!$result) {
            error_log('Error: fail to get user pass') . PHP_EOL;
            echo 'Debugging error:' . mysqli_error($link) . PHP_EOL;
        }
    }

    public function logout(object $link, string $id): void
    {
        $sql = <<<EOT
        UPDATE users
        SET status = "logout",
            sessionTime = 0
        WHERE id = "$id"
        EOT;
        $result = mysqli_query($link, $sql);
        if (!$result) {
            error_log('Error: fail to get user pass') . PHP_EOL;
            echo 'Debugging error:' . mysqli_error($link) . PHP_EOL;
        }
    }
}
