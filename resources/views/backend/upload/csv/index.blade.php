@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col-md-6">
			<h1 class="h3">{{'All csvs'}}</h1>
		</div>
		<div class="col-md-6 text-md-right">
			<a href="{{ route('csv.create') }}" class="btn btn-circle btn-info">
				<span>{{'Add New csvs'}}</span>
			</a>
		</div>
	</div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{'csvs'}}</h5>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th data-breakpoints="lg" width="10%">#</th>
                    <th>{{translate('Name')}}</th>
                    <th data-breakpoints="lg">{{'File Name'}}</th>
                    <th width="10%">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($csvs as $key => $csv)
                        <tr>
                            <td>{{ ($key+1) + ($csvs->currentPage() - 1)*$csvs->perPage() }}</td>
                            <td>{{$csv->category_id}}</td>
                            <td>{{$csv->file}}</td>
                            <td class="text-right">
		                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('csv.edit', $csv->id)}}" title="{{ translate('Edit') }}">
		                                <i class="las la-edit"></i>
		                            </a>
		                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('csv.destroy', $csv->id)}}" title="{{ translate('Delete') }}">
		                                <i class="las la-trash"></i>
		                            </a>
		                        </td>
                        </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $csvs->appends(request()->input())->links() }}
        </div>
    </div>
</div>

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection
