<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}


// =======================================================================================

// $arr = [];

// for ($i = 1; $i <= $request->digit; $i++) {
// // for ($i = 1; $i <= 4; $i++) {
//     $str = Str::random(6);

//     $arr[] = $str;
// }


// $clearArr = [];
// $object = new \stdClass();

// $result =  count($arr) === count(array_flip($arr)); //if true means x dek duplicate

// if ($result) {
//     foreach ($arr as $temp) {
//         $clearArr[] = ['unique_code' => $temp];
//     }
    
// } else {
//     $response = [
//         $object->success = false,
//         $object->message = "Duplicate Data On Generate Random",
//         $object->data = []
//     ];

//     return json_encode($object);
// }

// $response = $this->postClient($clearArr);
// return $response->body();

// public function this_answer_solution(array $input_array)
// {
//     return count($input_array) !== count(array_unique($input_array));
// }
