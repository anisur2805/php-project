(function () {
  $(document).ready(function () {
    // 		$('#login').on('click', function(){
    // 			$('#form01 h3').html('Login');
    // 			$('#action').val('login');
    // 		});

    // 		$('#register').on('click', function(){
    // 			$('#form01 h3').html('Register');
    // 			$('#action').val('register');
    // 		});
    // 	})
    $(".menu-item").on("click", function () {
      $(".helement").hide();
      var target = "#" + $(this).data("target");
      console.log(target);
      $(target).show();
    });

    $("#alphabets").on("change", function () {
      var char = $(this).val().toLowerCase();
      if ("all" == char) {
        $(".words-tbl tr").show();
        return true;
      }

      $(".words-tbl tr:gt(0)").hide();

      $(".words-tbl td")
        .filter(function () {
          return $(this).text().indexOf(char) == 0;
        })
        .parent()
        .show();
    });
  });
})(jQuery);

window.addEventListener("DOMContentLoaded", (e) => {
  var login = document.querySelector("#login");
  var register = document.querySelector("#register");
  var title = document.querySelector("#form01 h3");
  var action = document.querySelector("#action");

  login.addEventListener("click", function () {
    title.innerText = "Login";
    action.value = "login";
  });

  register.addEventListener("click", function () {
    title.innerText = "Register";
    action.value = "register";
  });
});
