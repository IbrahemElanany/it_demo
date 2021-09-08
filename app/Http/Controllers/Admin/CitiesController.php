<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\CitiesDataTable;
use Carbon\Carbon;
use App\Models\City;

use App\Http\Controllers\Validations\CitiesControllerRequest;
// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [IT v 1.6.26]
// Copyright Reserved  [IT v 1.6.26]
class CitiesController extends Controller
{

	public function __construct() {

		$this->middleware('AdminRole:citiescontroller_show', [
			'only' => ['index', 'show'],
		]);
		$this->middleware('AdminRole:citiescontroller_add', [
			'only' => ['create', 'store'],
		]);
		$this->middleware('AdminRole:citiescontroller_edit', [
			'only' => ['edit', 'update'],
		]);
		$this->middleware('AdminRole:citiescontroller_delete', [
			'only' => ['destroy', 'multi_delete'],
		]);
	}

	

            /**
             * Baboon Script By [IT v 1.6.26]
             * Display a listing of the resource.
             * @return \Illuminate\Http\Response
             */
            public function index(CitiesDataTable $cities)
            {
               return $cities->render('admin.cities.index',['title'=>trans('admin.cities')]);
            }


            /**
             * Baboon Script By [IT v 1.6.26]
             * Show the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
            	
               return view('admin.cities.create',['title'=>trans('admin.create')]);
            }

            /**
             * Baboon Script By [IT v 1.6.26]
             * Store a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response Or Redirect
             */
            public function store(CitiesControllerRequest $request)
            {
                $data = $request->except("_token", "_method");
            	                $cities = City::create($data); 
                $redirect = isset($request["add_back"])?"/create":"";
                return redirectWithSuccess(aurl('cities'.$redirect), trans('admin.added'));
            }

            /**
             * Display the specified resource.
             * Baboon Script By [IT v 1.6.26]
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
        		$cities =  City::find($id);
        		return is_null($cities) || empty($cities)?
        		backWithError(trans("admin.undefinedRecord"),aurl("cities")) :
        		view('admin.cities.show',[
				    'title'=>trans('admin.show'),
					'cities'=>$cities
        		]);
            }


            /**
             * Baboon Script By [IT v 1.6.26]
             * edit the form for creating a new resource.
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
        		$cities =  City::find($id);
        		return is_null($cities) || empty($cities)?
        		backWithError(trans("admin.undefinedRecord"),aurl("cities")) :
        		view('admin.cities.edit',[
				  'title'=>trans('admin.edit'),
				  'cities'=>$cities
        		]);
            }


            /**
             * Baboon Script By [IT v 1.6.26]
             * update a newly created resource in storage.
             * @param  \Illuminate\Http\Request  $request
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
              // Check Record Exists
              $cities =  City::find($id);
              if(is_null($cities) || empty($cities)){
              	return backWithError(trans("admin.undefinedRecord"),aurl("cities"));
              }
              $data = $this->updateFillableColumns(); 
              City::where('id',$id)->update($data);
              $redirect = isset($request["save_back"])?"/".$id."/edit":"";
              return redirectWithSuccess(aurl('cities'.$redirect), trans('admin.updated'));
            }

            /**
             * Baboon Script By [IT v 1.6.26]
             * destroy a newly created resource in storage.
             * @param  $id
             * @return \Illuminate\Http\Response
             */
	public function destroy($id){
		$cities = City::find($id);
		if(is_null($cities) || empty($cities)){
			return backWithSuccess(trans('admin.undefinedRecord'),aurl("cities"));
		}
               
		it()->delete('city',$id);
		$cities->delete();
		return redirectWithSuccess(aurl("cities"),trans('admin.deleted'));
	}


	public function multi_delete(){
		$data = request('selected_data');
		if(is_array($data)){
			foreach($data as $id){
				$cities = City::find($id);
				if(is_null($cities) || empty($cities)){
					return backWithError(trans('admin.undefinedRecord'),aurl("cities"));
				}
                    	
				it()->delete('city',$id);
				$cities->delete();
			}
			return redirectWithSuccess(aurl("cities"),trans('admin.deleted'));
		}else {
			$cities = City::find($data);
			if(is_null($cities) || empty($cities)){
				return backWithError(trans('admin.undefinedRecord'),aurl("cities"));
			}
                    
			it()->delete('city',$data);
			$cities->delete();
			return redirectWithSuccess(aurl("cities"),trans('admin.deleted'));
		}
	}
            

}