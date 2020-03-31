window.onload = function (){
	var topButton = document.getElementById("topUp");
	topButton.onclick = function() { window.scroll({ top: 0, left: 0, behavior: 'smooth' }); };
	window.onscroll = function() {
		if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20)
		{ topButton.style.display = "block"; }
		else
		{ topButton.style.display = "none"; }
	}
};