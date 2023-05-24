<?php

	class Subcategory extends Eloquent{
		protected $fillable = [];
        protected $table = 'subcategories';
		//model relation...
		public function category(){
			return $this->belongsTo('Category');
		}

        public function subSubCategory(){
            return $this->hasMany('SubSubCategory');
        }

	}

 ?>