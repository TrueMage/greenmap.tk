"use static";

let buttons0 = '<button id = "button_signup" onclick="GoTo(0)">BACK</button><button id = "button_signin" onclick="GoTo(1)">NEXT</button>';
let buttons1 = '<button id = "button_signup" onclick="GoTo(0)">BACK</button><button id = "button_signin" onclick="GoTo(2)">NEXT</button>';
let buttons2 = '<button id = "button_signup" onclick="GoTo(1)">BACK</button>';

function GoTo(stage){
  if(stage == 0){
    $(function(){
      $('.first_stage').removeClass( "hidden" );
      $('.second_stage').addClass( "hidden" );
      $('.third_stage').addClass( "hidden" );

      $('.buttons').html(buttons0);
      $('#button_signin').removeClass( "hidden" );
      $('button.submit').addClass( "hidden" );

      $('.ver').removeClass( "active" );
      $('.left').addClass( "active" );
    });
  }
  else if(stage == 1){
    $(function(){
      $('.first_stage').addClass( "hidden" );
      $('.second_stage').removeClass( "hidden" );
      $('.third_stage').addClass( "hidden" );

      $('.buttons').html(buttons1);
      $('#button_signin').removeClass( "hidden" );
      $('button.submit').addClass( "hidden" );

      $('.ver').removeClass( "active" );
      $('.center').addClass( "active" );
    });
  }
  else{
    $(function(){
      $('.first_stage').addClass( "hidden" );
      $('.second_stage').addClass( "hidden" );
      $('.third_stage').removeClass( "hidden" );

      $('.buttons').html(buttons2);
      $('button.submit').removeClass( "hidden" );

      $('.ver').removeClass( "active" );
      $('.right').addClass( "active" );
    });
  }
}