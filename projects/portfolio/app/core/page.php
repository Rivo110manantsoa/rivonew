<?php
class Page {
    public static function generate_links($base_url='',$page_number=1){
        $page_number = (int)$page_number;
        $base_url = rtrim($base_url,'?');

        if (!empty($base_url)) {
            $base_url .= (strpos($base_url,'?') !== false) ? '&' : '?';
        } else {
            $base_url = ROOT . '?';
        }

        $prev_page = ($page_number > 1) ? $page_number - 1 : 1;
        $next_page = $page_number + 1;

        $links = (object)[];

        $links->prev = $base_url . "pg=" . $prev_page;
        $links->next = $base_url . "pg=" . $next_page;

        $links->current = $page_number;
        return $links;
    }

    public static function show_pagination(){
        $page_number = isset($_GET['pg']) ? (int)$_GET['pg'] : 1;
        $url = isset($_GET['url']) ? $_GET['url'] : 'home/index';
        
        $url = rtrim($url,'/');

        $base_url = ROOT . $url;
        $links = self::generate_links($base_url,$page_number);

        ob_start();
        ?>

        

        <ul class="pagination">
            <li><a href="<?=$links->prev?>"><i class="fa-solid fa-angles-left"></i></a></li>
            <?php
                $max = $links->current + 5;
                $cur = ($links->current > 5) ? $links->current - 5 : 1;
            ?>
            <?php for ($i=$cur;$i < $max; $i++):?>
                <li class="<?=($links->current==$i) ? 'active' : '';?>"><a href="<?=$base_url?>?pg=<?=$i?>"><?=$i?></a></li>
            <?php endfor; ?>
            <li><a href="<?=$links->next?>"><i class="fa-solid fa-angles-right"></i></a></li>
        </ul>
        <?php 
        $pagination = ob_get_clean();
        return $pagination;
    }

    public static function get_offset($limit){
        $limit = (int)$limit;
        $page_number = isset($_GET['pg']) ? (int)$_GET['pg'] : 1;
        $page_number = ($page_number < 1) ? 1 : $page_number;
        return ($page_number - 1) * $limit;
    }
}