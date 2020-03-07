/* (function() {
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
  })(); */
$('#first-account').validate({
  rules : {
    email: {
      required: true,
      email: true
    },
    username: {
      required: true,
      minlength: 3
    },
    password: {
      required: true,
      minlength: 5
    },
    'confirm-password': {
      required: true,
      minlength: 6,
      equalTo: '#password'
    },
    'agree': {
      required: true,
      minlength: 1
    }
  },
  messages : {
    email: 'You must insert a valid email',
    username: {
      required: 'Please provide a username',
      minlength: 'Your username must have at least 3 characters'
    },
    password: {
      required: 'Please provide a password',
      minlength: 'Your password must be at least 6 characters long'
    },
    'confirm-password': {
      equalTo: 'Please enter the same password as above'
    },
    'agree': {
      required: 'You must accept our Terms & Conditions'
    }
  }
});  