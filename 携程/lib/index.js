$(function(){
    // swiper生效
    var swiper=new Swiper('.swiper-container',{
        pagination:{
            el:'.swiper-pagination',
        },
    });


    //1.当鼠标进入搜索框时,进入搜索页

    $('#searchinput').focus(function(){

        //显示搜索页
        $('.container').hide();
        $('.searchpage').show();

        //获取本地数据存储区域里面的搜索记录
        var arr=getSearchList();
        if(arr.length>0){
            $(".searchhistory").show();
            //显示搜索的历史数据
            render(arr);

        }
    

    });

    //2.点击返回按钮,回到主页
    $('#back').click(function(){
        //主页显示
        $(".container").show();
        //搜索页隐藏
        $(".searchpage").hide();
    });

    // 3.点击搜索按钮
    $('.searchpage #searchbutton').click(function(){
        
        var text=$(".searchpage input").val();

        // 获取搜索框的文字
        if(text.length<=0) return;

        //拿到数组,操作数组
        var arr=getSearchList();
        arr.push(text);
        //存数组
        setSearchList(arr);
        //重新渲染页面
        $(".searchhistory").show();
        render(arr);

        //把搜索框的文字清除
        $(".searchpage input").val("");
    });

    //4.清空搜索历史,因为模板引擎的数据是后渲染进来的,所以需要绑定事件
    $(".searchhistory").on("click",'.clear',function(){
        window.localStorage.removeItem("searchlist");
        $(".searchhistory").hide();
    })

    //渲染页面数据
    function render(arr){
        var htmlstr=template("searchlist",{data:arr});
        $(".searchhistory").html(htmlstr);
    }


    //读取搜索历史记录
    function getSearchList(){
        var arr=[];
        if(window.localStorage.getItem("searchlist")){
            //如果有存过,就把存储的值取出来,转数组
            arr=JSON.parse(window.localStorage.getItem("searchlist"));
        }
        return arr;
    }
    //存储搜索历史数据
    function setSearchList(arr){
        window.localStorage.setItem("searchlist",JSON.stringify(arr));
    }


});