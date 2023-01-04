<?php

class Password
{
    public function passwordHash($senha)
    {
        return password_hash($senha, PASSWORD_DEFAULT);
    }
}
