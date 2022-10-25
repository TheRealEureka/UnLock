<?php
namespace Unlock\Utils;

class CardResolver
{
    private static array $cards =  [
   "6" => [
        "image" => "6.png",
        "image_back" => "6_back.png",
        "links" => [
        "9"
        ]
    ],
    "8" => [
    "image" => "8.png",
    "image_back" => "8.png",
    "links" => [
    ]
    ],
    "9"=>[
    "image" => "9.png",
    "image_back" => "9_back.png",
    "links" => [
    ]
    ],
    "15" => [
    "image" => "15.png",
    "image_back" => "15_back.png",
    "links" => [
    ]
    ],
    "20"=>[
    "image" => "20.png",
    "image_back" => "20_back.png",
    "links" => [
    ]
    ],
    "22"=>[
    "image" => "22.png",
    "image_back" => "22_back.png",
    "links" => [
    "23"
    ]
    ],
    "23"=>[
    "image" => "23.png",
    "image_back" => "23_back.png",
    "links" => [
    "60"
    ]
    ],
    "24"=>[
    "image" => "24.png",
    "image_back" => "24_back.png",
    "links" => [
    "8"
    ]
    ],
    "28"=>[
    "image" => "28.png",
    "image_back" => "28_back.png",
    "links" => [
    ]
    ],
    "30"=>[
    "image" => "30.png",
    "image_back" => "30.png",
    "links" => [
    ]
    ],
   "37"=> [
    "image" => "37.png",
    "image_back" => "37_back.png",
    "links" => [
    ]
    ],
   "39"=> [
    "image" => "39.png",
    "image_back" => "39_back.png",
    "links" => [
    ]
    ],
    "42"=>[
    "image" => "42.png",
    "image_back" => "42_back.png",
    "links" => [
    ]
    ],
   "55"=> [
    "image" => "55.png",
    "image_back" => "55_back.png",
    "links" => [
    "91"
    ]
    ],
    "60"=>[
    "image" => "60.png",
    "image_back" => "60_back.png",
    "links" => [
    ]
    ],
   "66"=> [
    "image" => "66.png",
    "image_back" => "66.png",
    "links" => [
    ]
    ],
  "85"=>  [
    "image" => "85.png",
    "image_back" => "85_back.png",
    "links" => [
    "28"
    ]
    ],
 "88"=>   [
    "image" => "88.png",
    "image_back" => "88_back.png",
    "links" => [
    ]
    ],
    "P1" => [
    "image" => "p1.png",
    "image_back" => null,
    "links" => [
    "15",
    "55",
    "24",
    "15",
    "R111",
    "6",
    "H"
    ]
    ],
    "R" => [
    "image" => "R111.png",
    "image_back" => "R_back.png",
    "links" => [
    "20"
    ]
    ],
    "A" => [
    "image" => "A222.png",
    "image_back" => "A_back.png",
    "links" => [
    ]
    ],
    "INTRO" => [
    "image" => "intro.png",
    "image_back" => null,
    "links" => [
    ]
    ],
    "SECRET" => [
    "image" => "secret.png",
    "image_back" => null,
    "links" => [
    "66",
    "22",
    "85",
    "42"
    ]
    ],
    "B" => [
    "image" => "B.png",
    "image_back" => "B_back.png",
    "links" => [
    ]
    ],
    "H" => [
    "image" => "H.png",
    "image_back" => "H_back.png",
    "links" => [
    ]
    ]
    ];


    public static function getCard($id) : array
    {

        return self::$cards[$id];
    }

    public static function exist($id) : bool
    {
        return isset(self::$cards[$id]);
    }
}
