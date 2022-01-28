function Block(container){
    this.container=container; //定义一个容器
    this.mainW=this.container.parentNode.clientWidth; //定义父元素宽度
    this.mainH=this.container.parentNode.clientHight; //定义父元素高度
    this.scale=1.58; //定义黑块高度比
    this.height=parseInt(this.mainW/4*this.scale); //定义黑块高度
    this.top=-this.height;
    this.speed=2; //速度
    this.maxSpeed=20; //最大速度
    this.timer=null; //计时器
    this.start=true; //判断游戏状态
    this.sum=0; //分数
}
Block.prototype={
    init:function(){
        var_t=this;
        _t.mark(); //显示初始分数
        _t.container.addEventListener("click",function(e){
            if (!_t.state){
                return false;
            }
            e=e || window.event; //获取事件对象
            var target=e.target || e.srcElement; //获取触发对象的元素
            if (target.className.indexOf('block')!=-1){ //加分
                _t.sum++
                //显示分数
                document.getElementsByClassName("mark")[0].innerHTML=_t.sum;
                target.className="blank"; //设置类名
            }else{
                _t.state=false; //变量赋值
                clearInterval(_t.timer); //停止移动
                _t.end();
                return false;
            }
        });
    },
    //显示分数
    mark:function(){
        var oMark=document.createElement("div"); //创建div元素
        oMark.className="mark"; //设置类名
        oMark.innerHTML=this.sum; //设置html内容
        this.container.parentNode.appendChild(oMark); //添加元素
    },
    addRow:function(){
        var oRow=document.createElement('div') //创建div
        oRow.className="row"; //设置类名
        oRow.style.height=this.height+'px'; //设置高度
        var blanks=['blank','blank','blank','blank']; //定义数组
        var s=Math.floor(Math.random()*4); //随机3个数
        blanks[s]="blank block"; //为指定下标的数组赋值
        var oBlank=null;
        for (var i=0;i<4;i++){
            oBlank=document.createElement("div")
            oBlank.className=blanks[i];
        }
        var fChild=this.container.firstChild; //获取第一个字元素
        if (fChild==null){
            this.container.appendChild(oRow); //在末尾加元素
        }else{
            this.container.insertBefore(oRow,fChild); //在开头加元素
        }
    },
    move:function(){
        this.top +=this.speed;
        this.container.style.top=this.top+'px';
    },
    judge:function(){
        var _t=this;
        if (_t.top>=0){
            _t.top=-this.height;
            _t.container.style.top=_t.top+'px';
            _t.addRow();
        }
        _t.speed=(parseInt(_t.sum/5)+1)*2;
        if (_t.speed>=_t.maxSpeed){_t.speed=_t.maxSpeed} //最大速度
        var blocks=document.getElementsByClassName('block');
        for(var j=0;j<blocks.length;j++){
            if (blocks[j].offsetTop>=_t.mainH){
                _t.state=false;
                clearInterval(_t.timer);
                _t.end()
            }
        }
    },
    start:function(){
        var _t=this;
        for(var i=0;i<4;i++){
            _t.addRow();
        }
        _t.timer=setInterval(function(){
            _t.move();
            _t.judge();
        },30);
    },
    end:function(){
        var _t=this;
        if (!document.getElementById("result")){
            var result=document.createElement("div");
            result.className="result";
            result.id="result";
            result.innerHTML='<h1 align="center">游戏结束</h1><h2 id="score">分数: '+_t.sum;'</h2><span id="restart">重新开始</span>';
            _t.container.parentNode.appendChild(result);
        }else{
            var result=document.getElementById("result");
            result.style.display="block"
            var score=document.getElementById("socre");
            score.innerHTML="分数："+_t.sum;
        }
        var restart=document.getElementById("restart");
        restart.onclick=function(){
            _t.align();
            result.style.display="none";
            return false;
        }
    },
    align:function(){
        this.mainW=this.container.parentNode.clientWidth;
        this.mainH=this.parentNode.clientHight;
        this.scale=1.58
        this.height=parseInt(this.mainW/4*this.scale);
        this.top=-this.height;
        this.speed=2;
        this.timer=null;
        this.state=true;
        this.sum=0;
        var _t=this;
        _t.container.innerHTML="";
        document.getElementsByClassName("mark")[0].innerHTML=_t.sum;
        _t.start();
    }
}