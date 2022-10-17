(function(window, document, KB, $, hljs){
    // Add Class
    //$("body").addClass("TR");
    document.querySelector("body").classList.add("TR");

    // Login
    if (document.querySelector("body > .form-login")){
        var html = document.querySelector("body > .form-login").innerHTML;
        html = '<div class="page-header"></div><img class="logo" src="/assets/img/favicon.png">' + html;
        document.querySelector("body > .form-login").innerHTML = html;
    }

    // Replace Logo
    if (document.querySelector("header .logo > a")){
        document.querySelector("header .logo > a").innerHTML = '<img src="/assets/img/favicon.png" />';
    }

    //assignee and action select
    if ($ && KB){
        KB.on('modal.afterRender',function(){
            $("#form-owner_id").select2();
            $("#form-action_name").select2();
        });
    }

    //syntax highlight
    if (hljs){
        hljs.highlightAll();
    }

    // Page Menu
    initMenu("section.sidebar-container > .sidebar");

    // Modal Menu
    var observer = new MutationObserver(function(mutationsList, observer){
        for(let mutation of mutationsList) {
            if (mutation.type === 'childList' && 
                mutation.addedNodes.length > 0 &&
                mutation.addedNodes[0] == document.querySelector("#modal-overlay")
            ){
                initMenu("#modal-overlay #modal-content section.sidebar-container > .sidebar");
                break;
            }
            if (document.querySelector("#modal-overlay") &&
                (! document.querySelector("#modal-overlay .themeRevisionMenuBtn"))
            ){
                initMenu("#modal-overlay #modal-content section.sidebar-container > .sidebar");
                break;
            }
        }
    });
    observer.observe(document.body, {attributes: true, childList: true, subtree: true});

    // Menu Init Function
    function initMenu(menuQS){
        var menu = document.querySelector(menuQS);

        if (menu){
            var menuBtnCon = document.querySelector(menuQS).parentNode;

            if (menuBtnCon && (! menuBtnCon.querySelector(".themeRevisionMenuBtn"))){
                var menuBtn = document.createElement("span");
                menuBtn.innerHTML = '<div class="themeRevisionMenuBtn">&equiv;</div>';
                menuBtnCon.insertBefore(menuBtn, menu);
                
                menuBtn.querySelector(".themeRevisionMenuBtn").onclick = function(event){
                    event.stopPropagation();
                    if (menu.style.display != "block"){
                        menu.style.display = "block";
                    }
                    else {
                        menu.style.display = "";
                    }
                };
                document.body.onclick = function(){
                    if (menu.style.display == "block"){
                        menu.style.display = "";
                    }
                }
            }
        }
    }    
    
})(window, document, typeof KB == "undefined" ? null : KB, typeof jQuery == "undefined" ? null: jQuery, typeof hljs == "undefined" ? null: hljs); // compatible with public visit page
