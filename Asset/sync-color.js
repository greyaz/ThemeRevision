// Sycn Local System's Color Scheme

(function(window, document, KB){
    var realScheme = getRealScheme();
    var mediaQueryListDark = window.matchMedia('(prefers-color-scheme: dark)');
    var isAuthPage = (document.location.search.indexOf("AuthController") >= 0);
    
    if (!isAuthPage){
        mediaQueryListDark.addEventListener('change', event => {
            syncColor(event);
        });
        window.addEventListener("load", event => {
            syncColor(mediaQueryListDark);
        })
    }
    
    function syncColor(isSysColorDark){
        var url = "?controller=SyncController&action=sync&plugin=ThemeRevision&prefer="
        var localScheme;
        isSysColorDark.matches ? localScheme = "dark" : localScheme =  "light";
        
        fetch(url+localScheme)
        .then(response => response.json())
        .then(data => {
            var status = {
                "reload": data.reload,
                "remoteScheme": data.remoteScheme,
                "localScheme": localScheme,
                "realScheme": realScheme
            }
            // console.table(status);
            
            if (status.remoteScheme == "auto" && (status.reload || status.localScheme != status.realScheme)){
                window.location.reload();
            }
        });
    }

    function getRealScheme(){
        return document.cookie.replace(/(?:(?:^|.*;\s*)TR\.color\.scheme\.real\s*\=\s*([^;]*).*$)|^.*$/, "$1");
    }
})(window, document, KB);
