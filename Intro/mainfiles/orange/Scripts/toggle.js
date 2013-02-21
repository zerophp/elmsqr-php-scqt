// toggle function 
$(document).ready(function(){$(".toggle").hover(function(){$(this).parent().addClass("hover");})

$('.ttip').hover(function(){
						  $(this).stop().animate({paddingLeft:'10px'},300);
						  },
						  function(){$(this).stop().animate({paddingLeft:0},300);
						  });
$(".toggle_div").hide();
$("h6.toggle").toggle(function(){$(this).addClass("active");},
												  function(){$(this).removeClass("active");});
$("h6.toggle").click(function(){$(this).next(".toggle_div").slideToggle();})
})