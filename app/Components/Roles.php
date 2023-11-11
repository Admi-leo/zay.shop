<?php

namespace App\Components;

final class Roles {
  const ADMIN = \Delight\Auth\Role::ADMIN;
  const MANAGER = 2;
  const USER = 1024;

  public static function getRoles()
  {
    $roles = [
      [
        'id' => self::ADMIN,
        'title' => 'Admin'
      ],
      [
        'id' => self::MANAGER,
        'title' => 'Manager'
      ],
      [
        'id' => self::USER,
        'title' => 'Client'
      ]
    ];
    if (!auth()->hasRole(Roles::ADMIN)) {
      unset($roles[0]);
      unset($roles[1]);
    }
    return $roles;
  }

  public static function getRole($key)
  {
    foreach (self::getRoles() as $role) {
      if ($role['id'] == $key) {
        return $role['title'];
      }
    }
  }

}


?>
