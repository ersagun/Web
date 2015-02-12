$(document).ready(function(){
 $("nav img").mouseover(function(){
    $(this).animate({height:"+=15", width:"+=15"},{duration:100});
  });
 $("nav img").mouseout(function(){
    $(this).animate({height:"-=15", width:"-=15"},{duration:100});
  });
});