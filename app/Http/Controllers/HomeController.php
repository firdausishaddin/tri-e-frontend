<?php

namespace App\Http\Controllers;

use App\Traits\HttpClient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Str;

class HomeController extends Controller
{
    use HttpClient;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arr = [];
        
        for ($i = 1; $i <= $request->digit; $i++) {
            // char length too small to be unique
            $str = Str::random(6);
            
            $arr[] = ['unique_code' => $str];

            // if(!in_array($str, $arr)) {
            //     $arr[] = ['unique_code' => $str];
            // }
        }

        // $this->hasDupes($request, array_unique($arr, SORT_REGULAR));

        $response = $this->postClient(array_unique($arr, SORT_REGULAR));

        return $response->body();
    }

    public function hasDupes(Request $request, $arr)
    {
        $arrCnt = $request->digit-count($arr);
        
        if($arrCnt != 0) {
            for($i = 1; $i <= $arrCnt; $i++) {
                $str = Str::random(6);

                $arr[] = ['unique_code' => $str];                
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
