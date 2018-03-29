
var require = function(){
    var request = Array();
    var callback;
    
    /**
    * Function used to load dynamic script
    * 
    * @param {type} files
    * @param {type} params
    * @returns {undefined}
    */
    this.require = function(files,callback)
    {
        files = (files instanceof  Array)?files:[files];
        files.forEach(function (src)
        {
            var script = document.createElement('script');
            script.type = "text/javascript";
            script.src = src;
            script.src += script.src.indexOf('.js')>=0?'':'.js';
            script.async = false;
            document.head.appendChild(script);

            if (script.readyState)
            {
                script.onreadystatechange = function(data)
                {
                    script.onreadystatechange = null;
                    callback();
                };
            }
            else
            {
                script.onload = function(data)
                {
                    callback();
                };
            }
        });
    };
    
    checkCall
};
window.require = require.require;