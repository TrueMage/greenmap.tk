var buttonEdit = 0;
var buttonActive = 0;
var buttonlast = -1;

let settings =
  '<div class="inputs"> <input class="ps" placeholder="New E-mail" type="text" name="email_user"> <input class="ps" placeholder="Old Password" type="password" name="password_user"> <input class="ps" placeholder="New Password" type="password" name="password_user"> <input class="ps" placeholder="Verify Password" type="password" name="password_user"> </div> <div class="buttons"> <button type = "submit" id = "button_signup" name = "do_redict">Save</button> </div>';
let newpin =
  '<p class="errors"><?php if(!(empty($errors))) echo array_shift($errors); ?></p><form action="index.php" class = "addon" method = "POST"><div class="inputs"><input class="ps" placeholder="E-mail" type="text" name="email_user">"><input class="ps" placeholder="Password" type="password" name="password_user"></div><div class="buttons"><button type = "submit" id = "button_signup" name = "do_redict">SIGN UP</button><button type = "submit" id = "button_signin" name = "do_signin">SIGN IN</button></div></form>';
let quest_text = "";
let rep_text =
  '<p class="errors"><?php if(!(empty($errors))) echo array_shift($errors); ?></p><form action="index.php" class = "addon" method = "POST"><div class="inputs"><input class="ps" placeholder="Theme" type="text" name="rep_text">"><input class="rep_main" placeholder="Describe problem"></div><button type = "submit" id = "button_send" name = "do_send">SEND</button></form>';
let change_badge =
  '<button class="change_badge_icon_button" onclick="ShowChangeBadge()"><img class="badge change_badge_img" src="../../design/img/sites/change_badge.png"></button>';

function editprofile() {
  if (buttonEdit == 0) {
    $(function () {
      $(".ava").addClass("darkness");
      $(".ava_change").removeClass("hidden");
      $(".switch_badge_button").removeClass("hidden");
    });
    buttonEdit = 1;
  } else {
    $(function () {
      $(".ava").removeClass("darkness");
      $(".ava_change").addClass("hidden");
      $(".switch_badge_button").addClass("hidden");
    });
    buttonEdit = 0;
  }
}

function show(button) {
  if (
    (button == 0 && buttonActive == 0) ||
    (button == 0 && buttonlast != 0 && buttonActive == 1)
  ) {
    $(function () {
      $("#temp-box").html(settings);
    });
    $(function () {
      $("#temp-box").css("padding", "20px");
    });
    buttonActive = 1;
    buttonlast = 0;
  } else if (button == 0 && buttonActive == 1) {
    $(function () {
      $("#temp-box").html("");
    });
    $(function () {
      $("#temp-box").css("padding", "20px");
    });
    buttonActive = 0;
    buttonlast = -1;
  } else if (
    (button == 1 && buttonActive == 0) ||
    (button == 1 && buttonlast != 1 && buttonActive == 1)
  ) {
    $(function () {
      $("#temp-box").html(newpin);
    });
    $(function () {
      $("#temp-box").css("padding", "20px");
    });
    buttonActive = 1;
    buttonlast = 1;
  } else if (button == 1 && buttonActive == 1) {
    $(function () {
      $("#temp-box").html("");
    });
    $(function () {
      $("#temp-box").css("padding", "20px");
    });
    buttonActive = 0;
    buttonlast = -1;
  } else if (
    (button == 2 && buttonActive == 0) ||
    (button == 2 && buttonlast != 2 && buttonActive == 1)
  ) {
    $(function () {
      $("#temp-box").html(quest_text);
    });
    $(function () {
      $("#temp-box").css("padding", "20px");
    });
    buttonActive = 1;
    buttonlast = 2;
  } else if (button == 2 && buttonActive == 1) {
    $(function () {
      $("#temp-box").html("");
    });
    $(function () {
      $("#temp-box").css("padding", "20px");
    });
    buttonActive = 0;
    buttonlast = -1;
  } else if (
    (button == 3 && buttonActive == 0) ||
    (button == 3 && buttonlast != 3 && buttonActive == 1)
  ) {
    $(function () {
      $("#temp-box").html(rep_text);
    });
    $(function () {
      $("#temp-box").css("padding", "20px");
    });
    buttonActive = 1;
    buttonlast = 3;
  } else if (button == 3 && buttonActive == 1) {
    $(function () {
      $("#temp-box").html("");
    });
    $(function () {
      $("#temp-box").css("padding", "20px");
    });
    buttonActive = 0;
    buttonlast = -1;
  }
}

function showWinChange(state) {
  if (state == 0) {
    $(function () {
      $(".modal.changeAva").css("display", "none");
    });
  } else if (state == 1) {
    $(function () {
      $(".modal.changeAva").css("display", "block");
    });
  }
}

function showWinSwitch(state) {
  if (state == 0) {
    $(function () {
      $(".modal.switch").css("display", "none");
    });
  } else if (state == 1) {
    $(function () {
      $(".modal.switch").css("display", "block");
    });
  }
}
