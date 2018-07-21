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
        updateIntervalTime: 60,
        updateIntervalStatus: undefined,
    }, config);
    $canvas = document.getElementById(_this.config.canvasId);
    $img = document.getElementById(_this.config.imgId);
    $zombie = document.getElementById(_this.config.zombieId);
    $zombie.buffer = 7;
    $zombie.skin = 1;
    $zombie.width = 188;
    $zombie.list = {};
    $shoot = document.getElementById(_this.config.shootId);


    /**
     * Init application
     * 
     */
    this.init = function () {
        setViewport();
        drawBackground();
        addZombie();
        // drawZombie();

        if (_this.config.updateIntervalStatus == undefined) {
            _this.config.updateIntervalStatus = setInterval(function () {
                this.animateZombie();
                this.drawBackground();
                this.drawZombie();
            }, _this.config.updateIntervalTime);
        }
    }


    /**
     * Start application
     * 
     */
    this.play = function () {
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
        let ctx = $canvas.getContext("2d");
        ctx.drawImage($img,
            0, 0, $img.width, $img.height,
            0, 0, _this.config.canvasWidth, _this.config.canvasHeight,
        );
    }

    /**
     * Add zombie
     * 
     */
    addZombie = function (limit) {
        limit = limit || 15;
        // Create zombie object
        for (let i = 0; i < limit; i++) {
            let y = Math.round(Math.random() * $canvas.height);
            let x = Math.round(Math.random() * $zombie.buffer) * $zombie.width;
            let canvasX = Math.round(Math.random() * ($canvas.width-$zombie.width));
            let canvasY = Math.round(Math.random() * ($canvas.height - $zombie.height));
            $zombie.list[y] = {
                x: x,
                y: y,
                canvas: {
                    x: canvasX,
                    y: canvasY
                }
            };
        }
    }
    /**
     * Draw zombie
     * 
     */
    drawZombie = function () {
        let ctx = $canvas.getContext("2d");
        // Drawing zombie
        let obj = {};
        for (let i in $zombie.list) {
            obj = $zombie.list[i];

            let ratio = 1;
            if (obj.y < $zombie.height) {
                ratio = obj.y / $zombie.height;
            }

            ctx.drawImage($zombie,
                obj.x, 0, $zombie.width, $zombie.height,
                obj.canvas.x, obj.canvas.y,
                $zombie.width * ratio, $zombie.height * ratio,
            );
        }
    }

    /**
     * Animate zombie
     * 
     * @param none
     * @return void
     */
    animateZombie = function () {
        let list = Object.keys($zombie.list);
        for (var i = 0; i < list.length; i++) {
            let index = list[i];
            // let index = list[Math.floor(Math.random() * list.length)];
            $zombie.list[index].y++;
            $zombie.list[index].canvas.y++;

            if ($zombie.list[index].canvas.y > ($canvas.height*0.95)) {
                addZombie(1);
                delete $zombie.list[index];
            }
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
        // let x = event.clientX;
        // let y = event.clientY;
        // document.getElementById("coordinateX").style.top = y+'px';
        // document.getElementById("coordinateY").style.left = x+'px';

        // drawBackground();
        // let ctx = $canvas.getContext("2d");
        // let zombieWidth = 190;
        // let ratio = y/$zombie.height;
        // ctx.drawImage($zombie,
        //     0, 0, zombieWidth, $zombie.height,
        //     x, 0,
        //     zombieWidth*ratio, $zombie.height*ratio,
        // );
    }
}