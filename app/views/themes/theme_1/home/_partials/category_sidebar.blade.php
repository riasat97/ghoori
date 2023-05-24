{{--Category Sidebar--}}

<div class="category-sidebar">

    <ul>
        @foreach($categories['subCategories'] as $cat=>$category)

            <li>
            {{ HTML::decode(link_to_route('shops.category',"<i class='fa fa-sitemap'></i>".$categories['categories'][$cat],
            [$shop->slug,$categories['categories'][$cat]], ['class' => empty($category)?'':'arrow']))}}
            @if (is_array($category) && count($category) > 0)
            <ul class="cat-sup-menu">
                @foreach($category as $subCategoryId=>$subCategory)
                <li>{{ HTML::decode(link_to_route('shops.category',$subCategory,
                     [$shop->slug,$categories['categories'][$cat],'sub-category'=>$subCategory]))}}
                </li>
                @endforeach
            </ul>
            @endif
        </li>
        @endforeach
    </ul>


    <!-- <div class="morelesscate">
        <span class="morecate" style="display: block;">
            <i class="fa fa-plus"></i>More Categories
        </span>
        <span class="lesscate text-danger" style="display: none;">
            <i class="fa fa-minus"></i>Close Menu
        </span>
    </div> -->

</div>