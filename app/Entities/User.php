<?php
namespace App\Entities;

class User extends Entity
{
    protected $fillable = [
        "name",
        "pass",
    ];

    protected $validateRules = [
        'name' => 'required',
        'pass' => 'required|min:3',
        'confirm_pass' => 'required|same:pass',
    ];

    protected $validateMessages = [
        'name:required' => 'Имя пользователя обязательно',
        'pass:required' => 'Пароль обязателен',
        'pass:min' => 'Длинна пароля должна быть не менее 3-х символов',
        'confirm_pass:required' => 'Подтверждение обязательно',
        'confirm_pass:same' => 'Подтверждение не совпадает с паролем',
    ];
}
