<?php

namespace App\Components;

final class Sex {
  const MALE = 1;
  const FEMALE = 2;

  public static function getSex()
  {
    return [
      [
        'id' => 0,
        'title' => 'Не установлен'
      ],
      [
        'id' => self::MALE,
        'title' => 'Мужчина'
      ],
      [
        'id' => self::FEMALE,
        'title' => 'Женщина'
      ]
    ];
  }

  public static function getSexItem($key)
  {
    foreach (self::getSex() as $sex) {
      if ($sex['id'] == $key) {
        return $sex['title'];
      }
    }
  }

}


?>
