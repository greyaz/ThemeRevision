(function(window, document, KB, $, hljs){
    // Add Class
    document.querySelector("body").classList.add("TR");

    // Get Favicon
    var favicon = "/assets/img/favicon.png";
    if (document.querySelector("head link[rel='icon']")){
        favicon = document.querySelector("head link[rel='icon']").getAttribute("href");
    }

    // Login
    if (document.querySelector("body > .form-login")){
        var html = document.querySelector("body > .form-login").innerHTML;
        html = '<div class="page-header"></div><img class="logo" src="' + favicon + '">' + html;
        document.querySelector("body > .form-login").innerHTML = html;
    }

    // Replace Logo
    if (document.querySelector("header .logo > a")){
        document.querySelector("header .logo > a").innerHTML = '<img src="' + favicon + '" />';
    }

    // Init page Menu
    initMenu("section.sidebar-container > .sidebar");
    if (KB){
        KB.on('modal.afterRender', function(){
            // Init modal menu
            initMenu("#modal-overlay #modal-content section.sidebar-container > .sidebar");
            // add search box to select
            if ($){
                if (checkListSize($("#form-action_name"))){
                    $("#form-action_name").select2();
                }
                if (checkListSize($("#form-owner_id"))){
                    $("#form-owner_id").select2();
                    $(document).on("click", ".assign-me[data-target-id='form-owner_id']", function() {
                        $("#form-owner_id").trigger("change");
                    })
                }
            }
        });
        KB.on('dropdown.afterRender', function(){
            if ($){
                $dropdownMenu = $("#dropdown > ul.dropdown-submenu-open");
                // fix a bug that displays ghost spacing, compatible with firefox
                $dropdownMenu.children("li:not(.no-hover)").has("i.fa").css({
                    fontSize: 0
                });
                // add search box to dropdown menu
                if (checkListSize($dropdownMenu)){
                    $dropdownMenu.prepend('<li id="dropdown-search"><input tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" role="textbox"></li>');
                    $searchInput = $("#dropdown > ul.dropdown-submenu-open > #dropdown-search input");
                    $searchInput.on("click", function(event){
                        event.preventDefault();
                        event.stopImmediatePropagation();
                    });
                    $searchInput.on("keyup", searchKeyupHandler);
                }
            }
        });
    }
    
    // syntax highlight
    if (hljs){
        hljs.highlightAll();
    }

    // check list size
    function checkListSize($dropList){
        if ($dropList && $dropList.children(":not(.no-hover)").length > 25){
            return true;
        }
        return false;
    }
    // keyup event handler
    function searchKeyupHandler(){
        $(this).off("keyup");
        $searchList = $("#dropdown ul.dropdown-submenu-open li:not(.no-hover):not(#dropdown-search) > a");
        keyword = $(this).val();
        search($searchList, keyword, $(this));
    }

    // search function
    function search($searchList, keyword, $input){
        $searchList.each(function(){
            curentVal = $(this).text();
            if (keyword && curentVal.indexOf(keyword) < 0){
                $(this).parent().hide();
            }
            else {
                $(this).parent().show();
            }
        });
        curentInputVal = $input.val();
        if (curentInputVal == keyword){
            $input.on("keyup", searchKeyupHandler);
        }
        else{
            search($searchList, curentInputVal, $input);
        }
    }

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
