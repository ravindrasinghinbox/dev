function App(config) {
    /**
     * Properties declaration goes here
     * 
     */
    _this = {};
    config = (typeof (config) == 'object') ? config : {};
    _this.config = Object.assign({
        canvasId: 'canvas',
        imgId: 'bg',
        shootId: 'shoot',
        zombieId: 'zombie',
        canvasHeight: window.innerHeight,
        canvasWidth: window.innerWidth,
    }, config);
    $canvas = document.getElementById(_this.config.canvasId);
    $img = document.getElementById(_this.config.imgId);
    $zombie = document.getElementById(_this.config.zombieId);
    $zombie.buffer = 7;
    $zombie.skin = 1;
    $shoot = document.getElementById(_this.config.shootId);

    /**
     * Start application
     * 
     */
    this.play = function () {
        setViewport();
        drawBackground();
        drawZombie();
    }

    /**
     * Pause application
     */
    this.pause = function () {

    }
    /**
     * Stop application
     */
    this.stop = function () {

    }

    /**
     * Draw background
     * 
     */
    drawBackground = function () {
        var ctx = $canvas.getContext("2d");
        ctx.drawImage($img,
            0, 0, $img.width, $img.height,
            0, 0, _this.config.canvasWidth, _this.config.canvasHeight,
        );
    }

    /**
     * Draw zombie
     * 
     */
    drawZombie = function () {
        var ctx = $canvas.getContext("2d");
        var zombieWidth = 190;
        var zombieList = {};
        for (var i = 0; i < 25; i++) {
            var y = Math.round(Math.random() * $zombie.height);
            zombieList[y] = {
                x: Math.round(Math.random() * $zombie.buffer) * zombieWidth,
                y: y,
                canvasX:Math.round(Math.random() * $canvas.width)
            };
        }
        var obj = {};
        for (var i in zombieList) {
            obj = zombieList[i];

            var ratio = obj.y / $zombie.height;
            ctx.drawImage($zombie,
                obj.x, 0, zombieWidth, $zombie.height,
                obj.canvasX, 0,
                zombieWidth * ratio, $zombie.height * ratio,
            );
        }
    }

    /**
     * Set viewport
     * 
     * @param {integer} height height of canvas
     * @param {integer} width width of canvas
     */
    setViewport = function (height, width) {
        height = height || _this.config.canvasHeight;
        width = width || _this.config.canvasWidth;
        $canvas.height = height;
        $canvas.width = width;
    }

    /**
     * Shoot gun
     */
    this.shoot = function () {
        $shoot.currentTime = 0;
        $shoot.play();
    }

    showCoordinate = function (event) {
        // var x = event.clientX;
        // var y = event.clientY;
        // document.getElementById("coordinateX").style.top = y+'px';
        // document.getElementById("coordinateY").style.left = x+'px';

        // drawBackground();
        // var ctx = $canvas.getContext("2d");
        // var zombieWidth = 190;
        // var ratio = y/$zombie.height;
        // ctx.drawImage($zombie,
        //     0, 0, zombieWidth, $zombie.height,
        //     x, 0,
        //     zombieWidth*ratio, $zombie.height*ratio,
        // );
    }
}