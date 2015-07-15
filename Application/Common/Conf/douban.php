<?php
    return array(
        'DOUBAN'=>array(
            'ISBN'=>"https://api.douban.com/v2/book/isbn/:ISBN??apikey=00e84c9d0269476f02b8e5d7073bd64d",//根据ISBN获取图书信息
            'ID'=>"https://api.douban.com/v2/book/:ID?apikey=00e84c9d0269476f02b8e5d7073bd64d",//根据ID获取图书信息
            'ANNOTATIONS'=>'https://api.douban.com/v2/book/:ID/annotations?start=:START&count=:COUNT?apikey=00e84c9d0269476f02b8e5d7073bd64d',//根据ID获取图书笔记
            'NOP'=>2,//获取笔记一页的条数 Number of page
            'ACOUNT'=>100,//一页条数
        ),
    );