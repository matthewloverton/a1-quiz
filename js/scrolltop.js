// If the window is at the top go to the homepage, else go to the top of the page.
$(window).scroll(function(){
    if ($(window).scrollTop() === 0) {
        $("#logo").attr("href", "../index.php")
    }
    else{
        $("#logo").attr("href", "#page-top")
    }
})