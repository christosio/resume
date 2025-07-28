grecaptcha.ready(function() {
  grecaptcha.execute('6LcTiY8rAAAAAIB6FdAvY7Ae2XbiStQTdT2e1AX1', {action: 'submit'}).then(function(token) {
    // Pass token to your backend via form or AJAX
    console.log(token);
  });
});
document.getElementById('g-recaptcha-response').value = token;
