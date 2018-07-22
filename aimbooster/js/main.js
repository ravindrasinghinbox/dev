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
    $canvas.ctx = $canvas.getContext("2d");
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
        drawZombie();

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
        $canvas.ctx.drawImage($img,
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
            let x = Math.floor(Math.random() * $zombie.buffer) * $zombie.width;
            let canvasX = Math.round(Math.random() * ($canvas.width-$zombie.width));
            let canvasY = Math.round(Math.random() * ($canvas.height - $zombie.height));
            // life in second
            let life = Math.round(Math.random()*30*1000);
            $zombie.list[y] = {
                x: x,
                y: y,
                life:life,
                polygon: [],
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
        // for draw polygon
        $canvas.ctx.beginPath();

        // Drawing zombie
        let obj = {};
        for (let i in $zombie.list) {
            obj = $zombie.list[i];

            let ratio = 1;
            if (obj.y < $zombie.height) {
                ratio = obj.y / $zombie.height;
            }
            // $zombie.list[i].polygon = [
            //     // top-left
            //     {x:obj.canvas.x,y:obj.canvas.y},
            //     // bottom-left
            //     {x:obj.canvas.x,y:obj.canvas.y+($zombie.height * ratio)},
            //     // bottom-right
            //     {x:obj.canvas.x+($zombie.width * ratio),y:obj.canvas.y+($zombie.height * ratio)},
            //     // top-right
            //     {x:obj.canvas.x+($zombie.width * ratio),y:obj.canvas.y},
            // ];
            // zombie head size 38x56
            let headHeight = 56;
            let headWidth = 38;
            let gutter = 20;
            let x1 = ((($zombie.width+gutter)/2)-(headWidth/2))*ratio;
            $zombie.list[i].polygon = [
                // top-left
                {x:obj.canvas.x+x1,y:obj.canvas.y},
                // bottom-left
                {x:obj.canvas.x+x1,y:obj.canvas.y+(headHeight * ratio)},
                // bottom-right
                {x:obj.canvas.x+x1+(headWidth * ratio),y:obj.canvas.y+(headHeight * ratio)},
                // top-right
                {x:obj.canvas.x+x1+(headWidth * ratio),y:obj.canvas.y},
            ];
            defineShape($zombie.list[i].polygon);
            $canvas.ctx.fillText(obj.life,obj.canvas.x+(($zombie.width*ratio)/2),obj.canvas.y);
            $canvas.ctx.drawImage($zombie,
                obj.x, 0, $zombie.width, $zombie.height,
                obj.canvas.x, obj.canvas.y,
                $zombie.width * ratio, $zombie.height * ratio,
            );
        }

        // close polygon path
        $canvas.ctx.closePath();
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

            if(i%2 == 0){
                $zombie.list[index].canvas.x++;
            }else{

                $zombie.list[index].canvas.x--;
            }

            $zombie.list[index].y++;
            $zombie.list[index].canvas.y++;
            $zombie.list[index].life -= _this.config.updateIntervalTime;

            // Kill zombie when time over or hidden from canvas
            if ($zombie.list[index].life < 0 || $zombie.list[index].canvas.y > $canvas.height) {
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
    this.shoot = function (event) {
        let x = event.clientX;
        let y = event.clientY;

        $shoot.currentTime = 0;
        $shoot.play();
        let status =  $canvas.ctx.isPointInPath(x, y);
        // Kill zombie when right shoot
        if(status){
            let obj;
            let index;
            let list = Object.keys($zombie.list);
            for (var i = list.length-1; i >= 0 ; i--) {
                index = list[i];
                obj = $zombie.list[index];
                if(checkPolygon(obj.polygon,[x,y])){
                    delete $zombie.list[index];
                    let status = (Math.round(Math.random()*10)%2 == 0)
                    if(status){
                        // add new zombie
                        addZombie(1);
                    }
                    // kill only one zombie at time
                    break;
                }
            }
        }else{
            // Create random zombie when shoot missed
            addZombie(Math.round(Math.random()*5));
        }
    }

    checkPolygon = function(vs,point){
        
        var x = point[0], y = point[1];
    
        var inside = false;
        for (var i = 0, j = vs.length - 1; i < vs.length; j = i++) {
            var xi = vs[i].x, yi = vs[i].y;
            var xj = vs[j].x, yj = vs[j].y;
    
            var intersect = ((yi > y) != (yj > y))
                && (x < (xj - xi) * (y - yi) / (yj - yi) + xi);
            if (intersect) inside = !inside;
        }
    
        return inside;
    }

    defineShape = function(polygon){
        $canvas.ctx.moveTo(polygon[0].x, polygon[0].y);
        for (var i = 1; i < polygon.length; i++) {
            $canvas.ctx.lineTo(polygon[i].x, polygon[i].y);
        }
        // print on canvas
        // $canvas.ctx.fill();
    }
}