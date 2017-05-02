<?php
namespace app\index\controller;
use freefile\data\User;
class Index extends CL
{
    public function index()
    {
        $s = '';
        for($i =1;$i<95;$i++){
            if($i<10){
                $a = "1765_00".$i;
            }else{
                $a = "1765_0".$i;
            }
          //  $s .= "<a href=\"http://img.cdcybc.com/{$a}.jpg?imageView2/0/q/75|watermark/1/image/aHR0cDovL2ltZy5jZGN5YmMuY29tL2xvZ29fd2F0ZXIucG5n/dissolve/100/gravity/SouthEast/dx/10/dy/10\" data-rel=\"prettyPhoto[t1]\" data-title=\"隐形车衣施工过程\" data-caption=\"\"><img style=\"padding:1px\" src=\"http://img.cdcybc.com/{$a}.jpg?imageView2/1/w/100/h/60/interlace/1/q/50|imageslim\" alt=\"\" width=\"100\" /></a>";
        }
        echo $s;
        //$user = new User();
        //return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    }
    public function t(){
        return 112;
    }
}
