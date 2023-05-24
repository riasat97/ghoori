<script type="text/javascript">
    $(document).ready(function() {
        $('.div-checkbox-container span').on('click', function (e) {
            e.preventDefault();
            if (!$(this).prev('input[type="checkbox"]').prop('checked')) {
                $(this).prev('input[type="checkbox"]').prop('checked', true).attr('checked', 'checked');
               // console.log(this);
                this.style.opacity = '1.0';
                //this.style.background = "url({{asset('img/form/color-blue.png')}})";
                //$(this).closest('form').find(".show-result").text(result());
            }
            else {
                $(this).prev('input[type="checkbox"]').prop('checked', false).removeAttr('checked');
                this.style.opacity = '0.4';
                this.style.color = 'transparent';
                this.style.background = "url('')";
                //$(this).closest('form').find(".show-result").text(result());
            }
        });


        $("#okay-btn").on('click', function(){
            var values = [];
            $('.attribute-popup input:checkbox:checked').each(function(i){
                values[i++] = $(this).val();
            });
            // console.log(values);
            $("#p_colors,#addColor,#p_sizes,#addSize,#p_types,#addType").addClass("hide");
            for(i=0; i<values.length; i++) {
                //console.log(values[i]);
                if(values[i] == 1) {
                    $("#p_colors,#addColor").removeClass("hide");
                }
                if(values[i] == 2) {
                    $("#p_sizes,#addSize").removeClass("hide");
                }
                if(values[i] == 3) {
                    $("#p_types,#addType").removeClass("hide");
                }
            }
            values = 0;
        });

        $(function() {
            var scntDiv = $('#p_colors');
            var i = $('#p_colors div.color_item').size() + 1;

            $('#addColor').on('click', function() {
                if(i<=6) {
                    $('<div class="color_item">'+
                            '<div class="fileinput fileinput-new" data-provides="fileinput">'+
                                '<div class="fileinput-preview thumbnail" data-trigger="fileinput">'+
                                    '<img src="{{asset('img/picture-add-128x128.png')}}">'+
                                '</div>'+
                                '<div>'+
                                    '<input type="file" name="colorimage[]" class="hidden">'+
                                '</div>'+
                            '</div>'+
                            '<input class="cd-product-color-name text" type="text" name="color[]" placeholder="Product Color">'+
                            '<a href="#" class="btn btn-danger btn-circle remColor"><i class="fa fa-times"></i></a>'+
                        '</div>').appendTo(scntDiv);
                    i++;
                }
                return false;
            });
            $('#p_colors').on('click','.remColor', function() {
                if( i > 1 ) {
                    
                    $(this).parent().remove();
                    i--;
                }
                return false;
            });
        });

        $(function() {
            var scntDiv = $('#p_sizes');
            var i = $('#p_sizes p').size() + 1;

            $('#addSize').on('click', function() {
                if(i<=6) {
                    $('<p><label class="cd-label" for="p_scnts"></label>' +
                    '<input type="text" class="cd-product-size-name text" id="p_scnt" name="size[]" value="" placeholder="Product Size" />' +
                    '<a href="#" class="btn btn-danger btn-circle remSize"><i class="fa fa-times"></i></a>' +
                    '</p>').appendTo(scntDiv);
                    i++;
                }
                return false;
            });
            $('#p_sizes').on('click','.remSize', function() {
                if( i > 1 ) {
                    $(this).parent().remove();
                    i--;
                }
                return false;
            });
        });

        $(function() {
            var scntDiv = $('#p_types');
            var i = $('#p_types p').size() + 1;

            $('#addType').on('click', function() {
                if(i<=6) {
                    $('<p><label class="cd-label" for="p_scnts"></label>' +
                    '<input type="text" class="cd-product-size text" id="p_scnt" name="type[]" value="" placeholder="Product Type" />' +
                    '<a href="#" class="remType">Remove</a>' +
                    '</p>').appendTo(scntDiv);
                    i++;
                }
                return false;
            });

            $('#p_types').on('click','.remType', function() {
                if( i > 2 ) {
                    $(this).parent().remove();
                    i--;
                }
                return false;
            });
        });

        $(function() {
            propertycount = 0;
            $('#propertyToggle').on('click', function() {
                $('#p_properties').toggleClass('hidden');
                $(this).fadeOut();
            });
            $('#addProperty').on('click', function(e) {
                e.preventDefault();
                // alert("hi ");
                    if (propertycount < 10) {
                        $('#p_properties').append('<div class="cd-property-group">'
                            +'<input class="cd-product-label cd-product-property-name text" type="text" name="label[]" id="p_label" placeholder="Property">'
                            +'<input class="cd-product-value cd-product-property-name text" type="text" name="value[]" id="p_value" placeholder="Value">'
                            +'<a class="btn btn-danger btn-circle property-close"> <i class="fa fa-times fa-x"></i></a> '
                            +'</div>');
                        propertycount++;
                    }
                    else {
                        alert("Only 10 properties are allowed.")
                    }
                    
            });

            $('#p_properties').on('click', '.property-close', function(e) {
                e.preventDefault();
                $(this).parent().remove();
                propertycount--;
                // return false;
            });
        });
    });
</script>