var tempOrder = null;
$(document).ready(function(){
  requestOrdersList();
});
$(document).on('click', '.order-view-btn-js', function(){
  parent = $(this).parent();
  var id = $(this).data('id');
  requestOrderVoucher(id);

  if($('.noti-js', parent).is(':visible'))
    $('.noti-js', parent).hide();
})

$(document).on('click', '.edit-order-js', function(){
  $(buildOrderForm(true)).appendTo('.order-wrap-js');
})

$(document).on('click', '.order-from-btn-js', function(){
  $(buildOrderForm(false)).appendTo('.order-wrap-js');
})

$(document).on('click', '.order-form-cancel-js', function(){
  $('.order-form-wrap-js').remove();
})

function requestOrdersList()
{
  $.ajax({
    url: PAGE_URL+'/order/get_orders_list/',
    method: "GET",
    success: function(orders){
      if(Array.isArray(orders))
      {
        for(order of orders)
          $(buildOrdersList(order)).appendTo('.orders-list-js');
        requestUpdateOrdersList();

        setInterval(function(){
          requestUpdateOrdersList();
        }, 60000)
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
        $('.order-detail-js').html(buildOrderVoucher(order));
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
        for(id of orders)
        {
          var list = '#order-' + id + '-js';
          $(list).prependTo('.orders-list-js');
          if(!$('.noti-js', list).is(':visible'))
            $('.noti-js', list).show();
        }
    },
    dataType: 'json'
  });
}

function buildOrdersList(order)
{
  var list = '';
  list += '<li id="order-' + order.id + '-js">';
  list += '<span class="noti-js" style="display: none;">*</span>';
  list += '<div class=""><a href="' + order.product_link + '" target="_blank">Product link</a></div>';
  list += checkOrderStatus(order);
  list += '<div class="">' + order.date + '</div>';
  list += '<button type="button" class="order-view-btn-js" data-id="' + order.id + '">View</button>';
  list += '</li>';
  return list;
}

function buildOrderVoucher(order)
{
  var voucher = '';
  voucher += '<div class="order-info">';
  voucher += (Number(order.status) < 2) ? '<button class="edit-order-js">Edit</button>' : '';
  voucher += checkOrderStatus(order);
  voucher += '<div class=""><span>Order no:</span> <span>' + order.order_number + '</span></div>';
  voucher += '<div class=""><span>Remark:</span> <span>' + order.remark + '</span></div>';
  voucher += '<div class=""><span>Product Cupon Code:</span> <span>' + order.cupon_code + '</span></div>';
  voucher += '<div class="">' + order.date + '</div>';
  voucher += '</div>';
  voucher += '<div class="order-voucher">';
  voucher += '<div class=""><span><a href="' + order.product_link + '" target="_blank">Product Link</a></span> <span>[' + order.qty + ']</span> <span>$' + order.product_total_price + '</span></div>';
  voucher += '<div class=""><span>US Tax</span> <span>$' + order.us_tax + '</span></div>';
  voucher += '<div class=""><span>Shipping Cost</span> <span>$' + order.shippig_cost + '</span></div>';
  voucher += '<div class=""><span>First Payment</span> <span>$' + order.first_payment_dollar + '</span></div>';
  voucher += '<div class="">';
  voucher += (Number(order.status) > 1) ? '<span>Paid</span>' : '';
  voucher += ' <span>MMK' + order.first_payment_mmk + '</span>';
  voucher += '</div>';
  voucher += '<div class=""><span>Commission</span> <span>[' + order.commission_rate + '%]</span> <span>$' + order.commission_amount + '</span></div>';
  voucher += '<div class=""><span>Weight</span> <span>[' + order.weight + 'lb]</span> <span>$' + order.total_weight_cost + '</span></div>';
  voucher += '<div class=""><span>MM Tax</span><span>';
  voucher += ((Number(order.mm_tax)) == 0) ? 'Free' : '$' + order.mm_tax;
  voucher += '</span> <span>$' + order.mm_tax_amount + '</span></div>';
  voucher += '<div class=""><span>Second Payment</span> <span>$' + order.second_payment_dollar + '</span></div>';
  voucher += '<div class="">';
  voucher += (Number(order.status) > 3) ? '<span>Paid</span>' : '';
  voucher += ' <span>MMK' + order.second_payment_mmk + '</span>';
  voucher += '</div>';
  voucher += '<div class="">';
  voucher += ' <span>Delivery Fee</span>';
  voucher += (Number(order.status) == 7) ? '<span>Paid</span>' : '';
  voucher += ' <span>MMK' + order.delivery_fee + '</span></div>';
  voucher += '<div class="">';
  voucher += (Number(order.status) == 1) ? '<button type="button">Confirm</button>' : '';
  voucher += (Number(order.status) < 2) ? '<button type="button">Cancel</button>' : '';
  voucher += '</div>';

  return voucher;
}

function buildOrderForm(is_edit)
{
  var form = '';
  if(is_edit){
    form += '<div class="order-form-wrap-js">';
    form += '<button class="order-form-cancel-js">X</button>';
    form += '<h2>Update Order</h2>';
    form += '<form class="" action="' + PAGE_URL + '/order/update_order/" method="post">';
    form += '<input type="hidden" name="id" value="' + tempOrder.id + '">';
    form += '<input type="text" name="product_link" placeholder="Product Link" value="' + tempOrder.product_link + '">';
    form += '<input type="number" name="quantity" placeholder="Quantity" value="' + tempOrder.qty + '">';
    form += '<input type="text" name="cupon_code" placeholder="Cupon_code" value="' + tempOrder.cupon_code + '">';
    form += '<textarea name="remark" placeholder="Remark">' + tempOrder.remark + '</textarea>';
    form += '<input type="number" name="price" placeholder="Unit Price ($)" value="' + tempOrder.product_price + '">';
    form += '<input type="submit" value="Add">';
    form += '</form>';
    form += '</div>';
  }
  else {
    form += '<div class="order-form-wrap-js">';
    form += '<button class="order-form-cancel-js">X</button>';
    form += '<h2>Add New Order</h2>';
    form += '<form class="" action="' + PAGE_URL + '/order/add_new_order/" method="post">';
    form += '<input type="text" name="product_link" placeholder="Product Link">';
    form += '<input type="number" name="quantity" placeholder="Quantity">';
    form += '<input type="text" name="cupon_code" placeholder="Cupon_code">';
    form += '<textarea name="remark" placeholder="Remark"></textarea>';
    form += '<input type="number" name="price" placeholder="Unit Price ($)">';
    form += '<input type="submit" value="Add">';
    form += '</form>';
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
      list += '<div class="order-status request-order">Request</div>';
      break;
    case '1':
      list += '<div class="order-status pending-order">Pending</div>';
      break;
    case '2':
      list += '<div class="order-status confirm-order">Confirm</div>';
      break;
    case '3':
      list += '<div class="order-status stusw-order">Shipping To US warehouse</div>';
      break;
    case '4':
      list += '<div class="order-status atusw-order">Arrived at US warehouse</div>';
      break;
    case '5':
      list += '<div class="order-status stmm-order">Shipping To Myanmar</div>';
      break;
    case '6':
      list += '<div class="order-status atmm-order">Arrived at Myanmar</div>';
      break;
    case '7':
      list += '<div class="order-status complete-order">Complete</div>';
      list += '<div class="">' + order.amount + 'MMK</div>';
      break;
    case '8':
      list += '<div class="order-status cancel-order">Cancel</div>';
      break;
  }
  return list;
}

//todo
//confirm cancel btn action
