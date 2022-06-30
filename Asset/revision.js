(function(document){
    // Replace Logo
    document.getElementsByTagName("header")[0].
    getElementsByClassName("logo")[0].
    getElementsByTagName("a")[0].innerHTML = '<img src="/assets/img/favicon.png" />';

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

    // Sycn System Color Schema
    var mediaQueryListDark = window.matchMedia('(prefers-color-scheme: dark)');

    mediaQueryListDark.addEventListener('change', event => {
        syncColor(event);
    });
    syncColor(mediaQueryListDark);
    
    function syncColor(event){
        document.cookie = "prefers_color_scheme=; expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/;";
        if (event.matches) {
            document.cookie="prefers_color_scheme=dark;path=/;";
        }
        else{
            document.cookie="prefers_color_scheme=light;path=/;"
        }
    }

    // Menu Init Function
    function initMenu(menuQS){
        var menu = document.querySelector(menuQS);

        if (menu){
            var menuBtnCon = document.querySelector(menuQS).parentNode;

            if (menuBtnCon && (! menuBtnCon.querySelector(".themeRevisionMenuBtn"))){
                var menuBtn = document.createElement("span");
                menuBtn.innerHTML = '<div class="themeRevisionMenuBtn">≡</div>';
                menuBtnCon.insertBefore(menuBtn, menu);
                
                menuBtn.querySelector(".themeRevisionMenuBtn").onclick = function(event){
                    event.stopPropagation();
                    if (menu.style.display != "block"){
                        menu.style.display = "block";
                    }
                    else {
                        menu.style.display = "";
                    }
                }
                document.body.onclick = function(){
                    if (menu.style.display == "block"){
                        menu.style.display = "";
                    }
                }
            }
        }
    }    
    
})(document);
