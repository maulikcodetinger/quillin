@extends('backend.layouts.app')
<style> 
option:checked {
  background: orange linear-gradient(0deg, orange 0%, orange 50%);
}
</style>
@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('Select Categories')}}</h5>
</div>
<div class="">
    <form class="form form-horizontal mar-top" action="{{route('hsn.next_step')}}" method="POST" enctype="multipart/form-data" id="choice_form">
        <div class="row gutters-5">
            <div class="col-lg-12">
                @csrf
                <input type="hidden" name="added_by" value="admin">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{translate('Select Category')}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row" id="category">
                            {{-- <label class="col-md-3 col-from-label">{{translate('Category')}} <span class="text-danger">*</span></label>
                            <div class="col-md-8"> --}}
                                <div id="cat_child" class="row p-5">
                                    <select class="col btn" name="category_id" id="cat-1" size="4">
                                        @foreach ($categories as $category)
                                            <option class=" " id="{{$category->id}}" value="{{$category->id}}" onclick="myFunction({{$category->id}})">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- <select class="form-control aiz-selectpicker" name="category_id" id="category_id" data-live-search="true" required>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->getTranslation('name') }}</option>
                                    @foreach ($category->childrenCategories as $childCategory)
                                    @include('categories.child_category', ['child_category' => $childCategory])
                                    @endforeach
                                    @endforeach
                                </select> --}}
                            {{-- </div> --}}
                        </div>
                       
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection

@section('script')

<script type="text/javascript">

    var j = 1;

    function deletechild(id)
    {
        var d = document.getElementById(id).nextElementSibling
        if(d != null)
        {
            d.remove();
            deletechild(id);
        } 
    }

    function myFunction($id)
    { 
        j++;
        var x = document.getElementById($id).parentElement.id;
        var d = document.getElementById(x).nextElementSibling
        deletechild(x);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
           type:"POST",
           url:'{{ route('select_child_category') }}',
           data: {
               id: $id
           },
           success: function(data) {
            if(data.length > 0)
            {
                var txt = '<select name="category_id" class="col btn" id="cat-'+j+'" size="4">';
                data.forEach(function(item){
                    txt += '<option class="" value="'+item['id']+'" id="'+item['id']+'" onclick="myFunction('+item['id']+')">'+ item['name'] +'</option>';
                })
                txt += '</select>';
                
                var ele = $("#cat_child");
                ele.append(txt);
            }
            // console.log(data.length);
           }
       });
    }

</script>

@endsection
