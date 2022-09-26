(function(window, document, KB, $){
    // Add Class
    $("body").addClass("TR");

    // Replace Logo
    if (document.querySelector("header .logo > a")){
        document.querySelector("header .logo > a").innerHTML = '<img src="/assets/img/favicon.png" />';
    }

    //assignee and action select
    KB.on('modal.afterRender',function(){
        $("#form-owner_id").select2();
        $("#form-action_name").select2();
    });

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
    
})(window, document, KB, jQuery);
