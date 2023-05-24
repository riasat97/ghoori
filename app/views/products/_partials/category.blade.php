
<ul>


    {{--   <li>
           {{ Form::label('Product-Category', 'Product Category') }}
           {{ Form::select('category_id',$categories,null,array('id' => 'categoryId')) }}
           {{ $errors->first('category_id', '<p class="error">:message</p>') }}
       </li>--}}
    <em>Select <b>Category</b>-->Sub Category
        <br>-->Sub Sub Category</em>
    <li class="category">

        <select class="js-data-example-ajax" name="category_id" id="categoryId"  style="width:100%" >
            <option value="" selected="selected">Select Category</option>
        </select>
    </li>
    <br>
    <li  style="display:none;" class="sub-category">
        <select class="subCategory" name="subcategory_id" id="subCategoryId" style="width:100%">
            <option value="" selected="selected">Select Sub Category</option>
        </select>
    </li>
    <br>
    <li style="display:none;" class="sub-sub-category">
        <select class="subSubCategory" name="subSubCategory_id" id="subSubCategoryId" style="width:100%">
            <option value="" selected="selected">Select Sub Sub Category</option>
        </select>
    </li>
    {{--  <li>
          {{ Form::label('Product-Brand', 'Product Brand') }}
          {{ Form::select('brand_id',$brands) }}
          {{ $errors->first('brand_id', '<p class="error">:message</p>') }}
      </li>--}}

    <br>
    <li>

        {{ Form::button('Next',array('id'=>'category-to-product','class'=>'btn btn-primary')) }}
    </li>
</ul>


{{--
{{HTML::script('js/product.js')}}--}}
