
<?php
        $i = $j = $k =0;
        $x = $y = $z = '';

foreach($categories as $category):


            if ($category->categoryName != $x) {
                $i++;
                $x = $category->categoryName;
                $xflag = true;
            } else {
                $xflag = false;
            }

            if ($category->subCategoryName != $y) {
                $j++;
                $y = $category->subCategoryName;
                $yflag = true;
                $k = 0;
            } else {
                $yflag = false;
            }

            $k++;
            $z = $category->subSubCategoryName;


            if ($xflag) {
                $tree[$i] = array(
                        'name' => $x
                );
            }

            if ($yflag) {
                $tree[$i][$j] = array(
                        'name' => $y
                );
            }

            $tree[$i][$j][$k] = array(
                'name' => $z
            );
endforeach;

        foreach ($tree as $p) {
            foreach ($p as $key=>$q) {
                if ($key == 'name') {
                    echo $p['name'].'<br />';
                } else {
                    foreach ($q as $key1 => $v) {
                        if ($key1 == 'name') {
                            echo '-'.$q['name'].'<br />';
                        } else {
                            echo '--'.$v['name'].'<br />';
                        }
                    }
                }
            }


        }
?>
           {{-- <li><a href="#">Ladies</a>
                <ul>
                    <li><a href="#">Shawl</a></li>
                    <li><a href="#">Shoes</a></li>
                </ul>
            </li>
            <li><a href="#">Children</a>
                <ul>
                    <li><a href="#">Shirt</a></li>
                    <li><a href="#">Trouser</a></li>
                </ul>
            </li>
        </ul>
    </li>
    <li><a href="#">Electronics</a>
        <ul>
            <li><a href="#">Gaming Console</a>
                <ul>
                    <li><a href="#">Xbox</a></li>
                    <li><a href="#">PS</a></li>
                </ul>
            </li>
            <li><a href="#">Camera</a>
                <ul>
                    <li><a href="#">Nikon</a></li>
                    <li><a href="#">Canon</a></li>
                </ul>
            </li>
        </ul>--}}
