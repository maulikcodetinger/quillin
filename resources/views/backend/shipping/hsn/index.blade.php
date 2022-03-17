@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col-md-6">
			<h1 class="h3">{{'All hsns'}}</h1>
		</div>
		<div class="col-md-6 text-md-right">
			<a href="{{ route('hsn.create') }}" class="btn btn-circle btn-info">
				<span>{{'Add New hsns'}}</span>
			</a>
		</div>
	</div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{'hsns'}}</h5>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th data-breakpoints="lg" width="10%">#</th>
                    <th>{{translate('Name')}}</th>
                    <th data-breakpoints="lg">{{translate('Code')}}</th>
                    <th width="10%">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($hsns as $key => $hsn)
                        <tr>
                            <td>{{ ($key+1) + ($hsns->currentPage() - 1)*$hsns->perPage() }}</td>
                            <td>{{$hsn->name}}</td>
                            <td>{{$hsn->code}}</td>
                            <td class="text-right">
		                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('hsn.edit', $hsn->id)}}" title="{{ translate('Edit') }}">
		                                <i class="las la-edit"></i>
		                            </a>
		                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('hsn.destroy', $hsn->id)}}" title="{{ translate('Delete') }}">
		                                <i class="las la-trash"></i>
		                            </a>
		                        </td>
                        </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $hsns->appends(request()->input())->links() }}
        </div>
    </div>
</div>

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection
