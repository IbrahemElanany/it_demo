@extends('admin.index')
@section('content')



<div class="card card-dark">
	<div class="card-header">
		<h3 class="card-title">
		<div class="">
			<a href="#">
			{{ !empty($title)?$title:'' }}
			</a>
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<span class="caret"></span>
			<span class="sr-only"></span>
			</a>
			<div class="dropdown-menu" role="menu">
				<a href="{{ aurl('cities') }}"  style="color:#343a40"  class="dropdown-item">
				<i class="fas fa-list"></i> {{ trans('admin.show_all') }}</a>
			</div>
		</div>
		</h3>
		<div class="card-tools">
			<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
			<button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
		</div>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
								
<form action="{{aurl('/cities')}}" enctype="multipart/form-data" class="form-horizontal form-row-seperated" method="post" id="cities">
<div class="row">
<input type="hidden" name="_token" value="{{csrf_token()}}">
<input type="hidden" name="_method" value="post">
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label for="name_ar" class=" control-label">{{trans('admin.name_ar')}}</label>
            <input type="text" id="name_ar" name="name_ar" value="{{old('name_ar')}}" class="form-control" placeholder="{{trans('admin.name_ar')}}" />
    </div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        <label for="name_en" class=" control-label">{{trans('admin.name_en')}}</label>
            <input type="text" id="name_en" name="name_en" value="{{old('name_en')}}" class="form-control" placeholder="{{trans('admin.name_en')}}" />
    </div>
</div>

</div>
		<!-- /.row -->
	</div>
	<!-- /.card-body -->
	<div class="card-footer"><button type="submit" name="add" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> {{ trans('admin.add') }}</button>
<button type="submit" name="add_back" class="btn btn-success btn-flat"><i class="fa fa-plus"></i> {{ trans('admin.add_back') }}</button>
</form>	</div>
</div>
@endsection