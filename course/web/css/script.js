$(function() {
var isMobile = {  
	Android: function() {  
	    return navigator.userAgent.match(/Android/i) ? true : false;  
	},  
	BlackBerry: function() {  
	    return navigator.userAgent.match(/BlackBerry/i) ? true : false;  
	},  
	iOS: function() {  
	    return navigator.userAgent.match(/iPhone|iPad|iPod/i) ? true : false;  
	},  
	Windows: function() {  
	    return navigator.userAgent.match(/IEMobile/i) ? true : false;  
	},  
	any: function() {  
	    return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Windows());  
	}  
};  
if(!isMobile.any() ){
	var z_max=0;

	var n = $('.books li').length;
	$('.books li').each(function(i){
		z = parseInt(Math.random()*20+1);
		if(z>z_max)z_max=z;
		$(this).css({
			"left":i/n*93+1+"%",
			"top":Math.random()*28+"%",
			"z-index": z,
		});
	})
	$('.books li').mouseover(function(){
		z_max++;
		$(this).css({
			"z-index": z_max,
		});
	})
}  
})