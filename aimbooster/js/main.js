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
        backgroundSoundId: 'backgroundSound',
        canvasTableId: 'canvasTable',
        zombieId: 'zombie',
        welcomeMsgId:'welcomeMsg',
        gunId: 'gun',
        timeId: 'time',
        lifeId: 'life',
        aliveId: 'alive',
        killedId: 'killed',
        missedId: 'missed',
        coinId: 'coin',
        accuracyId: 'accuracy',
        canvasHeight: window.innerHeight,
        canvasWidth: window.innerWidth,
        updateIntervalTime: 60,
        updateIntervalStatus: undefined,
        summary:{
            player:{
                time:0,
                life:0,
                total:0,
                alive:0,
                killed:0,
                missed:0,
                coin:0,
                accuracy:0
            }
        }
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
    $backgroundSound = document.getElementById(_this.config.backgroundSoundId);
    $canvasTable = document.getElementById(_this.config.canvasTableId);
    $welcomeMsg = document.getElementById(_this.config.welcomeMsgId);
    $time = document.getElementById(_this.config.timeId);
    $life = document.getElementById(_this.config.lifeId);
    $killed = document.getElementById(_this.config.killedId);
    $alive = document.getElementById(_this.config.aliveId);
    $missed = document.getElementById(_this.config.missedId);
    $coin = document.getElementById(_this.config.coinId);
    $accuracy = document.getElementById(_this.config.accuracyId);

    /**
     * Init application
     * 
     */
    this.init = function (init = false) {

        if (_this.config.updateIntervalStatus == undefined) {

            if(!init){
                showInfo('Click on + to start game');
                return;
            }
            else{
                showInfo();
                setGameTime();
            }
            setViewport();
            // drawBackground();
            addZombie();
            drawZombie();
            this.playBackgroundSound();
            
            _this.config.updateIntervalStatus = setInterval(function () {
                this.animateZombie();
                // this.drawBackground();
                this.drawZombie();
                this.updateTime();
            }, _this.config.updateIntervalTime);
        }
    }


    this.playBackgroundSound = function(){
        $backgroundSound.play();
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
            let canvasY = 0;//Math.round(Math.random() * ($canvas.height - $zombie.height));
            // life in second
            let life = Math.round(Math.random()*30*1000);
            $zombie.list[y] = {
                x: x,
                y: 0,
                life:life,
                polygon: [],
                canvas: {
                    x: canvasX,
                    y: canvasY
                }
            };
        }
        updateTotal(limit);
        updateAlive();
    }
    /**
     * Draw zombie
     * 
     */
    drawZombie = function () {
        $canvas.width = $canvas.width;
        
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
            $canvas.ctx.drawImage($zombie,
                obj.x, 0, $zombie.width, $zombie.height,
                obj.canvas.x, obj.canvas.y,
                $zombie.width * ratio, $zombie.height * ratio,
            );
            $canvas.ctx.fillText(obj.life,obj.canvas.x+(($zombie.width*ratio)/2),obj.canvas.y);            
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
                    updateCoin($zombie.list[index].life);
                    delete $zombie.list[index];
                    updateKilled();
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
            let num  = Math.round(Math.random()*5);
            // Create random zombie when shoot missed
            addZombie(num);
            // Update missed zombie
            updateMissed();
            // updateLife();
        }
        updateAccuracy();
    }

    /**
     * Check polygon exist in vertex
     */
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

    /**
     * Define shape for zombie
     * 
     */
    defineShape = function(polygon){
        $canvas.ctx.moveTo(polygon[0].x, polygon[0].y);
        for (var i = 1; i < polygon.length; i++) {
            $canvas.ctx.lineTo(polygon[i].x, polygon[i].y);
        }
        // print on canvas
        // $canvas.ctx.fill();
    }

    /**
     * Show game over msg
     */
    gameOver = function(){
        if (_this.config.updateIntervalStatus !== undefined) {
            _this.config.updateIntervalStatus = clearInterval(_this.config.updateIntervalStatus);
            showInfo("Game Over!");
        }
    }

    /**
     * Show info msg on canvas
     * 
     * @param string message
     */
    showInfo = function(msg){
        if(msg){
            $canvasTable.classList.add('show');
            $welcomeMsg.innerText = msg;
        }
        else{
            $canvasTable.classList.remove('show')
        }
    }

    /**
     * Update running time of game
     */
    updateTime = function(){
        $time.innerText = getTimeDiff(_this.config.summary.player.time,getTime());
    }

     /**
     * Update life
     */
    updateLife = function(){
        let life = 100 - ((_this.config.summary.player.life*100)/_this.config.summary.player.coin);
        $life.innerText = life.toFixed(2)+'%';
    }

     /**
     * Update alive zombie
     */
    updateAlive = function(num){
        _this.config.summary.player.alive = Object.keys($zombie.list).length;//num;
        $alive.innerText = _this.config.summary.player.alive;
    }

     /**
     * Update total zombie
     */
    updateTotal = function(num){
        _this.config.summary.player.total = num;
    }

    /**
     * Update killed zombie
     */
    updateKilled = function(){
        $killed.innerText = ++_this.config.summary.player.killed;
    }

    /**
     * Update missed zombie
     */
    updateMissed = function(){
        $missed.innerText = ++_this.config.summary.player.missed;
    }

    /**
     * update collected coin
     */
    updateCoin = function(num){
        _this.config.summary.player.coin += num;
        $coin.innerText = _this.config.summary.player.coin;
    }

    /**
     * Update missed zombie
     */
    updateAccuracy = function(){
        let accuracy = (_this.config.summary.player.killed *100 / (_this.config.summary.player.missed+_this.config.summary.player.killed));
        $accuracy.innerText = accuracy.toFixed(2)+'%';

        if(accuracy < 5 && _this.config.summary.player.missed && _this.config.summary.player.killed){
            gameOver();
        }
    }

    /**
     * Get current time
     */
    getTime = function(){
        return new Date();
    }

    /**
     * Set game start time
     */
    setGameTime = function(){
        _this.config.summary.player.time = getTime();
    }

    /**
     * Get time diff
     */
    getTimeDiff = function(start,end){
        let d,h,m,s,i;

        // get milisecond difference
        d = end.getTime() -start.getTime();

        // get milisecond
        i = d%1000;

        // get seconds
        s = Math.floor(d/1000);

        // getting hours
        h = Math.floor(s/3600);
        s = s % 3600;

        // getting minute
        m = Math.floor(s/60); 
        s = s % 60;
        
        m = m < 10 ?'0'+m:m;
        s = ('0'+s).substr(-2);
        i = ('00'+i).substr(-3);
        return m+':'+s+':'+i;
    }
}