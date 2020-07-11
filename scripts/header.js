var is_request = true; //for update order noti
var is_confirm = false; //for confirmation dialog box
$(window).on('load', function() {
  $(".ssn_loader").fadeOut("slow");
});
$(document).ready(function(){

  getNewMessagesCount();
  if(is_request)
    getUpdateOrderNoti();

  setInterval(function(){
    update_last_activity();
    getNewMessagesCount();
    if(is_request)
      getUpdateOrderNoti();
  }, 3000);

  function getUpdateOrderNoti()
  {
    $.ajax({
      url: PAGE_URL+'/order/get_order_noti',
      method:"GET",
      success: function(data){
        if(data == 'true'){
          is_request = false;
          $('.hk-nav-noti').show();
        }
      },
      dataType: 'json'
    })
  }

  function update_last_activity()
  {
    $.ajax({
      url: PAGE_URL+'/conversation/update_activity_time',
      success: function(){

      }
    })
  }

  function getNewMessagesCount()
  {
    $.ajax({
      url: PAGE_URL+'/conversation/get_new_messages_count',
      method:"POST",
      success:function(data){
        var msg_count = $('#messages_count').text();
        if(data == 0){
          $('#messages_count').html(data);
          $('.msg_count').html(data);
        }
        else if(msg_count != data){
          $('#messages_count').html(data);
          $('.msg_count').html(data);
          $('.sound').html('<audio controls autoplay id="chatAudio"><source src="'+PAGE_FILE_URL+'/logos/you-wouldnt-believe.ogg" type="audio/ogg"><source src="'+PAGE_FILE_URL+'/logos/you-wouldnt-believe.mp3" type="audio/mpeg"><source src="'+PAGE_FILE_URL+'/logos/you-wouldnt-believe.m4r" type="audio/mpeg"></audio>');
        }
      }
    })
  }

  $(document).on('click', '.wp-header-menu', function(){
    $('.wp-other-page-nav-container, #wp-other-page-sidebar-back, .wp-other-page-nav').addClass('slide');
  });

  $(document).on('click', '#wp-close-nav, #wp-other-page-sidebar-back', function(){
    $('.wp-other-page-nav-container, #wp-other-page-sidebar-back, .wp-other-page-nav').removeClass('slide');
  });

  $(document).on('click', '#new-order', function(){
    $('.wp-new-order-container, .wp-new-order-back, .wp-new-order, .wp-header-user-name, .wp-customer-details, .wp-information-detail-container, .wp-exchange-rate-container, .wp-calculate-order-container, .wp-contact-admin-container').addClass('blur');
  });

  $(document).on('click', '.wp-new-order-back, #new-order-close', function(){
    $('.wp-new-order-container, .wp-new-order-back, .wp-new-order, .wp-header-user-name, .wp-customer-details, .wp-information-detail-container, .wp-exchange-rate-container, .wp-calculate-order-container, .wp-contact-admin-container').removeClass('blur');
  });

  $(document).on('focus', '.new-order-input input, .new-order-textarea textarea', function(){
    $(this).addClass('focus');
    $(this).parent().find('i').addClass('focus');
  });

  if ($(window).width() < 480) {
    $(document).on('blur', '.new-order-input input, .new-order-textarea textarea', function(){
      $(this).removeClass('focus');
      if($(this).val() == ""){
        $(this).removeClass('focus');
      }else{
        $(this).addClass('focus');
      }
    });
  }else{
    $(document).on('blur', '.new-order-input input, .new-order-textarea textarea', function(){
      $(this).removeClass('focus');
      $(this).parent().find('i').removeClass('focus');
    });
  }

  $(document).on('click', '.hk-est-calc-trigger-js', function(){
    buildEstimateCalculator();
  });
});

function buildDialogConfirmBox(msg)
{
  var markup = '';
  markup += '<article class="hk-dialog-box-wrap">';
  markup += '<section class="hk-dialog-box-content">';
  markup += '<header>';
  markup += '<img src="' + PAGE_FILE_URL + '/logos/globe-solid.png">';
  markup += '<h1>The Best Shop</h1>';
  markup += '</header>';
  markup += '<p>';
  markup += msg;
  markup += '</p>';
  markup += '<div class="hk-dialog-box-btn-gp"></div>';
  markup += '</section>';
  markup += '</article>';
  return markup;
}
function tbsConfirmBox(triggerBtn, msg)
{
  $('body').prepend(buildDialogConfirmBox(msg));
  var cancelBtn = $('<button>').html('No').click(function(){
    $('.hk-dialog-box-wrap').remove();
    is_confirm = false;
  });
  var confrimBtn= $('<button>').html('Yes').click(function(){
    $('.hk-dialog-box-wrap').remove();
    is_confirm = true;
    triggerBtn.trigger("click");
  });
  cancelBtn.appendTo('.hk-dialog-box-btn-gp');
  confrimBtn.appendTo('.hk-dialog-box-btn-gp');
}
function tbsAlertBox(msg)
{
  $('body').prepend(buildDialogConfirmBox(msg));
  var okBtn = $('<button>').html('Ok').click(function(){
    $('.hk-dialog-box-wrap').remove();
  });
  okBtn.appendTo('.hk-dialog-box-btn-gp');
}
function buildEstimateCalculator()
{
  $.ajax({
    url: PAGE_URL+'/order/get_required_est_data',
    method: 'get',
    dataType: 'json'
  }).done(function(msg){
    var close_btn = $('<button>').html('&times;').click(function(){
      $('.hk-est-calc-wrap').remove();
    })
    $('<article>', {
      class: 'hk-est-calc-wrap'
    }).append(close_btn).append(buildFormEstimateCaculation(msg)).prependTo('body');
  });

}

function buildFormEstimateCaculation(defalultData)
{
  var d_commission_rate = 15;
  var d_exchange_rate = 1500;
  if(typeof(defalultData) == 'object'){
    d_commission_rate = defalultData.commission_rate;
    d_exchange_rate = defalultData.exchange_rate;
  }

  var p_price = $('<input>', {type: 'number', id: 'p-price', step: '0.01', placeholder: '0.00'}).blur(function(){
    changeRespectiveFormValue();
  });
  var p_qty = $('<input>', {type: 'number', id: 'p-qty', placeholder: '0', value: '1'}).blur(function(){
    changeRespectiveFormValue();
  });
  var weight_cost = $('<input>', {type: 'number', id: 'weight-cost', step: '0.01', value: '7', placeholder: '0.00'}).blur(function(){
    changeRespectiveFormValue();
  });
  var p_weight = $('<input>', {type: 'number', id: 'p-weight', step: '0.01', placeholder: '0.00'}).blur(function(){
    changeRespectiveFormValue();
  });
  var us_tax = $('<input>', {type: 'number', id: 'us-tax', step: '0.01', placeholder: '0.00'});
  var shipping_cost = $('<input>', {type: 'number', id: 'shipping-cost', step: '0.01', placeholder: '0.00'}).blur(function(){
    changeRespectiveFormValue();
  });
  var commission = $('<input>', {type: 'number', id: 'commission', step: '0.01', 'data-rate': d_commission_rate, placeholder: '0.00'});
  var mm_tax = $('<input>', {type: 'number', id: 'mm-tax', step: '0.01', placeholder: '0.00'});
  var exchange_rate = $('<input>', {type: 'number', id: 'exchange-rate', step: '0.01', value: d_exchange_rate, placeholder: '0.00'});
  var calc_btn = $('<button>', {type: 'button'}).html('Calculate').click(function(){
    $('.hk-est-calc-wrap').append(buildResultEstimateCalculation());
    $('.hk-est-form-wrap').hide();
  });

  var t_r1 = $('<tr>').append($('<td>').append($('<label>', {for: 'p-price'}).html('Product&nbsp;Unit&nbsp;Price'))).append($('<td>').html('$')).append($('<td>').append(p_price));
  var t_r2 = $('<tr>').append($('<td>').append($('<label>', {for: 'p-qty'}).html('Quantity'))).append($('<td>').html('unit')).append($('<td>').append(p_qty));
  var t_r3 = $('<tr>').append($('<td>').append($('<label>', {for: 'p-weight'}).html('Product&nbsp;Weight'))).append($('<td>').html('lb')).append($('<td>').append(p_weight));
  var t_r4 = $('<tr>').append($('<td>').append($('<label>', {for: 'shipping-cost'}).html('Shipping&nbsp;Cost'))).append($('<td>').html('$')).append($('<td>').append(shipping_cost));
  var t_r5 = $('<tr>').append($('<td>').append($('<label>', {for: 'weight-cost'}).html('Weight&nbsp;Cost<br><em>Est:[ 1lb = 7$ ]</em>'))).append($('<td>').html('$')).append($('<td>').append(weight_cost));
  var t_r6 = $('<tr>').append($('<td>').append($('<label>', {for: 'us-tax'}).html('US&nbsp;Tax<br><em>Est:[ 5% ]</em>'))).append($('<td>').html('$')).append($('<td>').append(us_tax));
  var t_r7 = $('<tr>').append($('<td>').append($('<label>', {for: 'mm-tax'}).html('MM&nbsp;Tax<br><em>Est:[ 5% ]</em>'))).append($('<td>').html('$')).append($('<td>').append(mm_tax));
  var t_r8 = $('<tr>').append($('<td>').append($('<label>', {for: 'commission'}).html('Commission<br><em>Est:[ ' + d_commission_rate + '% ]</em>'))).append($('<td>').html('$')).append($('<td>').append(commission));
  var t_r9 = $('<tr>').append($('<td>').append($('<label>', {for: 'exchange-rate'}).html('Exchange&nbsp;Rate<br><em>Est:[ 1$ = ' + d_exchange_rate + ' Ks ]</em>'))).append($('<td>').html('MMK')).append($('<td>').append(exchange_rate));
  var form_table = $('<table>').append(t_r1).append(t_r2).append(t_r3).append(t_r4).append(t_r5).append(t_r6).append(t_r7).append(t_r8).append(t_r9);

  var form = $('<form>', {action: '#', method: 'get'}).append(form_table).append(calc_btn);
  return $('<section>', {class: 'hk-est-form-wrap'}).append($('<h1>').html('Please fill all the fields below to calculate')).append(form);
}

function buildResultEstimateCalculation()
{
  var p_price = Number($('#p-price').val());
  var p_qty = Number($('#p-qty').val());
  var weight_cost = Number($('#weight-cost').val());
  var p_weight = Number($('#p-weight').val());
  var us_tax = Number($('#us-tax').val());
  var shipping_cost = Number($('#shipping-cost').val());
  var commission = Number($('#commission').data('rate'));
  var mm_tax = 5;
  var exchange_rate = Number($('#exchange-rate').val());

  var t_price = p_price * p_qty;
  var f_payment_dollar = t_price + us_tax + shipping_cost;
  var f_payment_mmk = f_payment_dollar*exchange_rate;

  var t_commission = (f_payment_dollar/100)*commission;
  var t_weight = weight_cost*p_weight;
  var t_mm_tax = (f_payment_dollar/100)*mm_tax;
  var s_payment_dollar = t_commission + t_weight + t_mm_tax;
  var s_payment_mmk = s_payment_dollar*exchange_rate;

  var t_amount = f_payment_mmk + s_payment_mmk;

  var t1_h_r1 = $('<tr>').append($('<th>').html('Description')).append($('<th>').html('Quantity')).append($('<th>').html('Total&nbsp;Price'));
  var t1_head = $('<thead>').append(t1_h_r1 );

  var t1_b_r1 = $('<tr>').append($('<td>').html('Product')).append($('<td>').html('[' + p_qty + ']')).append($('<td>').html('$&nbsp;' + currencyFormat(t_price)));
  var t1_b_r2 = $('<tr>').append($('<td>').html('US&nbsp;Tax')).append($('<td>').html('&nbsp;')).append($('<td>').html('$&nbsp;' + currencyFormat(us_tax)));
  var t1_b_r3 = $('<tr>').append($('<td>').html('Shipping&nbsp;Cost')).append($('<td>').html('&nbsp;')).append($('<td>').html('$&nbsp;' + currencyFormat(shipping_cost)));
  var t1_body = $('<tbody>').append(t1_b_r1).append(t1_b_r2).append(t1_b_r3);

  var t1_f_r1 = $('<tr>').append($('<td>').html('First&nbsp;Payment<em>[Est.]</em>')).append($('<td>', {colspan: '2'}).html('$&nbsp;' + currencyFormat(f_payment_dollar)));
  var t1_f_r2 = $('<tr>').append($('<td>').html('&nbsp;')).append($('<td>', {colspan: '2'}).html('MMK&nbsp;' + currencyFormat(f_payment_mmk)));
  var t1_footer = $('<tfoot>').append(t1_f_r1).append(t1_f_r2);

  var table1 = $('<table>').append(t1_head).append(t1_body).append(t1_footer);

  var t2_b_r1 = $('<tr>').append($('<td>').html('Commission')).append($('<td>').html('[' + commission + '%]')).append($('<td>').html('$&nbsp;' + currencyFormat(t_commission)));
  var t2_b_r2 = $('<tr>').append($('<td>').html('Weight')).append($('<td>').html('[' + p_weight + 'lb]')).append($('<td>').html('$&nbsp;' + currencyFormat(t_weight)));
  var t2_b_r3 = $('<tr>').append($('<td>').html('MM&nbsp;Tax')).append($('<td>').html('[' + mm_tax + '%]')).append($('<td>').html('$&nbsp;' + currencyFormat(t_mm_tax)));
  var t2_body = $('<tbody>').append(t2_b_r1).append(t2_b_r2).append(t2_b_r3);

  var t2_f_r1 = $('<tr>').append($('<td>').html('Second&nbsp;Payment<em>[Est.]</em>')).append($('<td>', {colspan: '2'}).html('$&nbsp;' + currencyFormat(s_payment_dollar)));
  var t2_f_r2 = $('<tr>').append($('<td>').html('&nbsp;')).append($('<td>', {colspan: '2'}).html('MMK&nbsp;' + currencyFormat(s_payment_mmk)));
  var t2_footer = $('<tfoot>').append(t2_f_r1).append(t2_f_r2);

  var table2 = $('<table>').append(t2_body).append(t2_footer);

  var t_amount_field = $('<div>').append($('<p>').html('Total&nbsp;Amount<em>[Est.]</em>')).append($('<p>').html(currencyFormat(t_amount) + '&nbsp;<em>MMK</em>'));

  var edit_btn = $('<button>', {type: 'button'}).html('Calculate&nbsp;Again').click(function(){
    $('.hk-est-result-wrap').remove();
    $('.hk-est-form-wrap').show();
  });
  return $('<section>', {class: 'hk-est-result-wrap'}).append(table1).append(table2).append(t_amount_field).append(edit_btn);
}
function changeRespectiveFormValue()
{
  var p_price_val = Number($('#p-price').val()) * Number($('#p-qty').val());
  var shipping_cost_val = Number($('#shipping-cost').val());
  var commission_val = Number($('#commission').data('rate'))/100;
  var us_tax_val = p_price_val*0.05;

  var f_payment_val = p_price_val + us_tax_val + shipping_cost_val;

  $('#us-tax').val(currencyFormat(us_tax_val));
  $('#mm-tax').val(currencyFormat(f_payment_val*0.05));
  $('#commission').val(currencyFormat(f_payment_val*commission_val));
}

function currencyFormat(num)
{
  return num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}
