//定义自己的js文件
//该文件中存放一些工具函数

(function(){

  //定义函数
  //parameter
  function paramToObj(search){
    //这个参数的形式为?k=v&k=v
    if(search.charAt(0)==="?"){
      search=search.slice(1);

    }
    //代码走到这,表示没有?
    var tmp={};
    var tmp_array=search.split('&');
    for(var i=0;i<tmp_array.length;i++){

      var kv=tmp_array[i].split('=');
      tmp[kv[0]]=kv[1];
    }
    return tmp;

  }

  //封装检查url参数的函数
  // 检查是否是?k=v&k=v的形式
  function checkUrlSearch(search){
    //要保证参数一定有数据
    var obj=paramToObj(search);
    //取出对象的所有值
    var values=Object.values(obj);

    for(var i=0;i<values.length;i++){
      if(values[i].trim().length===0){
        return false;
        //如果进来,这说明有参数为空

      }

    }

    //走到这里说明都有数据
    return true;
  }


  window.tools={
    paramToObj:paramToObj,
    checkUrlSearch:checkUrlSearch
  }


})();