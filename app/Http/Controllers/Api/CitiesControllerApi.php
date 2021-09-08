<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\City;
use Validator;
use App\Http\Controllers\Validations\CitiesControllerRequest;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [IT v 1.6.26]
// Copyright Reserved  [IT v 1.6.26]
class CitiesControllerApi extends Controller
{

            /**
             * Baboon Script By [IT v 1.6.26]
             * Display a listing of the resource. Api
             * @return \Illuminate\Http\Response
             */
            public function index()
            {
            	$City = City::orderBy('id','desc')->paginate(15);
               return response([
               "status"=>true,
               "statusCode"=>200,
               "data"=>$City
               ],200);
            }


            /**
             * Baboon Script By [IT v 1.6.26]
             * Store a newly created resource in storage. Api
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
    public function store(CitiesControllerRequest $request)
    {
    	$data = $request->except("_token");
    	
        $City = City::create($data); 

        return response([
            "status"=>true,
            "statusCode"=>200,
            "message"=>trans('admin.added'),
            "data"=>$City
        ],200);
    }

            /**
             * Display the specified resource.
             * Baboon Script By [IT v 1.6.26]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
                $City = City::find($id);
            	if(is_null($City) || empty($City)){
            	 return errorResponseJson([]);
            	}

                 return response([
              "status"=>true,
              "statusCode"=>200,
              "data"=> $City
              ],200);  ;
            }


            /**
             * Baboon Script By [IT v 1.6.26]
             * update a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function updateFillableColumns() {
				       $fillableCols = [];
				       foreach (array_keys((new CitiesControllerRequest)->attributes()) as $fillableUpdate) {
  				        if (!is_null(request($fillableUpdate))) {
						  $fillableCols[$fillableUpdate] = request($fillableUpdate);
						}
				       }
  				     return $fillableCols;
  	     		}

            public function update(CitiesControllerRequest $request,$id)
            {
            	$City = City::find($id);
            	if(is_null($City) || empty($City)){
            	 return errorResponseJson([]);
  			       }

            	$data = $this->updateFillableColumns();
                 
              City::where('id',$id)->update($data);

              return response([
               "status"=>true,
               "statusCode"=>200,
               "message"=>trans('admin.updated'),
               "data"=> $City
               ],200);
            }

            /**
             * Baboon Script By [IT v 1.6.26]
             * destroy a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $r
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
               $cities = City::find($id);
            	if(is_null($cities) || empty($cities)){
            	 return errorResponseJson([]);
            	}


               it()->delete('city',$id);

               $cities->delete();
               return response(["status"=>true,"statusCode"=>200,"message"=>trans('admin.deleted')],200);
            }



 			public function multi_delete()
            {
                $data = request('selected_data');
                if(is_array($data)){
                    foreach($data as $id)
                    {
                    $cities = City::find($id);
	            	if(is_null($cities) || empty($cities)){
	            	 return errorResponseJson([]);
	            	}

                    	it()->delete('city',$id);
                    	@$cities->delete();
                    }
                    return response(["status"=>true,"statusCode"=>200,"message"=>trans('admin.deleted')]);
                }else {
                    $cities = City::find($id);
	            	if(is_null($cities) || empty($cities)){
	            	 return errorResponseJson([]);
	            	}
 
                    	it()->delete('city',$data);

                    $cities->delete();
                    return response(["status"=>true,"statusCode"=>200,"message"=>trans('admin.deleted')],200);
                }
            }

            
}