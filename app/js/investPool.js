$(document).ready(function(){
	window.nav = {
		current: 1,
		settings:{
			duration: 600,
			motion: "110px",
			scale: 0.8,
			easing: "easeInOutQuart"
		},
		max: $(".pool-holder-page").length,
		init: function(){
			$("#pool-holder-page-1").css("display", "block");
			$(".pool-holder-page").not("#pool-holder-page-1").velocity({
				left: nav.settings.motion,				
				scale: nav.settings.scale,
				opacity: 0
			}, {
				duration: 0,
			});						
		},
		setNavButtons: function(){
			if(nav.current > 1){
				$("#pool-nav-left").css("display", "block").stop().velocity({opacity: 1}, {duration: 300});
			}else{
				$("#pool-nav-left").stop().velocity({opacity: 0}, {duration: 300});
				setTimeout(function(){
					if(nav.current <= 1){
						$("#pool-nav-left").css("display", "none");
					}
				}, 300);
			}

			if(nav.current < nav.max){
				$("#pool-nav-right").css("display", "block").stop().velocity({opacity: 1}, {duration: 300});
			}else{
				$("#pool-nav-right").stop().velocity({opacity: 0}, {duration: 300});
				setTimeout(function(){
					if(nav.current >= nav.max){
						$("#pool-nav-right").css("display", "none");
					}
				}, 300);
			}
		},
		next: function(){
			if(nav.current + 1 <= nav.max){
				
				var currentEl = $("#pool-holder-page-"+nav.current);
				currentEl.stop().velocity({
					left: "-"+nav.settings.motion,					
					scale: nav.settings.scale,
					opacity: 0
				},{
					duration: nav.settings.duration,
					easing: nav.settings.easing
				});

				setTimeout(function(){
					if( Number(currentEl.attr("id").substring(17)) !== nav.current ){
						currentEl.css("display", "none");
					}
				}, nav.settings.duration);

				nav.current++;
				$("#pool-holder-page-"+nav.current).css("display", "block");
				$("#pool-holder-page-"+nav.current).stop().velocity({
					left:"0px",					
					scale: 1,
					opacity: 1
				},{
					duration: nav.settings.duration,
					easing: nav.settings.easing
				});
			}
			this.setNavButtons();
		},
		back: function(){
			if(nav.current - 1 >= 1){
				var currentEl = $("#pool-holder-page-"+nav.current);
				currentEl.stop().velocity({
					left: nav.settings.motion,					
					scale: nav.settings.scale,
					opacity: 0
				},{
					duration: nav.settings.duration,
					easing: nav.settings.easing
				});

				setTimeout(function(){
					if( Number(currentEl.attr("id").substring(17)) !== nav.current ){
						currentEl.css("display", "none");
					}
				}, nav.settings.duration);

				nav.current--;

				$("#pool-holder-page-"+nav.current).css("display", "block");
				$("#pool-holder-page-"+nav.current).stop().velocity({
					left:"0px",					
					scale: 1,
					opacity: 1
				},{
					duration: nav.settings.duration,
					easing: nav.settings.easing
				});			
			}
			
			this.setNavButtons();
		
		}
	}

	nav.init();

	$(document).on("keydown", function(e){
		if(e.keyCode == 37){
			nav.back();
		}else if(e.keyCode == 39){
			nav.next();
		}
	});

	$("#pool-nav-right").click(function(){nav.next();});
	$("#pool-nav-left").click(function(){nav.back();});	
});