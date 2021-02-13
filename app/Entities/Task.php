<?php

namespace App\Entities;

class Task extends Entity
{
    protected $fillable = [
        "user_name",
        "user_email",
        "content",
        "state",
        "updated_by",
    ];

    protected $casts = [
        "state" => "boolean",
    ];


    protected $validateRules = [
        'user_name' => 'required',
        'user_email' => 'required|email',
        'content' => 'required',
    ];

    protected $validateMessages = [
        'user_name:required' => 'Имя исполнителя обязательно',
        'user_email:required' => 'E-mail исполнителя обязателен',
        'user_email:email' => 'E-mail исполнителя должен быть корректен',
        'content:required' => 'Описание задания обязательно',
    ];
}
