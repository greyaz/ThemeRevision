(function(document){
    // Sycn System Color Schema
    var currentThemeColor = getCurrentColorCookie();
    var mediaQueryListDark = window.matchMedia('(prefers-color-scheme: dark)');
    
    mediaQueryListDark.addEventListener('change', event => {
        syncColor(event);
    });
    window.addEventListener("load", event => {
        syncColor(mediaQueryListDark);
    })
    
    function syncColor(event){
        var url = "?controller=SyncController&action=sync&plugin=ThemeRevision&prefer="
        var color;
        event.matches ? color = "dark" : color = "light";
        
        fetch(url + color)
        .then(response => response.json())
        .then(data => {
            //console.log(data.reload, data.setting, color, currentThemeColor);
            if (data.setting == "auto" && (data.reload || color != currentThemeColor)){
                window.location.reload();
            }
        });
    }

    function getCurrentColorCookie(){
        return document.cookie.replace(/(?:(?:^|.*;\s*)CurrentColorScheme\s*\=\s*([^;]*).*$)|^.*$/, "$1");
    }
})(document);
