@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{'Hsn Information'}}</h5>
            </div>

            <form class="form-horizontal" action="{{ route('hsn.update',$hsn->id) }}" method="POST" enctype="multipart/form-data">
            	@csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="name">{{translate('Category')}}</label>
                        <div class="col-sm-9">
                            <select class="form-control aiz-selectpicker" name="category_id">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if($hsn->category_id == $category->id) selected @endif>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="name">{{translate('Name')}}</label>
                        <div class="col-sm-9">
                            <input type="text" value="{{$hsn->name}}" placeholder="{{translate('Name')}}" id="name" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="code">{{translate('Code')}}</label>
                        <div class="col-sm-9">
                            <input type="text" value="{{$hsn->code}}" placeholder="{{translate('Code')}}" id="code" name="code" class="form-control" required>
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
