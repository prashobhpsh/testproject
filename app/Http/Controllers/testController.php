<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\encodedUrl;

class testController extends Controller
{
	/*********** List Shorten Url **********/
    public function index(){
    	$encodedUrl = encodedUrl::orderBy('created_at','DESC')->get();
    	return response(['encodedUrl'=>$encodedUrl]);
    }

    /************** Save Data **************/
    public function saveData(Request $request){
    	$validator = $this->_validator('create',$request);
    	if ($validator->passes()) {
    		$data = $request->all();
    		$randNo = rand(10000,99999);  
			$shorturl = base_convert($randNo,20,36);
			$encodedUrl = new encodedUrl();
			$encodedUrl->original_url = $data['input_url'];
			$encodedUrl->shorten_url = $this->_checkExist($shorturl);
			$encodedUrl->save();
			return response(['successfully Inserted'],200);
    	}
    	return response(['errors' => $validator->messages()],400);
    }

    /************ Redirect To URL ************/
    public function redirectfn($slug){
    	if($slug){
    		$encodedUrl = encodedUrl::whereShorten_url($slug)->first();
    		if($encodedUrl){
    			return redirect($encodedUrl->original_url);
    		}
    		return redirect()->back();
    	}
    	return redirect()->back();
    }

    /*********** Check Code already Used ***********/
    private function _checkExist($shorturl){
    	$i = 0;
        $url = $shorturl;
        do{
            if($i){
                $url = $url.$i;
            }
            $is_exist = encodedUrl::whereShorten_url($url)->count();
           $i++;
        }
        while($is_exist);
        return $url;
    }

    /************* Common Validator *************/
    private function _validator($type, Request $request) {
        if ($rules = $this->_rules($type)) {
            return Validator::make($request->all(), $rules);
        }
    }

    /*************** Common Rules **************/
    private function _rules($type) {
        $rules['create'] = array(
            'input_url' => 'required|unique:encoded_url,original_url',
        );
        return isset($rules[$type]) ? $rules[$type] : null;
    }
}
