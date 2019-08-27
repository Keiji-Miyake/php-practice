<?php
    $month = $_POST['month'];

    $yasai[] = '';
    $yasai[] = 'ブロッコリー';
    $yasai[] = 'カリフラワー';
    $yasai[] = 'レタス';
    $yasai[] = 'みつば';
    $yasai[] = 'アスパラガス';
    $yasai[] = 'セロリ';
    $yasai[] = 'ナス';
    $yasai[] = 'ピーマン';
    $yasai[] = 'オクラ';
    $yasai[] = 'さつまいも';
    $yasai[] = '大根';
    $yasai[] = 'ほうらんそう';

    print $month;
    print '月は';
    print $yasai[$month];
    print 'が旬です。';
