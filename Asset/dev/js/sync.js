// Sync Local System's Color Scheme

(function(window, document, KB){
    var realScheme = getRealScheme();
    var mediaQueryListDark = window.matchMedia('(prefers-color-scheme: dark)');
    // var isAuthPage = (document.location.search.indexOf("AuthController") >= 0);

    // if (!isAuthPage){
        mediaQueryListDark.addEventListener('change', event => {
            syncColor(event);
        });
        window.addEventListener("load", event => {
            syncColor(mediaQueryListDark);
        })
    // }
    
    function syncColor(isSysColorDark){
        var url = "?controller=SyncController&action=sync&plugin=ThemeRevision&prefer="
        var localScheme = isSysColorDark.matches ? "dark" : "light";
        
        fetch(url+localScheme, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
        })
        .then(response => response.json())
        .then(data => {
            var status = {
                "reload": data.reload,
                "remoteScheme": data.remoteScheme,
                "localScheme": localScheme,
                "realScheme": realScheme
            }
            //console.table(status);
            if (status.remoteScheme == "auto" && (status.reload || status.localScheme != status.realScheme)){
                window.location.reload();
            }
        });
    }

    function getRealScheme(){
        var pattern = /TR\.color\.scheme\.real\s*\=\s*(light|dark)/g;
        var data = document.cookie.match(pattern);
        if (data == null){
            return "";
        }
        return data[data.length - 1].replace(pattern, "$1");
    }
})(window, document, KB);
