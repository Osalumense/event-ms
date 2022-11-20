<?php

use Vinkla\Hashids\Facades\Hashids;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
/**
 * Get Decoded ID
 *
 * @param $encodedId
 *
 * @return int|null
 */
function getDecodedId($encodedId)
{
    $decodedArray = Hashids::decode($encodedId);
    $id = null;
    if ($decodedArray) {
        $id = $decodedArray[0];
    }
    return $id;
}


/**
 * Get Decoded ID
 *
 *
 * @return array
 */
function getCounsellors()
{
    $counsellors = User::where('type', '=', (string)\UserType::COUNSELLOR)
    ->orderBy('id', 'DESC')->get();

    return $counsellors;
}

function deleteFile($path)
{
    try {        
        if (File::exists($path)) {
            File::delete($path);
            return true;
        }
    } catch (\Exception $exception) {
        Log::error("Method :: deleteFile :: " . $exception->getMessage());
    }
    return false;
}