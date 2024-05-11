<?php

namespace App\Repositories;

use App\Models\User;

class RegisterRepository
{    
    /**
     * @param array $data
     *
     * @return User
     */
    public function registerUser(array $data)
    {
        return User::create($data);
    }
}