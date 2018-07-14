function App(config) {
    /**
     * Properties declaration goes here
     * 
     */
    _this = {};
    config = (typeof (config) == 'object') ? config : {};
    _this.config = Object.assign({
        canvasId: 'myCanvas',
        imgId: 'myImg',
        canvasHeight: window.innerHeight,
        canvasWidth: window.innerWidth,
    }, config);
    $canvas = document.getElementById(_this.config.canvasId);
    $img = document.getElementById(_this.config.imgId);

    /**
     * Start application
     * 
     */
    this.play = function(){
        setViewport();
        drawBackground();
    }

    /**
     * Pause application
     */
    this.pause = function(){

    }
    /**
     * Stop application
     */
    this.stop = function(){

    }
    
    /**
     * Draw background
     * 
     */
    drawBackground = function () {
        var ctx = $canvas.getContext("2d");
        ctx.drawImage($img, 
            0, 0,$img.width,$img.height,
            0, 0,_this.config.canvasWidth,_this.config.canvasHeight,
        );
    }

    /**
     * Draw zombie
     * 
     */
    drawZombie = function () {
        var ctx = $canvas.getContext("2d");
        ctx.drawImage($img, 
            0, 0,$img.width,$img.height,
            0, 0,_this.config.canvasWidth,_this.config.canvasHeight,
        );
    }

    /**
     * Set viewport
     * 
     * @param {integer} height height of canvas
     * @param {integer} width width of canvas
     */
    setViewport = function (height,width) {
        height = height || _this.config.canvasHeight;
        width = width || _this.config.canvasWidth;
        $canvas.height = height;
        $canvas.width = width;
    }
}