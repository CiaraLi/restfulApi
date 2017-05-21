
# this is a simple restfulApi test.
# get :select all products or one product;
# post:insert a new product
# put :update product info
# delete :delete one product
#
# |-class                      
# |---Mysql.php                 //mysql 操作类
# |---ProductRequest.php        //产品操作接口实现:继承Request
# |-restful                     
# |---Request.php               //接口数据接收类
# |---Response.php              //接口输出类
# |-.gitignore                  
# |-.htaccess                   //重定向配置
# |-api.php                     //接口入口文件
# |-config.php                  //接口配置文件
# |-index.php                   //测试文件
#
#
# 
