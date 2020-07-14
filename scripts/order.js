var tempOrder = null;
var isIdleOrderRequest = true; //decision for changing order status request
$(document).ready(function(){
  requestOrdersList();
  is_request = false;
});
$(document).on('click', '.order-view-btn-js', function(){
  parent = $(this).parent().parent();
  var id = $(this).data('id');
  requestOrderVoucher(id);

  if($('.noti-js', parent).is(':visible'))
    $('.noti-js', parent).hide();

  $('.order-detail-js').addClass('detail-ani');
})

$(document).on('click', '.order-detail-cancel-btn-js', function(){
  $('.order-detail-js').removeClass('detail-ani');
})

$(document).on('click', '.edit-order-js', function(){
  if(!($('.order-form-wrap-js').length))
    $(buildOrderForm(true)).appendTo('.wp-order-detail-container');
    $(".order-form-js").validate({
      rules: {
        product_link: {
          required: true,
          url: true
        },
        quantity: {
          required: true,
          number: true
        },
        price: {
          required: true,
          number: true
        }
      }
    });
  $('.order-info, .hk-order-voucher, .order-detail-cancel-btn-js').addClass('blur');
})

$(document).on('click', '.order-form-back', function(){
  $('.order-form-wrap-js').remove();
  $('.order-info, .hk-order-voucher, .order-detail-cancel-btn-js').removeClass('blur');
})

$(document).on('click', '.order-confirm-btn-js', function(){
  if(isIdleOrderRequest){
    if(is_confirm){
      var id = $(this).data('id');
      updateOrderStatus(id, 2);
      is_confirm = false;
    }
    else{
      tbsConfirmBox($(this), 'This action will <em>confirm</em> this order. Do you really want to do?');
    }
  }
  else{
    tbsAlertBox('A Process is running in background. Wait a moment...');
  }
});

$(document).on('click', '.order-cancel-btn-js', function(){
  if(isIdleOrderRequest){
    if(is_confirm){
      var id = $(this).data('id');
      updateOrderStatus(id, 8);
      is_confirm = false;
    }
    else{
      tbsConfirmBox($(this), 'This action will <em>cancel</em> this order. Do you really want to do?');
    }
  }
  else{
    tbsAlertBox('A Process is running in background. Wait a moment...');
  }
});

function requestOrdersList()
{
  $.ajax({
    url: PAGE_URL+'/order/get_orders_list/',
    method: "GET",
    success: function(orders){
      if(Array.isArray(orders) && orders.length)
      {
        for(order of orders)
          $(buildOrdersList(order)).appendTo('.orders-list-js');
        requestUpdateOrdersList();

        setInterval(function(){
          requestUpdateOrdersList();
        }, 60000)
      }
      else{
        $('<div class="hk-empty-list">Empty Order List</div>').prependTo('.order-wrap-js');
        $('.orders-list-js').remove();
        $('.order-detail-js').remove();
        $('.hk-empty-order-detail').remove();
      }
    },
    dataType: 'json'
  });
}

function requestOrderVoucher(id)
{
  $.ajax({
    url: PAGE_URL+'/order/get_order_voucher/'+id,
    method: "GET",
    success: function(order){
      if(typeof(order) === 'object')
      {
        $('.order-detail-js').html(buildOrderVoucher(order)).addClass('detail-ani');
        tempOrder = order;
      }
    },
    dataType: 'json'
  });
}

function requestUpdateOrdersList()
{
  $.ajax({
    url: PAGE_URL+'/order/get_update_orders_list/',
    method: "GET",
    success: function(orders){
      if(Array.isArray(orders))
        for(order of orders)
        {
          var list = '#order-' + order.id + '-js';
          $(list).prependTo('.orders-list-js');
          if(!$('.noti-js', list).is(':visible'))
            $('.noti-js', list).show();
          $('.order-status-js', list).remove();
          if(($('.order-complete-amount-js').length))
            $('.order-complete-amount-js', list).remove();
          $('.order-status-wrap', list).append(checkOrderStatus(order));
        }
    },
    dataType: 'json'
  });
}

function buildOrdersList(order)
{
  var list = '';
  list += '<li id="order-' + order.id + '-js" class="hk-order-list">';
  list += '<span class="noti-js"><i class="fa fa-exclamation-circle"></i></span>';
  list += '<div class="product-link-js"><a href="' + order.product_link + '" target="_blank">Product link</a></div>';
  list += '<div class="order-status-wrap">'+ checkOrderStatus(order) +'</div>';
  list += '<div class="wp-order-date-and-detail"><div class="hk-order-date">' + order.date + '</div>';
  list += '<button type="button" class="order-view-btn-js" data-id="' + order.id + '">View</button></div>';
  list += '</li>';
  return list;
}

function buildOrderVoucher(order)
{
  var voucher = '';
  voucher += '<button class="order-detail-cancel-btn-js"><i class="fas fa-arrow-left"></i>Back to orders</button><div class="wp-order-detail-container"><div class="order-info"><div class="wp-order-info-header">';
  voucher += checkOrderStatus(order);
  voucher += (Number(order.status) < 2) ? '<button class="edit-order-js" title="Edit order"><i class="fas fa-pencil-alt"></i>Edit order</button>' : '';
  voucher += '</div><div class="wp-order-details">'
  voucher += '<div class=""><span class="hk-label">Order no:</span> <span>' + order.order_number + '</span></div>';
  voucher += '<div class=""><span class="hk-label">Product Cupon Code:</span> <span>' + order.cupon_code + '</span></div>';
  voucher += '<div class="hk-remark"><span class="hk-label">Remark:</span> <span>' + order.remark + '</span></div></div>';
  voucher += '<div class="hk-order-date">' + order.date + '</div>';
  voucher += '</div>';

  voucher += '<div class="hk-order-voucher">';
  voucher += '<table class="hk-first-payment-tb">';
  voucher += '<thead><tr>';
  voucher += '<th>Description</th> <th>Quantity</th> <th>Total&nbsp;Price</th>';
  voucher += '</tr></thead>';
  voucher += '<tbody><tr>';
  voucher += '<td><span class="product-link-js"><a href="' + order.product_link + '" target="_blank">Product Link</a></span></td> <td>[' + order.qty + ']</td> <td>$&nbsp;' + order.product_total_price + '</td>';
  voucher += '</tr>';
  voucher += '<tr>';
  voucher += '<td>US Tax</td> <td>&nbsp;</td> <td>$&nbsp;' + order.us_tax + '</td>';
  voucher += '</tr>';
  voucher += '<tr>';
  voucher += '<td>Shipping Cost</td> <td>&nbsp;</td> <td>$&nbsp;' + order.shipping_cost + '</td>';
  voucher += '</tr></tbody>';
  voucher += '<tfoot><tr>';
  voucher += '<td>First Payment</td> <td>&nbsp;</td> <td>$&nbsp;' + order.first_payment_dollar + '</td>';
  voucher += '</tr>';
  voucher += '<tr>';
  voucher += '<td>&nbsp;</td> <td>';
  voucher += (Number(order.status) > 1) ? 'Paid' : '&nbsp;';
  voucher += '</td> <td class="payment-total">MMK&nbsp;' + order.first_payment_mmk + '</td>';
  voucher += '</tr></tfoot>';
  voucher += '</table>';

  voucher += '<table class="hk-second-payment-tb">';
  voucher += '<tbody><tr>';
  voucher += '<td>Commission</td> <td>[' + order.commission_rate + '&nbsp%]</td> <td>$&nbsp;' + order.commission_amount + '</td>';
  voucher += '</tr>';
  voucher += '<tr>';
  voucher += '<td>Weight</td> <td>[' + order.weight + '&nbsp;lb]</td> <td>$&nbsp;' + order.total_weight_cost + '</td>';
  voucher += '</tr>';
  voucher += '<tr>';
  voucher += '<td>MM Tax</td> <td>';
  voucher += ((Number(order.mm_tax)) == 0) ? 'Free' : '[' + order.mm_tax + '&nbsp;%]';
  voucher += '</td> <td>$&nbsp;' + order.mm_tax_amount + '</td>';
  voucher += '</tr></tbody>';
  voucher += '<tfoot><tr>';
  voucher += '<td>Second Payment</td> <td>&nbsp;</td> <td>$&nbsp;' + order.second_payment_dollar + '</td>';
  voucher += '</tr>';
  voucher += '<tr>';
  voucher += '<td>&nbsp;</td> <td>';
  voucher += (Number(order.status) > 3) ? 'Paid' : '&nbsp;';
  voucher += '</td> <td class="payment-total">MMK&nbsp;' + order.second_payment_mmk + '</td>';
  voucher += '</tr></tfoot>';
  voucher += '</table>';

  voucher += '<table class="hk-third-payment-tb">';
  voucher += '<tbody><tr>';
  voucher += '<td>Delivery Fee</td> <td>';
  voucher += (Number(order.status) == 7) ? 'Paid' : '&nbsp;';
  voucher += '</td> <td class="payment-total">MMK&nbsp;' + order.delivery_fee + '</td>';
  voucher += '</tr></tbody>';
  voucher += '</table>';

  voucher += '<div class="voucher-btn-gp">';
  voucher += (Number(order.status) < 2) ? '<button type="button" class="order-cancel-btn-js" data-id="'+ order.id + '">Cancel Order</button>' : '';
  voucher += (Number(order.status) == 1) ? '<button type="button" class="order-confirm-btn-js" data-id="'+ order.id + '">Confirm Order</button>' : '';
  voucher += '</div>';
  voucher += '</div></div>'
  return voucher;
}

function buildOrderForm(is_edit)
{
  var form = '';
  if(is_edit){
    form += '<div class="order-form-wrap-js"><div class="order-form-back"></div>';
    form += '<div class="hk-order-inner-form-wrap">';
    form += '<div class="wp-new-order-header"><h2>Update Order</h2><i class="fas fa-shapes"></i></div>';
    form += '<form class="order-form-js" action="' + PAGE_URL + '/order/update_order/" method="post">';
    form += '<input type="hidden" name="id" value="' + tempOrder.id + '">';
    form += '<div class="new-order-input new-order-textarea"><i class="fas fa-link"></i>';
    form += '<textarea name="product_link" placeholder="Product Link">' + tempOrder.product_link + '</textarea>';
    form += '<span>Product Link</span></div>';
    form += '<div class="new-order-input"><i class="fas fa-shapes"></i>';
    form += '<input type="number" name="quantity" placeholder="Quantity" value="' + tempOrder.qty + '">';
    form += '<span>Quantity</span></div>';
    form += '<div class="new-order-input"><i class="fas fa-money-bill-alt"></i>';
    form += '<input type="text" name="cupon_code" placeholder="Cupon_code" value="' + tempOrder.cupon_code + '">';
    form += '<span>Coupon code</span></div>';
    form += '<div class="new-order-input new-order-textarea"><i class="fas fa-pencil-alt"></i>';
    form += '<textarea name="remark" placeholder="Remark">' + tempOrder.remark + '</textarea>';
    form += '<span>Remark</span></div>';
    form += '<div class="new-order-input"><i class="fas fa-hand-holding-usd"></i>';
    form += '<input type="text" name="price" placeholder="Unit Price ($)" value="' + tempOrder.product_price + '">';
    form += '<span>Unit Price ($)</span></div>';
    form += '<input type="submit" value="UPDATE">';
    form += '</form></div>';
    form += '</div>';
  }
  return form;
}

function checkOrderStatus(order)
{
  var list = '';
  switch(order.status)
  {
    case '0':
      list += '<div class="order-status-js request-order">Request</div>';
      break;
    case '1':
      list += '<div class="order-status-js pending-order">Pending</div>';
      break;
    case '2':
      list += '<div class="order-status-js confirm-order">Confirm</div>';
      break;
    case '3':
      list += '<div class="order-status-js stusw-order"><i class="fas fa-shipping-fast"></i>Shipping To US warehouse</div>';
      break;
    case '4':
      list += '<div class="order-status-js atusw-order"><i class="fas fa-shipping-fast"></i>Arrived at US warehouse</div>';
      break;
    case '5':
      list += '<div class="order-status-js stmm-order"><i class="fas fa-plane-departure"></i>Shipping To Myanmar</div>';
      break;
    case '6':
      list += '<div class="order-status-js atmm-order"><i class="fas fa-plane-arrival"></i>Arrived at Myanmar</div>';
      break;
    case '7':
      list += '<div class="order-status-js complete-order"><i class="fas fa-check-circle"></i>Complete</div>';
      list += '<div class="order-complete-amount-js">' + order.amount + '<span>&nbsp;MMK<span></div>';
      break;
    case '8':
      list += '<div class="order-status-js cancel-order">Cancel</div>';
      break;
  }
  return list;
}

function updateOrderStatus(id, status)
{
  isIdleOrderRequest = false;
  $.ajax({
    url: PAGE_URL+'/order/update_order_status/',
    method: "POST",
    data: {id: id, order_status: status},
    success: function(msg){
      if(msg == 'success')
      {
        requestUpdateOrdersList();
        requestOrderVoucher(id);
      }
      else if(msg == 'insufficient amount')
      {
        tbsAlertBox('Oops! <em>Insufficient</em> Amount')
      }
    }
  }).done(function(){
    isIdleOrderRequest = true;
  });
}
