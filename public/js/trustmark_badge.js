(function() {

    // Localize jQuery variable
    var jQuery;
    
    /******** Load jQuery if not present *********/
    // if (window.jQuery === undefined || window.jQuery.fn.jquery !== '1.4.2') {
    //     var script_tag = document.createElement('script');
    //     script_tag.setAttribute("type","text/javascript");
    //     script_tag.setAttribute("src","https://www.fintech.id/img/js/jquery.min.js");
    //     if (script_tag.readyState) {
    //       script_tag.onreadystatechange = function () { // For old versions of IE
    //           if (this.readyState == 'complete' || this.readyState == 'loaded') {
    //               scriptLoadHandler();
    //           }
    //       };
    //     } else {
    //       script_tag.onload = scriptLoadHandler;
    //     }
    //     // Try to find the head, otherwise default to the documentElement
    //     (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag);
    // } else {
        // The jQuery version on the window is the one we want to use
        jQuery = window.jQuery;
        main();
    // }
    
    /******** Called once jQuery has loaded ******/
    function scriptLoadHandler() {
        // Restore $ and window.jQuery to their previous values and store the
        // new jQuery in our local jQuery variable
        jQuery = window.jQuery.noConflict(true);
        // Call our main function
        main(); 
    }
    
    /******** Our main function ********/
    function main() { 
        jQuery(document).ready(function($) { 
            /******* Load CSS *******/
            var idc = document.getElementById("data-company").value;
            var css_link = $("<link>", { 
                rel: "stylesheet", 
                type: "text/css", 
                href: "https://www.fintech.id/css/page/certificate.css" 
            });
            css_link.appendTo('head');          
    
            /******* Load HTML *******/
            $.ajax({
                url:'https://www.fintech.id/get_company_data?idc='+idc,
                type:'get',
                dataType:'json',
                processData: false,
                success:function(response){
                    console.log(response)
                    $.each(response,function(index,value){
                        const months = ["January", "February", "March","April", "May", "June", "July", "August", "September", "October", "November", "December"];
                        var current_datetime = new Date(value.validity);
                        var formatted_date = months[(current_datetime.getMonth())] + " " + current_datetime.getFullYear();

                        document.getElementById('widget-container').innerHTML += '<div class="square"><div class="logo"><img width="100%" src="https://www.fintech.id/img/logo.png" alt="logo-fintech"></div><div class="blue-bg"><div class="verif">'+value.status.title+'</div><h6 class="tgl">'+formatted_date+'</h6></div></div>';
                    });
    

                },
                    error: function( jqXhr, textStatus, errorThrown ){
                    console.log( errorThrown );
                }
            });

        });
    }
    
    })(); // We call our anonymous function immediately