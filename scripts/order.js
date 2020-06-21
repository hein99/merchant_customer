$(document).ready(function(){

  requestOrdersList();

  var fake_orders = [{"id": "1", "product_link": "https://item.taobao.com/item.htm?spm=a21bo.7929913.198967.13.488a41740VWaBl&id=605150240460", "status": "7", "amount": "165,000", "date": "2020-07-04 08:08:08"},
  {"id": "2", "product_link": "https://item.taobao.com/item.htm?spm=a21bo.7929913.198967.13.488a41740VWaBl&id=605150240460", "status": "3", "date": "2020-07-04 08:08:08"}];
  for(order of fake_orders)
    $(buildOrdersList(order)).appendTo('.orders-list-js');

  var fake_order = {"id": "1", "status": "2", "amount": "30,000", "order_number": "00000001", "remark" : "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do ut labore et dolore magna aliqua.",
  "date": "2020-07-04 08:08:08", "product_link": "https://item.taobao.com/item.htm?spm=a21bo.7929913.198967.13.488a41740VWaBl&id=605150240460", "qty": "3", "product_total_price": "600",
  "us_tax": "200", "shippig_cost": "200", "first_payment_dollar": "1,000", "first_payment_mmk": "1,500,000", "commission_rate": "10", "commission_amount": "100",
  "weight": "2", "total_weight_cost": "10", "mm_tax": "0", "mm_tax_amount": "0", "second_payment_dollar": "110", "second_payment_mmk": "165,000", "delivery_fee": "3000"};
  $('.order-detail-js').html(buildOrderVoucher(fake_order));
});
$
function requestOrderVoucher(id)
{
  $.ajax({
    url: PAGE_URL+'/order/get_order_voucher/'+id,
    method: "GET",
    success: function(order){
      if(Array.isArray(order))
        $('.order-detail-js').html(buildOrderVoucher(order));
    }
  });
}

function requestOrdersList()
{
  $.ajax({
    url: PAGE_URL+'/order/get_orders_list/',
    method: "GET",
    success: function(orders){
      if(Array.isArray(orders))
        for(order of orders)
          $(buildOrdersList(order)).appendTo('.orders-list-js');
    }
  });
}

function buildOrdersList(order)
{
  var list = '';
  list += '<li id="order-' + order.id + '-js">';
  list += '<div class=""><a href="' + order.product_link + '" target="_blank">Product link</a></div>';
  list += checkOrderStatus(order);
  list += '<div class="">' + order.date + '</div>';
  list += '<button type="button" data-id="' + order.id + '">View</button>';
  list += '</li>';
  return list;
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
function buildOrderVoucher(order)
{
  var voucher = '';
  voucher += '<div class="order-info">';
  voucher += checkOrderStatus(order);
  voucher += '<div class=""><span>Order no:</span> <span>' + order.order_number + '</span></div>';
  voucher += '<div class=""><span>Remark:</span> <span>' + order.remark + '</span></div>';
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


//update order list by ajax
