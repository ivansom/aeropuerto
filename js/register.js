$(function() {
  $('.error').hide();
  $('.alert').hide();
  $(".btn").click(function() {
    // validate and process form here
    b = true;
    $(".form-group").removeClass("has-error");
    $('.error').hide();
    $('.alert').hide();
	  var ticket = $("input#ticket").val();
		if (ticket == "") {
      $("label#ticket_error").show();
      $("input#ticket").focus();
      $("#ticket_control").addClass("has-error");
      b = false;
    }
		var name = $("input#name").val();
		if (name == "") {
      $("label#name_error").show();
      $("input#name").focus();
      $("#name_control").addClass("has-error");
      b = false;
    }
     var pass = $("input#pass").val();
    if (pass == "") {
      $("label#pass_error").show();
      $("input#pass").focus();
      $("#pass_control").addClass("has-error");
      b = false;
    }
		var bag = $("input#bag").val();
		if (bag == "") {
      $("label#bag_error").show();
      $("input#bag").focus();
      $("#bag_control").addClass("has-error");
      b = false;
    }

    if(!b) {
      return false;
    }
     var airline = $("#airline").val();
     var vuelo = $("#vuelo").val();
     var status = $("#status").val();
     var dataString = 'ticket='+ ticket + '&name=' + name + '&pass=' + pass + '&bag=' + bag + '&airline=' + airline + '&vuelo=' + vuelo + '&status=' + status;
  //alert (dataString);return false;
  $.ajax({
    type: "POST",
    url: "bin/register_ticket.php",
    data: dataString,
     beforeSend: function () {
                        $(".btn").button('loading').fadeIn(1500);
                },

    success: function(response) {
      if(response === "The passenger sucessfully register") {
        $('.alert-success').show();
      } else {
        $('#danger').html(response);
        $('.alert-danger').show();
      }
       $("#resultado").html(response);
      $(".btn").button('reset');
    }
  });
  return false
  });



});