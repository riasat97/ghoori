@extends('admin._layouts.admin')
@section('title')
Create #eShop in Ghoori
@stop
@section('myShopBtn')
@overwrite
@section('content')
    @include('_layouts.errors')
    <div class="container">
        <div class="row">
            <div class="col-xs-7">
            {{ Form::model($formData,array('route' => 'shops.store','files' => true,'id'=>'ch_create_shop','class'=>'cd-form floating-labels')) }}
            @include('shops._partials.form')
            {{ Form::close() }}
            </div>
            <div class="col-xs-5">
               {{HTML::image('img/graphics/create-shop.jpg','alt',array(
                    'width'=>450,
                    'class'=>'img-responsive'
                ))}}
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    {{HTML::script('https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js')}}
    <script>

        $(document).ready(function(){
            jQuery.validator.addMethod("lengthin", function(value, element, param) {
             
                    for (var i = param.length - 1; i >= 0; i--) {
                        if (value.length == param[i]) {return true};
                    };
                    return false;
                 
            }, jQuery.validator.format("Please enter {0} or {1} digits.") );

            jQuery.validator.addMethod("exactlength", function(value, element, param) {
                return this.optional(element) || value.length == param;
            }, jQuery.validator.format("Please enter exactly {0} characters."));

            function verifyformrender(selectedVerifyRadio) {

                $('.verifywithbox').removeClass('animated');
                $('.verifywithbox').hide();
                $('.verifynumberfield').removeAttr("required");
                
                // alert('.'+selectedVerifyRadio+'box');
                $('.'+selectedVerifyRadio+'box').show();
                $('.'+selectedVerifyRadio+'box').addClass('animated');
                $('.'+selectedVerifyRadio+'box').find('input[type=text]').prop("required", true);
                // console.log($('.'+selectedVerifyRadio+'box').find('input[type=text]'));
            }


            var selectedVerifyRadio = $( "input[name=verifywith]:checked" ).attr('id');
            verifyformrender(selectedVerifyRadio);
            $( "input[name=verifywith]" ).click(function(){
                var selectedVerifyRadio = $( "input[name=verifywith]:checked" ).attr('id');
                verifyformrender(selectedVerifyRadio);
            });
            $("#ch_create_shop input[type=submit]").removeAttr('disabled');

            jQuery.validator.addMethod("regex", function(value, element, regexpr) {
                return regexpr.test(value);
            }, "Invalid pattern");

            jQuery.validator.addMethod("alphanumeric", function(value, element) {
                return this.optional(element) || /^[a-zA-Z0-9]+$/.test(value);
            }, "Please enter an alphanumeric value.");

            $("#ch_create_shop").validate({
                rules : {
                    title : {
                        maxlength : 24
                    },
                    mobile : {
                        regex : /^([+]?88)?01[15-9]\d{8}$/
                    },
                    agreeWithTerms : {
                        required : true
                    },
                    subDomain : {
                        required : true,
                        minlength: 4,
                        maxlength: 32,
                        regex : /^[a-z][a-z0-9-]{3,31}$/
                    },
                    nationalId : {
                        digits: true,
                        lengthin: [13, 17]
                    },
                    drivingLicense : {
                        alphanumeric: true,
                        exactlength : 15
                    },
                    birthCertificate : {
                        digits: true,
                        exactlength : 17
                    },
                    passport : {
                        alphanumeric: true

                    }
                },

                messages : {
                    mobile : {
                        regex : "Please enter a Bangladeshi Mobile number."
                    },
                    agreeWithTerms : {
                        required : "You must agree with our terms and conditions"
                    },
                    subDomain : {
                        regex : "Must start with a letter and can have only small leters, digits and '-' dash"
                    }
                },
                highlight: function(element) {
                    $(element).closest('input').addClass('cd-form-input-error');
                    $(element).closest('textarea').addClass('cd-form-input-error');
                    $(element).closest('email').addClass('cd-form-input-error');
                },
                unhighlight: function(element) {
                    $(element).closest('input').removeClass('cd-form-input-error');
                    $(element).closest('textarea').removeClass('cd-form-input-error');
                    $(element).closest('email').removeClass('cd-form-input-error');
                },
                errorElement: 'span',
                errorClass: 'cd-form-error',
                errorPlacement: function(error, element) {
                    if(element.parent('.input-group').length) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element.parent().find(":last"));
                    }
                }
            });
        });
        $(document).on('click','.same-as-address',function(e) {
            var ischecked= $(this).is(':checked');
            if(!ischecked)
            $('.pickup-address').removeClass('hidden');
            else
                $('.pickup-address').addClass('hidden');
                $('.pickup-address').val('');
        });

    </script>
@stop