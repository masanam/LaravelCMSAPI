
$(document).ready(function(){

    // Header Click Icon Arrow Dropdown
    $(".drop-arr").click(function(){
        if($(this).parent().hasClass("active")){
            $(this).parent().removeClass("active");
        } else{
            $("a.menu-name").parent().removeClass("active");
            $(this).parent().addClass("active");
        }
    });
    
    // Menu Membership For Desktop
    $(".menu-ship").click(function(){
        if($(this).parent().hasClass("active")){
            $(this).parent().removeClass("active");
        } else{
            $("div.menu-ship").parent().removeClass("active");
            $(this).parent().addClass("active");
        }
    });

    // Menu For Mobile
    $('.menu-humberger').click(function () {
        $('.main-header').toggleClass('active overflow-hidden');
        $('body').toggleClass('overflow-hidden');
    });

    // Menu Membership For Mobile
    $('#open-shipmenu').click(function () {
        $('.all-menu-ship').addClass('active');
    });

    // Menu Membership For Mobile
    $('#close-shipmenu').click(function () {
        $('.all-menu-ship').removeClass('active');
    });

    // Search
    // var search
    // $('body:not(.search-warp)').click(function () {
    //     // if (search > 1) {
    //     //     $('.search-warp').removeClass('active').find('input').val('');
    //     // }
    //     // search++
    // })
    
    // Search Dummy
    $('.searchly').click(function () {
        $('.search-warp').toggleClass('active');
    })

    $('#search-header').keypress(function (){
        var input, filter, ulwarp, list, ahref, i, txtValue;
        input = document.getElementById("search-header");
        filter = input.value.toUpperCase();
        ulwarp = document.getElementById("myResult");
        if(filter.length === 0 ){
            ulwarp.style.display = "none";
        }else{
            ulwarp.style.display = "";
        }
        list = ulwarp.getElementsByTagName("li");
        for (i = 0; i < list.length; i++) {
            ahref = list[i].getElementsByTagName("a")[0];
            txtValue = ahref.textContent || ahref.innerText;
            // console.log(txtValue);
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                list[i].style.display = "";
            }
            else {
                list[i].style.display = "none";
            }
        }
    });

    // $('.search-mobile, .search').click(function () {
    //     search = 0
    //     $('.search-warp').addClass('active');
    // });

    // Footer
    $("#scroll-up").click(function() {
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    });
    
    // Previous Page
    // $("#page-prev").click(function (){
    //     window.history.back();
    //     return false;
    // });

    // Count Notif 
    if(parseInt($("#count-notif").html()) >= 99){
        let takeHtml = '99'
        $("#count-notif").html( takeHtml + '+')
    };

    // Click Notif Icon
    $('#notif-icon').click(function(){
       $('.notification').toggleClass('active')
    });

    // Select
    $('.js-example-basic-single').select2();

    //accordion
    $('.accordion .card').on('show.bs.collapse', function () {
        $(this).addClass('active')
    });
    $('.accordion .card').on('hidden.bs.collapse', function () {
        $(this).removeClass('active')
    });
    
    // Pop Up - Close
    $(document).on('click', '[data-dismis]', function(e){
        e.preventDefault();
        $('body').removeClass('.overflow-hidden');
        $(this).parents('.warp-pop-up').removeClass('showing');
        setTimeout(() => {
            $(this).parents('.warp-pop-up, .warp-pop-up > div').removeClass('show');        
        }, 500);
    });

    // Pop Up - Show
    $(document).on('click', '[data-modal]', function (e){
        e.preventDefault();
        
        $('body').addClass('.overflow-hidden');
        var el = $(this).data('target');
        
        // massage popup scroll
        $('.warp-pop-up'+el+'').addClass('show');
        setTimeout( function(){
            $('.warp-pop-up'+el+'').addClass('showing');
            $('.warp-pop-up'+el+' > div').addClass('show');
        }, 500);
    });

    // Mouse Hover on input file (for pengaduan pop up)
    $("#file-pengaduan").on("mouseenter", function () {
        $(".custom-file-label").toggleClass("hover");
    }).on("mouseleave", function () {
        $(".custom-file-label").toggleClass("hover");
    });
    $("#file-pengaduan").change(function() {
        var files = this.files;
        $('label[for="file-pengaduan"]').text(files[0].name);
    });

});

// Overlay Loading
$(window).on('load', function () {
    $('#overlay-loading').fadeOut("slow");
    new WOW().init();
    setTimeout(() => {
     $('body,html').css('overflow','initial');
    }, 500);
});

// Header Sticky On Scroll
$(window).scroll(function() {
    if ($(this).scrollTop() > 1) {
        $('.main-header').addClass("sticky");
    } else {
        $('.main-header').removeClass("sticky");
    }
});

// Smooth Scroll On Click Menu Header With ID
$(document).on('click', '.menu-md a[href*="#"]', function() {
    var hash = $(this.hash);
    var to =  $(hash).offset().top-100;
    // Using jQuery's animate() method to add smooth page scroll
    $('html, body').animate({
        scrollTop: to 
    }, 1000);
    // Prevent default anchor click behavior
    return false;
});

$(window).on("load", function () {
    var urlHash = window.location.href.split("#")[1];
    if (urlHash &&  $('#' + urlHash).length )
        $('html,body').animate({
            scrollTop: $('#' + urlHash).offset().top-100
        }, 1000);
});

// for mobile close header when click menu header href with id
$(window).on('resize', function(){
    if($(window).width() <= 1024){
        $('.menu-md a[href*="#"]').click(function(){
            $('.main-header').removeClass('active overflow-hidden');
            $('body').removeClass('overflow-hidden');
        });
    }
});

// for mobile close header when click menu header href with id
if($(window).width() <= 1024){
    $('.menu-md a[href*="#"]').click(function(){
        $('.main-header').removeClass('active overflow-hidden');
        $('body').removeClass('overflow-hidden');
    });
};

// function validation from boostrap
 (function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();


// Google Analytics: change UA-XXXXX-X to be your site's ID.
// (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
// function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
// e=o.createElement(i);r=o.getElementsByTagName(i)[0];
// e.src='//www.google-analytics.com/analytics.js';
// r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
// ga('create','UA-XXXXX-X','auto');ga('send','pageview');


// captcha required
$(window).on("load", function () {
    var $recaptcha = document.querySelector('#g-recaptcha-response');

    if($recaptcha) {
        $recaptcha.setAttribute("required", "required");
    }
});

/* Sample function that returns boolean in case the browser is Internet Explorer */

// function isIE() {
//     ua = navigator.userAgent;
//     /* MSIE used to detect old browsers and Trident used to newer ones*/
//     var is_ie = ua.indexOf("MSIE ") > -1 || ua.indexOf("Trident/") > -1;
    
//     return is_ie; 
// }

// /* Create an alert to show if the browser is IE or not */
// if (isIE()){
//     document.getElementById('IE-check').style.display = "block"
// }else{
//     document.getElementById('IE-check').remove();
// }
