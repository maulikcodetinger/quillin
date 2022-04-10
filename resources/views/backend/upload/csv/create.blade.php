@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{'CSV Information'}}</h5>
            </div>

            <form class="form-horizontal" action="{{ route('csv.store') }}" method="POST" enctype="multipart/form-data">
            	@csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="name">{{translate('Category')}}</label>
                        <div class="col-sm-9">
                            <select class="form-control aiz-selectpicker" name="category_id" disabled>
                                    <option>{{$category->name}}</option>
                            </select>
                            <input type="hidden" name="category_id" value="{{$category->id}}">
                        </div>
                    </div>

                    {{-- <div class="form-group row">
                        <div class="col-md-3">
                            
                        </div>
                    </div> --}}

                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="file">{{translate('File')}}</label>
                        <div class="col-sm-9">
                            <input type="file" placeholder="{{translate('file')}}" id="file" name="file" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection
