
$(document).ready(function () {
  $("#loginForm").validate({
    rules: {
      password: "required",
      email: {
        required: true,
        email: true
      }
    }
  });
});