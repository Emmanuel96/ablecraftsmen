$(function() {

    $("#bookingForm input,#bookingForm textarea").jqBootstrapValidation({
      preventSubmit: true,
      submitError: function($form, event, errors) {
        // additional error messages or events
      },
      submitSuccess: function($form, event) {
        event.preventDefault(); // prevent default submit behaviour
        // get values from FORM
        var name = $("input#bookingName").val();
        var phone = $("input#bookingPhone").val();
        var message = $("textarea#bookingMessage").val();
        var firstName = name; // For Success/Failure Message
        // Check for white space in name for Success/Fail message
        if (firstName.indexOf(' ') >= 0) {
          firstName = name.split(' ').slice(0, -1).join(' ');
        }

        $this = $("#bookingButton");
        $this.prop("disabled", true); // Disable submit button until AJAX call is complete to prevent duplicate messages
        $.ajax({
          url: "./bookartisans",
          type: 'GET',
          data: {
            name: name,
            phone: phone,
            message: message, 
            _token: '{{ csrf_token() }}'  
          },
          cache: false,
          success: function() {
            // Success message
            $('#success').html("<div class='alert alert-success' style = 'margin-top: 20px;'>");
            $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
              .append("</button>");
            $('#success > .alert-success')
              .append("<strong>Your booking has been completed. </strong>");
            $('#success > .alert-success')
              .append('</div>');

            //append the success div to the end of the modal 
            $('#bookingForm').append($('#success'));

             //clear the success div and then close the modal 
            setTimeout(function(){
              $('#success').remove();
              $('#bookArtisan').modal('hide'); 
             }, 5000);

            //clear all fields
            $('#bookingForm').trigger("reset");
          },
          error: function() {
           
            // Fail message
            $('#success').html("<div class='alert alert-danger' style = 'margin-top: 20px;'>");
            $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
              .append("</button>");
            $('#success > .alert-danger').append($("<strong>").text("Sorry " + firstName + ", this error may be as a result of network issues. Please try again. "));
            $('#success > .alert-danger').append('</div>');

            //append the success div to the end of the modal 
            $('#bookingForm').append($('#success'));
            
           
            //clear all fields
            $('#bookingForm').trigger("reset");
          },
          complete: function() {
            setTimeout(function() {
              $this.prop("disabled", false); // Re-enable submit button when AJAX call is complete
            }, 1000);
          }
        });
      },
      filter: function() {
        return $(this).is(":visible");
      },
    });
  
    $("a[data-toggle=\"tab\"]").click(function(e) {
      e.preventDefault();
      $(this).tab("show");
    });
  });
  
  /*When clicking on Full hide fail/success boxes */
  $('#name').focus(function() {
    $('#success').html('');
  });
  