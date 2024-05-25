<?php

namespace App\Utils;

use App\Models\User;
use Config;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


if (!function_exists('encryptParams')) {
    function encryptParams($params): array|string
    {
        if (is_array($params)) {
            $data = [];
            foreach ($params as $item) {
                $data[] = Crypt::encryptString($item);
            }

            return $data;
        }

        return Crypt::encryptString($params);
    }
}

if (!function_exists('decryptParams')) {
    function decryptParams($params): array|string
    {
        try {

            if (is_array($params)) {
                $data = [];
                foreach ($params as $item) {
                    $data[] = Crypt::decryptString($item);
                }

                return $data;
            }

            return Crypt::decryptString($params);
        } catch (DecryptException $e) {
            return $params;
        }
    }
}

// if (!function_exists('getExternalThumbPhoto')) {
//     function getExternalThumbPhoto($id)
//     {
//         $user = User::select('id')->find($id);
//         if ($user && isset($user->getMedia('stakeholder_image')[0])) {
//             $path = $user->getMedia('stakeholder_image')[0]->getPath('thumb');
//             if (File::exists($path)) {
//                 return $user->getMedia('stakeholder_image')[0]->getUrl('thumb');
//             } else {
//                 return null;
//             }
//         } else {
//             return null;
//         }
//     }
// }
