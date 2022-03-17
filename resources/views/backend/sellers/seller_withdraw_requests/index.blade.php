@extends('backend.layouts.app')
@section('content')
<div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{ translate('Payout  history')}}</h5>
        </div>
          <div class="card-body">
              <table class="table aiz-table mb-0">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>{{ translate('Date') }}</th>
                          <th>{{ translate('Seller Name')}}</th>
                          <th>{{ translate('Amount')}}</th>
                          <th>{{ translate('Razorpay Payout Id')}}</th>
                          <th data-breakpoints="lg">{{ translate('Order Code')}}</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($seller_payout_histories as $key => $seller_payout_history)
                          <tr>
                              <td>{{ $key+1 }}</td>
                              <td>{{ date('d-m-Y', strtotime($seller_payout_history->created_at)) }}</td>
                              <td>
                                  @php
                                  $sell = \App\Models\Seller::where('user_id', $seller_payout_history->seller->id)->first();
                                  @endphp
                              <a href="#" onclick="show_seller_profile('{{$sell->id}}');"  class="dropdown-item">      
                                    {{ $seller_payout_history->seller->name }}
                                </a>
                              </td>
                              <td>{{ single_price($seller_payout_history->amount) }}</td>
                              <td>{{ $seller_payout_history->razorpay_payout_id }}</td>
                              <td>
                              <!-- <a href="#{{ $seller_payout_history->order->code }}" onclick="show_order_details({{ $seller_payout_history->order->id }})">
                              {{ $seller_payout_history->order->code }}
                              </a> -->
                              {{ $seller_payout_history->order->code }}
                              
                              
                              <!-- {{ $seller_payout_history->order->code }} -->
                              </td>
                             
                              
                          </tr>
                      @endforeach
                  </tbody>
              </table>
              <div class="aiz-pagination">
                  {{ $seller_payout_histories->links() }}
              </div>
          </div>
    </div>

@endsection

@section('modal')
<!-- payment Modal -->
<div class="modal fade" id="payment_modal">
  <div class="modal-dialog">
    <div class="modal-content" id="payment-modal-content">

    </div>
  </div>
</div>


<!-- Message View Modal -->
<div class="modal fade" id="message_modal">
  <div class="modal-dialog">
    <div class="modal-content" id="message-modal-content">

    </div>
  </div>
</div>

<!-- Delete Modal -->
@include('modals.delete_modal')

<!-- Seller Profile Modal -->
<div class="modal fade" id="profile_modal">
    <div class="modal-dialog">
        <div class="modal-content" id="profile-modal-content">

        </div>
    </div>
</div>

<!-- Seller Payment Modal -->
<div class="modal fade" id="payment_modal">
    <div class="modal-dialog">
        <div class="modal-content" id="payment-modal-content">

        </div>
    </div>
</div>

<!-- Ban Seller Modal -->
<div class="modal fade" id="confirm-ban">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h6">{{translate('Confirmation')}}</h5>
                <button type="button" class="close" data-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                    <p>{{translate('Do you really want to ban this seller?')}}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">{{translate('Cancel')}}</button>
                <a class="btn btn-primary" id="confirmation">{{translate('Proceed!')}}</a>
            </div>
        </div>
    </div>
</div>

<!-- Unban Seller Modal -->
<div class="modal fade" id="confirm-unban">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h6">{{translate('Confirmation')}}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                        <p>{{translate('Do you really want to ban this seller?')}}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">{{translate('Cancel')}}</button>
                    <a class="btn btn-primary" id="confirmationunban">{{translate('Proceed!')}}</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div id="order-details-modal-body-history">

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div id="order-details-modal-body-history">

                </div>
            </div>
        </div>
    </div>

@endsection


@section('script')
  <script type="text/javascript">
      function show_seller_profile(id){
            $.post('{{ route('sellers.profile_modal') }}',{_token:'{{ @csrf_token() }}', id:id}, function(data){
                $('#profile_modal #profile-modal-content').html(data);
                $('#profile_modal').modal('show', {backdrop: 'static'});
            });
        }

      function show_seller_payment_modal(id, seller_withdraw_request_id){
          $.post('{{ route('withdraw_request.payment_modal') }}',{_token:'{{ @csrf_token() }}', id:id, seller_withdraw_request_id:seller_withdraw_request_id}, function(data){
              $('#payment-modal-content').html(data);
              $('#payment_modal').modal('show', {backdrop: 'static'});
              $('.demo-select2-placeholder').select2();
          });
      }

      function show_message_modal(id){
          $.post('{{ route('withdraw_request.message_modal') }}',{_token:'{{ @csrf_token() }}', id:id}, function(data){
              $('#message-modal-content').html(data);
              $('#message_modal').modal('show', {backdrop: 'static'});
          });
      }

      function show_order_details(order_id)
        {
            $('#order-details-modal-body-history').html(null);

            if(!$('#modal-size').hasClass('modal-lg')){
                $('#modal-size').addClass('modal-lg');
            }

            $.post('{{ route('orders.details') }}', { _token : AIZ.data.csrf, order_id : order_id}, function(data){
                $('#order-details-modal-body-history').html(data);
                $('#order_details').modal();
                $('.c-preloader').hide();
                AIZ.plugins.bootstrapSelect('refresh');
            });
        }
  </script>

@endsection
