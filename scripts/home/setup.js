$("#validationCustomPassword").on("focusout", function () {
  if ($(this).val() != $("#password2").val()) {
      $("#validationCustomPassword2").removeClass("is-valid").addClass("is-invalid");
  } else {
      $("#validationCustomPassword2").removeClass("is-invalid").addClass("is-valid");
  }
  });
  
  $("#validationCustomPassword2").on("keyup", function () {
  if ($("#validationCustomPassword").val() != $(this).val()) {
      $(this).removeClass("is-valid").addClass("is-invalid");
  } else {
      $(this).removeClass("is-invalid").addClass("is-valid");
  }
});

(function() {
    'use strict';
    window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('keypress', function(event) {
          if (form.checkValidity() === true) {
            $('#submit').prop("disabled", false); 
          } else {
            $('#submit').prop("disabled", true); 
          }
        });
        form.addEventListener('submit', function(event) {
          
          if (form.checkValidity() === false) {
            
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();