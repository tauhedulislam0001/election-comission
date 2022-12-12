$('#refresh-balance-link-top').click(function(ev){
  ev.preventDefault();
  $.ajax({
      url: "user/Wallet/balance",
      type: 'GET',
      success: function(response) {
          $('#current_wallet').text(response);
      },
      error: function() {
          alert('balance couldn\'t be refreshed!');
      }
  });
});

$("#removeCoupon").hide();
$("#applyCoupon").show();

/***** payment section *****/ 

  /*****  coupon and wallet section hide *****/
  $("#coupon_section").hide();
  $("#subtotal_section").hide();
  $("#coupon_amount_div").hide();

  $("#payment_method").change(function() {
    if($(this).val() == "wallet") {
      $("#coupon_section").show();
    }
  });


/***** Round Trip section *****/ 

$("#car-select-form-rt").click(function () {
  var mybalance           = document.getElementById("myBalance").value;
  var airport_name_car    = $("#airport_name_car_rt").val();
  var trip_type           = $("#trip_type").val();
  var division_name       = $("#division_name_rt").val();
  var district_name_car   = $("#district_name_car_rt").val();
  var thana_name_car      = $("#thana_name_car_rt").val();           
  var UsdFareValue        = $("#converted_currency_usd_rt").val();           
  var fare                = $("#car1_fair_rt").text();
  var usd_car1_fair       = $("#usd_car1_fair_rt").val();
  var BDTfare             = $("#car1_BDTfair_rt").text();
  var usdShort            = usd_car1_fair *  UsdFareValue;
  var USDTotal            = usdShort.toFixed(2);

  
  var str         = airport_name_car;
  var dropOffStr  = thana_name_car +', '+ district_name_car+', '+ division_name;
  
  
  $("#from_area").html(str);
  $("#to_area").html(dropOffStr);
  $("#fare").html(fare);
  $("#USDfareHtml").html("USD " +USDTotal);
  $("#USDfare").val("USD " +USDTotal);
  //alert(USDTotal);
  $("#fare2").val(fare);
  $("#NagadfareBDThtml").html(fare);
  $("#NagadfareBDTVal").html(fare);
  $("#UsdfareBDThtml").html(fare);
  $("#UsdfareBDTVal").html(fare);
  $("#Nagadfarehtml").html(BDTfare);
  $("#Nagadfareval").val(BDTfare); 
  $("#BkashFareHtml").html(fare);
  $("#BkashFareVal").html(fare);
  $("#BDTbkashfare").html(BDTfare);
  $("#BDTbkashfare2").val(BDTfare);
  $("#trip_type").val(trip_type);

  //$("#fare-hidden > input").val(fare);
  var farefinal                = document.getElementById("fare2").value;
  var res = parseFloat(farefinal.replace( /[^\d\.]*/g, ''));
 // alert(res);
  //alert(farefinal);
  $("#fare3").val(res);
  
  $("#payment_method").change(function() {
    if($(this).val() == "wallet") {
      $("#coupon_section").show();
     // couponSubmit();
    }
  });
 
  var coupon_amount = $("#coupon_amount").val();
  // var subtotal  = parseFloat(mybalance) - parseFloat(res) - coupon_amount;
  // $("#subtotal_fare").html('<?php echo $currency; ?> ' + subtotal);
  // alert(newbalance);
});
  
/***** Single Trip section *****/ 

$("#car-select-form").click(function () {
  var mybalance           = document.getElementById("myBalance").value;
  var airport_name_car    = $("#airport_name_car").val();
  var division_name       = $("#division_name").val();
  var district_name_car   = $("#district_name_car").val();
  var thana_name_car      = $("#thana_name_car").val();           
  var UsdFareValue        = $("#converted_currency_usd").val();           
  var fare                = $("#car1_fair").text();
  var usd_car1_fair       = $("#usd_car1_fair").val();
  var BDTfare             = $("#car1_BDTfair").text();
  var usdShort            = usd_car1_fair *  UsdFareValue;
  var USDTotal            = usdShort.toFixed(2);

  
  var str         = airport_name_car;
  var dropOffStr  = thana_name_car +', '+ district_name_car+', '+ division_name;
  
  
  $("#from_area").html(str);
  $("#to_area").html(dropOffStr);
  $("#fare").html(fare);
  $("#USDfareHtml").html("USD " +USDTotal);
  $("#USDfare").val("USD " +USDTotal);
  //alert(USDTotal);
  $("#fare2").val(fare);
  $("#NagadfareBDThtml").html(fare);
  $("#NagadfareBDTVal").html(fare);
  $("#UsdfareBDThtml").html(fare);
  $("#UsdfareBDTVal").html(fare);
  $("#Nagadfarehtml").html(BDTfare);
  $("#Nagadfareval").val(BDTfare); 
  $("#BkashFareHtml").html(fare);
  $("#BkashFareVal").html(fare);
  $("#BDTbkashfare").html(BDTfare);
  $("#BDTbkashfare2").val(BDTfare);

  //$("#fare-hidden > input").val(fare);
  var farefinal                = document.getElementById("fare2").value;
  var res = parseFloat(farefinal.replace( /[^\d\.]*/g, ''));
 // alert(res);
  //alert(farefinal);
  $("#fare3").val(res);
  
  $("#payment_method").change(function() {
    if($(this).val() == "wallet") {
      $("#coupon_section").show();
     // couponSubmit();
    }
  });
 
  var coupon_amount = $("#coupon_amount").val();
  // var subtotal  = parseFloat(mybalance) - parseFloat(res) - coupon_amount;
  // $("#subtotal_fare").html('<?php echo $currency; ?> ' + subtotal);
  // alert(newbalance);
});

/***** image preview *****/

// $("#output").hide()

// var loadFile = function(event) {
//   var output = document.getElementById('output');
//   output.src = URL.createObjectURL(event.target.files[0]);
//   output.onload = function() {
//     URL.revokeObjectURL(output.src) // free memory
//   }
//   $("#output").show()
// };


// Custom JS for the Theme

$(document).ready(function () {
  $('.nav-tabs > li a[title]').tooltip();
  
  //Wizard
//   $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

//       var $target = $(e.target);
  
//       if ($target.parent().hasClass('disabled')) {
//           return false;
//       }
//   });
//   $(".next-step").click(function (e) {
//     var $active = $('.wizard .nav-tabs li.active ');
   
//     $active.next().removeClass('disabled');
//     nextTab($active);

// });
  $(".prev-step").click(function (e) {

    var $active = $('.wizard .nav-tabs li.active');
    prevTab($active);

});

  
});

function nextTab(elem) {
  $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
  $(elem).prev().find('a[data-toggle="tab"]').click();
}

// Config 
//-------------------------------------------------------------

var companyName = "Garibook"; // Enter your event title


// Initialize Tooltip  
//-------------------------------------------------------------

$('.my-tooltip').tooltip();



// Initialize jQuery Placeholder  
//-------------------------------------------------------------

$('input, textarea').placeholder();



// Toggle Header / Nav  
//-------------------------------------------------------------

$(document).on("scroll",function(){
  if($(document).scrollTop()>39){
    $("header").removeClass("large").addClass("small");
  }
  else{
    $("header").removeClass("small").addClass("large");
  }
});
$('.scroll-to').on('click', function(){
  $('.navbar-collapse').collapse('hide');
});



// Vehicles Tabs / Slider  
//-------------------------------------------------------------

$(".vehicle-data").hide();
var activeVehicleData = $(".vehicle-nav .active a").attr("href");
$(activeVehicleData).show();

$('.vehicle-nav-scroll').click(function(){
    var direction = $(this).data('direction');
    var scrollHeight = $('.vehicle-nav li').height() + 1;
    var navHeight = $('#vehicle-nav-container').height() + 1;
    var actTopPos = $(".vehicle-nav").position().top;
    var navChildHeight = $('#vehicle-nav-container').find('.vehicle-nav').height();
    var x = -(navChildHeight - navHeight);

    var fullHeight = 0;
    $('.vehicle-nav li').each(function() {
        fullHeight += scrollHeight;
    });

    navHeight = fullHeight - navHeight + scrollHeight;

    // Scroll Down
    if ((direction == 'down') && (actTopPos > x) && (-navHeight <= (actTopPos - (scrollHeight * 2)))) {
        topPos = actTopPos - scrollHeight;
        $(".vehicle-nav").css('top', topPos);
    }

    // Scroll Up
    if (direction == 'up' && 0 > actTopPos) {
        topPos = actTopPos + scrollHeight;
        $(".vehicle-nav").css('top', topPos);
    }

    return false;
});




$(".vehicle-nav li").on("click", function(){

  $(".vehicle-nav .active").removeClass("active");
  $(this).addClass('active');

  $(activeVehicleData).fadeOut( "slow", function() {
    activeVehicleData = $(".vehicle-nav .active a").attr("href");
    $(activeVehicleData).fadeIn("slow", function() {});
  });

  return false;
});



// Vehicles Responsive Nav  
//-------------------------------------------------------------

$("<div />").appendTo("#vehicle-nav-container").addClass("styled-select-vehicle-data");
$("<select />").appendTo(".styled-select-vehicle-data").addClass("vehicle-data-select");
$("#vehicle-nav-container a").each(function() {
  var el = $(this);
  $("<option />", {
    "value"   : el.attr("href"),
    "text"    : el.text()
  }).appendTo("#vehicle-nav-container select");
});

$(".vehicle-data-select").change(function(){
  $(activeVehicleData).fadeOut( "slow", function() {
    activeVehicleData = $(".vehicle-data-select").val();
    $(activeVehicleData).fadeIn("slow", function() {});
  });

  return false;
});



// Initialize Datepicker
//-------------------------------------------------------------------------------
var nowTemp = new Date();
var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

var checkin = $('#pick-up-date').datepicker({
    onRender: function (date) {
        return date.valueOf() < now.valueOf() ? 'disabled' : '';
    }
}).on('changeDate', function (ev) {
    // if (ev.date.valueOf() > checkout.date.valueOf()) {
    //     var newDate = new Date(ev.date)
    //     newDate.setDate(newDate.getDate() + 1);
    //     checkout.setValue(newDate);
    // }
    // $('#pick-up-date').Close();
    
    checkin.hide();
    SigleTripFair();

    //$('#pick-up-date')[0].close();
    }).data('datepicker');
// var checkout = $('#drop-off-date').datepicker({
//     onRender: function (date) {
//         return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
//     }
// }).on('changeDate', function (ev) {
//     checkout.hide();
// }).data('datepicker');
// $("time").timepicker({
//   timeFormat: 'HH:mm',
//   interval: 30,
//   scrollbar: true,
//   change: tmTotalHrsOnSite
// });


// Toggle Drop-Off Location
//-------------------------------------------------------------------------------
// $(".input-group.drop-off").hide();
// $(".different-drop-off").on("click", function(){
// 	$(".input-group.drop-off").toggle();
//   $(".autocomplete-suggestions").css("width", $('.pick-up .autocomplete-location').outerWidth());
//   return false;
// });



// Scroll to Top Button
//-------------------------------------------------------------------------------

$(window).scroll(function(){
  if ($(this).scrollTop() > 100) {
    $('.scrollup').removeClass("animated fadeOutRight");
    $('.scrollup').fadeIn().addClass("animated fadeInRight");
  } else {
    $('.scrollup').removeClass("animated fadeInRight");
    $('.scrollup').fadeOut().addClass("animated fadeOutRight");
  }
});

$('.scrollup, .navbar-brand').click(function(){
  $("html, body").animate({ scrollTop: 0 }, 'slow', function(){
    $("nav li a").removeClass('active');
  });
  return false;
});

// vehicle button change value of car select

$('.scroll-to').click(function(){ 
   $('#car_name').val($(this).data('val')).trigger('change');
  
});

$("#fareinfo-btn").click(function(){
  $("#fareinfo").select();
     document.execCommand('copy');
 });
// function CopyToClipboard(containerid) {
//   if (document.selection) {
//       var range = document.body.createTextRange();
//       range.moveToElementText(document.getElementById(containerid));
//       range.select().createTextRange();
//       document.execCommand('Copy');

//   } else if (window.getSelection) {
//       var range = document.createRange();
//       document.getElementById(containerid).style.display = "block";
//       range.selectNode(document.getElementById(containerid));
//       window.getSelection().addRange(range);
//       document.execCommand('Copy');
//       document.getElementById(containerid).style.display = "none";
//   }
// }
$('[data-toggle="tooltip"]').tooltip({
  trigger: 'click'
  
});
$('[data-toggle="tooltip"]').mouseleave(function(){
  $(this).tooltip('hide');
});

// Location Map Function
//-------------------------------------------------------------------------------

function loadMap(addressData){

  var path = document.URL;
      path = path.substring(0, path.lastIndexOf("/") + 1)

  var locationContent = "<h2>"+addressData.value+"</h2>"
  + "<p>"+addressData.address+"</p>"
  + "<p>Contact: "+addressData.mobile+"</p>";
  

  var locationData = {
        map: {
            options: {
                maxZoom: 15,
                scrollwheel: true,
            }
        },
        infowindow:{
                options:{
                content: locationContent
            }
        },
        marker:{
            options: {
                icon: new google.maps.MarkerImage(
                    path+"dashboard/new/img/mapmarker.png",
                    new google.maps.Size(59, 58, "px", "px"),
                    new google.maps.Point(0, 0),    //sets the origin point of the icon
                    new google.maps.Point(29, 34)   //sets the anchor point for the icon
                )
            }
        }
    };

    if ($.isEmptyObject(addressData.latLng)) {
        locationData.infowindow.address = addressData.value;
        locationData.marker.address = addressData.value;
    }
    else{
        locationData.infowindow.latLng = addressData.latLng;
        locationData.marker.latLng = addressData.latLng;
    }

  $('#locations .map').gmap3(locationData, "autofit" );
}

loadMap(locations[0]);


$("#location-map-select-c").append('<option value="">Select Country</option>');  
$("#location-map-select").append('<option value="">Select Agent</option>');  

$.each(country, function( index, value ) {
  //console.log(index);
  var option = '<option value="'+index+'">'+value.value+'</option>';

  $("#location-map-select-c").append(option); 

});
$('#location-map-select-c').on('change', function() {
  $("#location-map-select").html("");
   var selCountry = $('#location-map-select-c').val()

   if(selCountry == 0){
    $("#location-map-select").html("<option>Select Agent</option>");

    $.each(locations.filter(
      function (el) { 
          return el.country == 'MY' ;
      }), 
      function( index, value ) {
          //console.log(index);
          var option = '<option value="'+value.id+'">'+value.value+'</option>';
          $("#location-map-select").append(option);
  
    
     });
     $('#location-map-select').on('change', function() {
      $('#locations .map').gmap3('destroy');
      loadMap(locations[this.value]);
    });
   }else if (selCountry == 1){
    $("#location-map-select").html("<option>Select Agent</option>");

    $.each(locations.filter(
      function (el) { 
          return el.country == 'MV' ;
      }), 
      function( index, value ) {
          //console.log(index);
  
          var option = '<option value="'+value.id+'">'+value.value+'</option>';
          $("#location-map-select").append(option);
  
    
     });
     $('#location-map-select').on('change', function() {
      $('#locations .map').gmap3('destroy');
      loadMap(locations[this.value]);
    });
   }

  // // $.each(locations, function( index, value ) {
  // //   //console.log(index);
  // //  if (value.country = 'MY')
  // //   var option = '<option value="'+index+'">'+value.value+'</option>';
  // //   $("#location-map-select").append(option);
  



});






// Scroll To Animation
//-------------------------------------------------------------------------------

var scrollTo = $(".scroll-to");

scrollTo.click( function(event) {
  $('.modal').modal('hide');
  var position = $(document).scrollTop();
  var scrollOffset = 110;

  if(position < 39)
  {
    scrollOffset = 260;
  }

  var marker = $(this).attr('href');
  $('html, body').animate({ scrollTop: $(marker).offset().top - scrollOffset}, 'slow');

  return false;
});



// setup autocomplete - pulling from locations-autocomplete.js
//-------------------------------------------------------------------------------

$('.autocomplete-location').autocomplete({
  lookup: locations
});



// Newsletter Form
//-------------------------------------------------------------------------------

$( "#newsletter-form" ).submit(function() {

  $('#newsletter-form-msg').addClass('hidden');
  $('#newsletter-form-msg').removeClass('alert-success');
  $('#newsletter-form-msg').removeClass('alert-danger');

  $('#newsletter-form input[type=submit]').attr('disabled', 'disabled');

  $.ajax({
    type: "POST",
    url: "php/index.php",
    data: $("#newsletter-form").serialize(),
    dataType: "json",
    success: function(data) {

      if('success' == data.result)
      {
        $('#newsletter-form-msg').css('visibility','visible').hide().fadeIn().removeClass('hidden').addClass('alert-success');
        $('#newsletter-form-msg').html(data.msg[0]);
        $('#newsletter-form input[type=submit]').removeAttr('disabled');
        $('#newsletter-form')[0].reset();
      }

      if('error' == data.result)
      {
        $('#newsletter-form-msg').css('visibility','visible').hide().fadeIn().removeClass('hidden').addClass('alert-danger');
        $('#newsletter-form-msg').html(data.msg[0]);
        $('#newsletter-form input[type=submit]').removeAttr('disabled');
      }

    }
  });

  return false;
});



// Contact Form
//-------------------------------------------------------------------------------

$( "#contact-form" ).submit(function() {

  $('#contact-form-msg').addClass('hidden');
  $('#contact-form-msg').removeClass('alert-success');
  $('#contact-form-msg').removeClass('alert-danger');

  $('#contact-form input[type=submit]').attr('disabled', 'disabled');

  $.ajax({
    type: "POST",
    url: "php/index.php",
    data: $("#contact-form").serialize(),
    dataType: "json",
    success: function(data) {

      if('success' == data.result)
      {
        $('#contact-form-msg').css('visibility','visible').hide().fadeIn().removeClass('hidden').addClass('alert-success');
        $('#contact-form-msg').html(data.msg[0]);
        $('#contact-form input[type=submit]').removeAttr('disabled');
        $('#contact-form')[0].reset();
      }

      if('error' == data.result)
      {
        $('#contact-form-msg').css('visibility','visible').hide().fadeIn().removeClass('hidden').addClass('alert-danger');
        $('#contact-form-msg').html(data.msg[0]);
        $('#contact-form input[type=submit]').removeAttr('disabled');
      }

    }
  });

  return false;
});

//before login validation

// Car Select Form
//-------------------------------------------------------------------------------

$( "#send_form" ).click(function() {

  var selectedCar = $("#car_name").val();
  var pickupLocation = $("#airport_name_car").val();
  var pickUpDate = $("#pick-up-date").val();
  var pickUpTime = $("#pick-up-time").val();
  var divisionaName = $("#division_name").val();
  var districtName = $("#district_name_car").val();
  var thanaName = $("#thana_name_car").val();
  // var villageName = $("#village_name").val();
  var iaccept = $("#iaccept").is(':checked');

  var error = 0;

  if(validateNotEmpty(selectedCar)) { error = 1; }
  if(validateNotEmpty(pickupLocation)) { error = 1; }
  if(pickUpTime1 == 'HH') { error = 1; }
  if(pickUpTime2 == 'MM') { error = 1; }
  if(validateNotEmpty(divisionaName)) { error = 1; }
  if(validateNotEmpty(districtName)) { error = 1; }
  if(validateNotEmpty(thanaName)) { error = 1; }
  // if(validateNotEmpty(villageName)) { error = 1; }
  if(validateNotEmpty(iaccept)) { error = 2; }

  if(0 == error)
  {
    $("#car_name-ph").html(selectedCar);
    $("#car_name").val(selectedCar);

    $("#airport_name_car-ph").html(pickupLocation);
    $("#airport_name_car").val(pickupLocation);

    $("#iaccept-ph").html(iaccept);
    $("#iaccept").val(iaccept);
    
    $("#pick-up-date-ph").html(pickUpDate);
    $("#pick-up-time-ph").html(pickUpTime);

    // $("#village_name-ph").html(villageName);
    // $("#village_name").html(villageName);

    $("#pick-up").val(pickUpDate+' at '+pickUpTime);
    SessionClick.draw();
     e.preventDefault();
    $('#modal-with-tab').modal();

  }
  
  
  if(1 == error)
  {
    $('#car-select-form-msg').css('visibility','visible').hide().fadeIn().removeClass('hidden').delay(2000).fadeOut();
  }
  else if(2 == error)
  {
    $('#terms-condition').css('visibility','visible').hide().fadeIn().removeClass('hidden').delay(2000).fadeOut();
  }

  return false;
});


// Round Trip Car Select Form
//-------------------------------------------------------------------------------

$( "#car-select-form-rt" ).click(function() {
  var selectedCar = $("#car_name_rt").val();
  var pickupLocation = $("#airport_name_car_rt").val();
  var pickUpDate = $("#pick-up-date-rt").val();
  var pickUpTime1 = $("#time1_rt").val();
  var pickUpTime2 = $("#time2_rt").val();
  var divisionName = $("#division_name_rt").val();
  var districtName = $("#district_name_car_rt").val();
  var thanaName = $("#thana_name_car_rt").val();
  var villageName = $("#village_name_rt").val();
  let isChecked = $('#iaccept_rt').is(':checked');
  var error = 0;

  if(validateNotEmpty(selectedCar)) { error = 1;}
  if(validateNotEmpty(pickupLocation)) { error = 1; }
  if(pickUpTime1 == 'HH') { error = 1; }
  if(pickUpTime2 == 'MM') { error = 1; }
  // if(pickUpTime1 == 'ঘন্টা') { error = 1; }
  // if(pickUpTime2 == 'মিনিট') { error = 1; }
  if(validateNotEmpty(pickUpDate)) { error = 1; }
  if(validateNotEmpty(divisionName)) { error = 1; }
  if(validateNotEmpty(districtName)) { error = 1; }
  if(validateNotEmpty(thanaName)) { error = 1; }
  if(validateNotEmpty(villageName)) { error = 1; }
  if(validateNotEmpty(iaccept_rt)) { error = 1;}
  
  if(0 == error)
  {
    $("#car_name_rt-ph").html(selectedCar);
    $("#car_name_rt").val(selectedCar);
    
    $("#airport_name_car_rt-ph").html(pickupLocation);
    $("#airport_name_car_rt").val(pickupLocation);

    $("#iaccept_rt-ph").html(iaccept_rt);
    $("#iaccept_rt").val(iaccept_rt);
    
    $("#village_name_rt-ph").html(villageName);
    $("#village_name_rt").val(villageName);

    $("#pick-up-date-rt-ph").html(pickUpDate);

    $("#time1_rt-ph").html(pickUpTime1);
    $("#time1_rt").val(pickUpTime1);
    
    $("#time2_rt-ph").html(pickUpTime2);
    $("#time2_rt").val(pickUpTime2);
    
    $("#pick-up-rt").val(pickUpDate+' at '+pickUpTime1 +' at '+pickUpTime2);

    if(isChecked == true){
      var status = 'roundTrip';
      $("#trip_type").val(status);
      $("#trip_type").html(status);
      $('#checkoutModal').modal();
    }else{
      $('#terms-condition-rt').css('visibility','visible').hide().fadeIn().removeClass('hidden').delay(2000).fadeOut();
    }
  }
  else
  {
    $('#car-select-form-msg-rt').css('visibility','visible').hide().fadeIn().removeClass('hidden').delay(2000).fadeOut();
  }
  return false;
});


// Car Select Form
//-------------------------------------------------------------------------------

$( "#car-select-form" ).click(function() {

  var selectedCar = $("#car_name").val();
  var pickupLocation = $("#airport_name_car").val();
  var pickUpDate = $("#pick-up-date").val();
  var pickUpTime1 = $("#time1").val();
  var pickUpTime2 = $("#time2").val();
  var divisionaName = $("#division_name").val();
  var districtName = $("#district_name_car").val();
  var thanaName = $("#thana_name_car").val();
  // var villageName = $("#village_name").val();
  // var iaccept = $("#iaccept").prop(':checked');
  let isChecked = $('#iaccept').is(':checked');
  console.log(isChecked);
  var error = 0;

  if(validateNotEmpty(selectedCar)) { error = 1; }
  if(validateNotEmpty(pickupLocation)) { error = 1; }
  if(pickUpTime1 == 'HH') { error = 1; }
  if(pickUpTime2 == 'MM') { error = 1; }
  if(pickUpTime1 == 'ঘন্টা') { error = 1; }
  if(pickUpTime2 == 'মিনিট') { error = 1; }
  if(validateNotEmpty(pickUpDate)) { error = 1; }
  if(validateNotEmpty(divisionaName)) { error = 1; }
  if(validateNotEmpty(districtName)) { error = 1; }
  if(validateNotEmpty(thanaName)) { error = 1; }
  // if(validateNotEmpty(villageName)) { error = 1; }
  if(validateNotEmpty(iaccept)) { error = 1; }

  if(0 == error)
  {
    $("#car_name-ph").html(selectedCar);
    $("#car_name").val(selectedCar);

    $("#airport_name_car-ph").html(pickupLocation);
    $("#airport_name_car").val(pickupLocation);

    $("#iaccept-ph").html(iaccept);
    $("#iaccept").val(iaccept);
    // $("#village_name-ph").html(villageName);
    // $("#village_name").val(villageName);

    $("#pick-up-date-ph").html(pickUpDate);

    $("#time1-ph").html(pickUpTime1);
    $("#time1-").val(pickUpTime1);
    
    $("#time2-ph").html(pickUpTime2);
    $("#time2-").val(pickUpTime2);

    $("#pick-up").val(pickUpDate+' at '+pickUpTime1 +' at '+pickUpTime2);

    if(isChecked == true){
      $('#checkoutModal').modal();
    }else{
      $('#terms-condition').css('visibility','visible').hide().fadeIn().removeClass('hidden').delay(2000).fadeOut();
    }
  }
  else
  {
    $('#car-select-form-msg').css('visibility','visible').hide().fadeIn().removeClass('hidden').delay(2000).fadeOut();
  }  

  return false;
});

$('#payment_method').on('change', function() {
  // alert( "Please fill up all required field" ); // or $(this).val()
     if(this.value == "wallet") {
         $('#wallet_div').show();
         $('#wallet_div2').show();
         $('#wallet_payment').show();
         $('#passport').hide();
         $('#visa_master_card').hide();
         $('#nagad_payment').hide();
         $('#bkash_payment').hide();
         $('#wallet_cpg').show();
         $('#nagad_cpg').hide();
         $('#bkash_cpg').hide();
         $('#visa_cpg').hide();
         $('#wallet_cpg_subtotal').show();
         $('#nagad_cpg_subtotal').hide();
         $('#bkash_cpg_subtotal').hide();
         $('#visa_cpg_subtotal').hide();
         $('#Draft_Wallet').show();
         $('#Draft_BDTFair').hide();
         $('#Draft_USDFare').hide();
         var sum1 = parseFloat($('#current_wallet').val());
        console.log(sum1); // Or parseInt if integers only
        var sum2 = parseFloat($('#fare').val());
        
        console.log(sum2); // Or parseInt if integers only
        $('#new_balance').val(sum2 - sum1);
        console.log($('#new_balance').val(sum2 - sum1))
        
        var mybalance           = document.getElementById("myBalance").value;
        var farefinal                = document.getElementById("fare2").value;
        var res = parseFloat(farefinal.replace( /[^\d\.]*/g, ''));
        var newbalance  = parseFloat(mybalance) - parseFloat(res);
          
        if(newbalance >= 0){
          $("#newBalance").html('<?php echo $currency; ?> ' +newbalance);
          $('#recharge-submit').hide();
          $('#booking-submit').show();


        }else{
          $("#newBalance").html("Insufficient Balance!");
          $('#booking-submit').hide();
          $('#recharge-submit').show();


        }

     } else if(this.value == "nagad") {
      $('#wallet_div').hide();
      $('#wallet_div2').hide();
      $('#passport').hide();
      $('#visa_master_card').hide();
      $('#wallet_payment').hide();
      $('#bkash_payment').hide();
      $('#nagad_payment').show();
      $('#coupon_section').show();
      $('#wallet_cpg').hide();
      $('#nagad_cpg').show();
      $('#bkash_cpg').hide();
      $('#visa_cpg').hide();
      $('#wallet_cpg_subtotal').hide();
      $('#nagad_cpg_subtotal').show();
      $('#bkash_cpg_subtotal').hide();
      $('#visa_cpg_subtotal').hide();
      $('#Draft_Wallet').hide();
      $('#Draft_BDTFair').show();
      $('#Draft_USDFare').hide();
      
      var sum1 = parseFloat($('#current_wallet').val());
     console.log(sum1); // Or parseInt if integers only
     var sum2 = parseFloat($('#fare').val());
     
     console.log(sum2); // Or parseInt if integers only
     $('#new_balance').val(sum2 - sum1);
     console.log($('#new_balance').val(sum2 - sum1))
     $('#recharge-submit').hide();
     $('#booking-submit').show();

   

  }else if(this.value == "bkash") {
    $('#wallet_div').hide();
    $('#wallet_div2').hide();
    $('#passport').hide();
    $('#visa_master_card').hide();
    $('#wallet_payment').hide();
    $('#bkash_payment').show();
    $('#nagad_payment').hide();
    $('#coupon_section').show();
    $('#wallet_cpg').hide();
    $('#nagad_cpg').hide();
    $('#bkash_cpg').show();
    $('#visa_cpg').hide();
    $('#wallet_cpg_subtotal').hide();
    $('#nagad_cpg_subtotal').hide();
    $('#bkash_cpg_subtotal').show();
    $('#visa_cpg_subtotal').hide();
    $('#Draft_Wallet').hide();
    $('#Draft_BDTFair').show();
    $('#Draft_USDFare').hide();

    var sum1 = parseFloat($('#current_wallet').val());
   console.log(sum1); // Or parseInt if integers only
   var sum2 = parseFloat($('#fare').val());
   
   console.log(sum2); // Or parseInt if integers only
   $('#new_balance').val(sum2 - sum1);
   console.log($('#new_balance').val(sum2 - sum1))
   $('#recharge-submit').hide();
   $('#booking-submit').show();
 

}else if(this.value == "visa_master_card"){

    $('#wallet_div').hide();
      $('#wallet_div2').hide();
      $('#passport').hide();
      $('#wallet_payment').hide();
      $('#nagad_payment').hide();
      $('#bkash_payment').hide();
      $('#coupon_section').show();
      $('#visa_master_card').show();
      $('#wallet_cpg').hide();
      $('#nagad_cpg').hide();
      $('#bkash_cpg').hide();
      $('#visa_cpg').show();
      $('#wallet_cpg_subtotal').hide();
      $('#nagad_cpg_subtotal').hide();
      $('#bkash_cpg_subtotal').hide();
      $('#visa_cpg_subtotal').show();
      $('#Draft_Wallet').hide();
      $('#Draft_BDTFair').hide();
      $('#Draft_USDFare').show();
      
      var sum1 = parseFloat($('#current_wallet').val());
     console.log(sum1); // Or parseInt if integers only
     var sum2 = parseFloat($('#fare').val());
     
     console.log(sum2); // Or parseInt if integers only
     $('#new_balance').val(sum2 - sum1);
     console.log($('#new_balance').val(sum2 - sum1))
     $('#recharge-submit').attr('hidden','hidden');
     $('#booking-submit').show();
  }else{
    $('#wallet_div').hide();
    $('#wallet_div2').hide();
    $('#passport').hide();
    $('#wallet_payment').hide();
    $('#nagad_payment').hide();
    $('#coupon_section').hide();
    $('#visa_master_card').hide();
    $('#bkash_payment').hide();
    $('#wallet_cpg').hide();
    $('#nagad_cpg').hide();
    $('#bkash_cpg').hide();
    $('#visa_cpg').hide();
    $('#wallet_cpg_subtotal').hide();
    $('#nagad_cpg_subtotal').hide();
    $('#bkash_cpg_subtotal').hide();
    $('#visa_cpg_subtotal').hide();
    $('#recharge-submit').hide();
    $('#booking-submit').hide();
    // $('#Draft_Wallet').hide();
    $('#Draft_BDTFair').hide();
    $('#Draft_USDFare').hide();
  }
 });
 $(document).ready(function(){

  $('#wallet_div').hide();
    $('#wallet_div2').hide();
    $('#passport').hide();
    $('#wallet_payment').show();
    $('#nagad_payment').hide();
    $('#coupon_section').hide();
    $('#visa_master_card').hide();
    $('#bkash_payment').hide();
    $('#wallet_cpg').hide();
    $('#nagad_cpg').hide();
    $('#bkash_cpg').hide();
    $('#visa_cpg').hide();
    $('#wallet_cpg_subtotal').hide();
    $('#nagad_cpg_subtotal').hide();
    $('#bkash_cpg_subtotal').hide();
    $('#visa_cpg_subtotal').hide();
    $('#recharge-submit').hide();
    $('#booking-submit').hide();
    // $('#Draft_Wallet').hide();
    $('#Draft_BDTFair').hide();
    $('#Draft_USDFare').hide();
 })
// Check Out Form

//------------------ checkout modal validation ---------------------------

$( "#next-step-1" ).click(function() {


  var first_name        = $("#first_name").val();
  var last_name         = $("#last_name").val();
  var dob_dd            = $("#dob_dd").val();
  var dob_mm            = $("#dob_mm").val();
  var dob_yyyy          = $("#dob_yyyy").val();
  var nationality       = $("#nationality").val();
  var passport_number   = $("#passport_number").val();
  var mobile_number     = $("#mobile_number").val();
  var email             = $("#email").val();
  // var airlines_name     = $("#airlines_name").val();
  // var flight_date       = $("#flight_date").val();
  // var flight_time       = $("#flight_time").val();
  // var flight_number     = $("#flight_number").val();
  // var departure_time    = $("#departure_time").val();
  // var ticket_number     = $("#ticket_number").val();
  // var departure_country = $("#departure_country").val();
  // var relative_name     = $("#relative_name").val();
  // var relative_mobile1  = $("#relative_mobile1").val();
  // var payment_method    = $("#payment_method").val();
  // var fare2             = $("#fare2").val();

  var error = 0;

  if(validateNotEmpty(first_name)) { error = 1; }
  if(validateNotEmpty(last_name)) { error = 1; }
  if(validateNotEmpty(dob_dd)) { error = 1; }
  if(validateNotEmpty(dob_mm)) { error = 1; }
  if(validateNotEmpty(dob_yyyy)) { error = 1; }
  if(validateNotEmpty(nationality)) { error = 1; }
  if(validateNotEmpty(passport_number)) { error = 1; }
  if(validateNotEmpty(mobile_number)) { error = 1; }
  if(validateNotEmpty(email)) { error = 1; }
  // if(validateNotEmpty(airlines_name)) { error = 1; }
  // if(validateNotEmpty(flight_date)) { error = 1; }
  // if(validateNotEmpty(flight_time)) { error = 1; }
  // if(validateNotEmpty(flight_number)) { error = 1; }
  // if(validateNotEmpty(departure_time)) { error = 1; }
  // if(validateNotEmpty(ticket_number)) { error = 1; }
  // if(validateNotEmpty(departure_country)) { error = 1; }
  // if(validateNotEmpty(relative_name)) { error = 1; }
  // if(validateNotEmpty(relative_mobile1)) { error = 1; }
  // if(validateNotEmpty(payment_method)) { error = 1; }
  // if(validateNotEmpty(fare2)) { error = 1; }

  if(0 == error)
  {
    $("#first_name-ph").html(first_name);
    $("#first_name").val(first_name);

    $("#last_name-ph").html(last_name);
    $("#last_name").val(last_name);

    $("#dob_dd-ph").html(dob_dd);
    $("#dob_dd").val(dob_dd);

    $("#dob_mm-ph").html(dob_mm);
    $("#dob_mm").val(dob_mm);

    $("#dob_yyyy-ph").html(dob_yyyy);
    $("#dob_yyyy").val(dob_yyyy);

    $("#nationality-ph").html(nationality);
    $("#nationality").val(nationality);

    $("#passport_number-ph").html(passport_number);
    $("#passport_number").val(passport_number);

    $("#mobile_number-ph").html(mobile_number);
    $("#mobile_number").val(mobile_number);

    $("#email-ph").html(email);
    $("#email").val(email);

    

    // $("#relative_name-ph").html(selectedCar);
    // $("#relative_name").val(selectedCar);

    // $("#relative_mobile1-ph").html(selectedCar);
    // $("#relative_mobile1").val(selectedCar);

    // $("#payment_method-ph").html(selectedCar);
    // $("#payment_method").val(selectedCar);

    // $("#fare2-ph").html(selectedCar);
    // $("#fare2").val(selectedCar);
    
    // $("#pick-up-date-ph").html(pickUpDate);
    // $("#pick-up-time-ph").html(pickUpTime);
    // $("#pick-up").val(pickUpDate+' at '+pickUpTime); 
   //alert('in');
   $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

    var $target = $(e.target);

    if ($target.parent().hasClass('disabled')) {
        return false;
    }
});

  var $active = $('.wizard .nav-tabs li.active ');
 
  $active.next().removeClass('disabled');
  nextTab($active);



  

  }
  else
  {
    alert('Please fill up all required field');
  }  

  return false;
});

//-----------------step2 validation-----------------
$( "#next-step-2" ).click(function() {


  
  var airlines_name     = $("#airlines_name").val();
  var flight_date       = $("#flight_date").val();
  var flight_hour       = $("#flight_hour").val();
  var flight_minitue    = $("#flight_minitue").val();
  var flight_number     = $("#flight_number").val();
  var departure_hour    = $("#departure_hour").val();
  var departure_minitue = $("#departure_minitue").val();
  var ticket_number     = $("#ticket_number").val();
  var departure_country = $("#departure_country").val();
  // var relative_name     = $("#relative_name").val();
  // var relative_mobile1  = $("#relative_mobile1").val();
  // var payment_method    = $("#payment_method").val();
  // var fare2             = $("#fare2").val();

  var error = 0;

  
  if(validateNotEmpty(airlines_name)) { error = 1; }
  if(validateNotEmpty(flight_date)) { error = 1; }
  if(validateNotEmpty(flight_hour)) { error = 1; }
  if(validateNotEmpty(flight_minitue)) { error = 1; }
  if(validateNotEmpty(flight_number)) { error = 1; }
  if(validateNotEmpty(departure_hour)) { error = 1; }
  if(validateNotEmpty(departure_minitue)) { error = 1; }
  if(validateNotEmpty(ticket_number)) { error = 1; }
  if(validateNotEmpty(departure_country)) { error = 1; }
  // if(validateNotEmpty(relative_name)) { error = 1; }
  // if(validateNotEmpty(relative_mobile1)) { error = 1; }
  // if(validateNotEmpty(payment_method)) { error = 1; }
  // if(validateNotEmpty(fare2)) { error = 1; }

  if(0 == error)
  {
    

    $("#airlines_name-ph").html(airlines_name);
    $("#airlines_name").val(airlines_name);

    $("#flight_date-ph").html(flight_date);
    $("#flight_date").val(flight_date);

    $("#flight_hour-ph").html(flight_hour);
    $("#flight_hour").val(flight_hour);

    $("#flight_minitue-ph").html(flight_minitue);
    $("#flight_minitue").val(flight_minitue);

    $("#flight_number-ph").html(flight_number);
    $("#flight_number").val(flight_number);

    $("#departure_hour-ph").html(departure_hour);
    $("#departure_hour").val(departure_hour);

    $("#departure_minitue-ph").html(departure_minitue);
    $("#departure_minitue").val(departure_minitue);

    $("#ticket_number-ph").html(ticket_number);
    $("#ticket_number").val(ticket_number);

    $("#departure_country-ph").html(departure_country);
    $("#departure_country").val(departure_country);

    // $("#relative_name-ph").html(selectedCar);
    // $("#relative_name").val(selectedCar);

    // $("#relative_mobile1-ph").html(selectedCar);
    // $("#relative_mobile1").val(selectedCar);

    // $("#payment_method-ph").html(selectedCar);
    // $("#payment_method").val(selectedCar);

    // $("#fare2-ph").html(selectedCar);
    // $("#fare2").val(selectedCar);
    
    // $("#pick-up-date-ph").html(pickUpDate);
    // $("#pick-up-time-ph").html(pickUpTime);
    // $("#pick-up").val(pickUpDate+' at '+pickUpTime); 
   //alert('in');
   $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

    var $target = $(e.target);

    if ($target.parent().hasClass('disabled')) {
        return false;
    }
});

  var $active = $('.wizard .nav-tabs li.active ');
 
  $active.next().removeClass('disabled');
  nextTab($active);


  

  }
  else
  {
    alert('Please fill up all required field');
  }  

  return false;
});

$("#next-step-3" ).click(function() {


  
  
  var relative_name     = $("#relative_name").val();
  var relative_mobile1  = $("#relative_mobile1").val();
  // var payment_method    = $("#payment_method").val();
  // var fare2             = $("#fare2").val();

  var error = 0;

  
  
  if(validateNotEmpty(relative_name)) { error = 1; }
  if(validateNotEmpty(relative_mobile1)) { error = 1; }
  // if(validateNotEmpty(payment_method)) { error = 1; }
  // if(validateNotEmpty(fare2)) { error = 1; }

  if(0 == error)
  {
    

   
     $("#relative_name-ph").html(relative_name);
     $("#relative_name").val(relative_name);

     $("#relative_mobile1-ph").html(relative_mobile1);
     $("#relative_mobile1").val(relative_mobile1);

    // $("#payment_method-ph").html(selectedCar);
    // $("#payment_method").val(selectedCar);

    // $("#fare2-ph").html(selectedCar);
    // $("#fare2").val(selectedCar);
    
    // $("#pick-up-date-ph").html(pickUpDate);
    // $("#pick-up-time-ph").html(pickUpTime);
    // $("#pick-up").val(pickUpDate+' at '+pickUpTime); 
   //alert('in');
   $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

    var $target = $(e.target);

    if ($target.parent().hasClass('disabled')) {
        return false;
    }
});

  var $active = $('.wizard .nav-tabs li.active ');
 
  $active.next().removeClass('disabled');
  nextTab($active);


  

  }
  else
  {
    alert('Please fill up all required field');
  }  

  return false;
});


//------------------ checkout modal validation end -----------------------

//-------------------------------------------------------------------------------

// $( "#checkoutModal" ).submit(function() {

//   $('#checkout-form-msg').addClass('hidden');
//   $('#checkout-form-msg').removeClass('alert-success');
//   $('#checkout-form-msg').removeClass('alert-danger');

//   $('#checkout-form input[type=submit]').attr('disabled', 'disabled');

//   $.ajax({
//     type: "POST",
//     url: "{{ route('carBookForm')}}",
//     data: $("#checkout-form").serialize(),
//     dataType: "json",
//     success: function(data) {

//       if('success' == data.result)
//       {
//         $('#checkout-form-msg').css('visibility','visible').hide().fadeIn().removeClass('hidden').addClass('alert-success');
//         $('#checkout-form-msg').html(data.msg[0]);
//         $('#checkout-form input[type=submit]').removeAttr('disabled');

//         setTimeout(function(){
//           $('.modal').modal('hide');
//           $('#checkout-form-msg').addClass('hidden');
//           $('#checkout-form-msg').removeClass('alert-success');

//           $('#checkout-form')[0].reset();
//           $('#car-select-form')[0].reset();
//         }, 5000);

//       }

//       if('error' == data.result)
//       {
//         $('#checkout-form-msg').css('visibility','visible').hide().fadeIn().removeClass('hidden').addClass('alert-danger');
//         $('#checkout-form-msg').html(data.msg[0]);
//         $('#checkout-form input[type=submit]').removeAttr('disabled');
//       }

//     }
//   });

// return false;
// });



// Not Empty Validator Function
//-------------------------------------------------------------------------------

function validateNotEmpty(data){
  if (data == ''){
    return true;
  }else{
    return false;
  }
}

// $(document).ready(function(){

//   $(".tabs").click(function(){
  
//   $(".tabs").removeClass("active");
//   $(".tabs h6").removeClass("font-weight-bold");
//   $(".tabs h6").addClass("text-muted");
//   $(this).children("h6").removeClass("text-muted");
//   $(this).children("h6").addClass("font-weight-bold");
//   $(this).addClass("active");
  
//   current_fs = $(".active");
  
//   next_fs = $(this).attr('id');
//   next_fs = "#" + next_fs + "1";
  
//   $("fieldset").removeClass("show");
//   $(next_fs).addClass("show");
  
//   current_fs.animate({}, {
//   step: function() {
//   current_fs.css({
//   'display': 'none',
//   'position': 'relative'
//   });
//   next_fs.css({
//   'display': 'block'
//   });
//   }
//   });
//   });
  
//   });

const loginText = document.querySelector(".title-text .login");
const loginForm = document.querySelector("form.login");
const loginBtn = document.querySelector("label.login");
const signupBtn = document.querySelector("label.signup");
const signupLink = document.querySelector("form .signup-link a");
signupBtn.onclick = (()=>{
loginForm.style.marginLeft = "-50%";
loginText.style.marginLeft = "-50%";
});
loginBtn.onclick = (()=>{
loginForm.style.marginLeft = "0%";
loginText.style.marginLeft = "0%";
});
signupLink.onclick = (()=>{
signupBtn.click();
return false;
});





$(".draftButton").change(function() {
  if(this.checked) {
      $('#booking-submit').text('Save to Draft');
  }
else
  {
      $('#booking-submit').text('Complete Booking');
  }
});

$(document).ready(function() {
  $('#submitDraft').click(function() {
      $('#draftvalu').val('draft');
  })
});


$(document).ready(function() {
  $('#submitDraft1').click(function() {
      $('#draftvalu').val('draft');
  })
});

$(document).ready(function() {
  $('#submitDraft2').click(function() {
      $('#draftvalu').val('draft');
  })
});

$(document).ready(function() {
  $('#submitDraft3').click(function() {
      $('#draftvalu').val('draft');
  })
});