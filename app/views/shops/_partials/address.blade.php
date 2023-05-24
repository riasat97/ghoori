<!-- @not in use but it might get re-enabled -->
<div class="address-container">
    <dl class="">
        <dt>Address <a href="javascript:" class="edit-address"><span class="glyphicon glyphicon-pencil"></span></a></dt>
        <dd class="shop-address">{{str_limit($shop->address,7)}}</dd>
        <dt>Phone</dt>
        <dd class="shop-contact">{{$shop->mobile}}</dd>
        <dt>Email</dt>
        <dd class="shop-email">{{$shop->email}}</dd>
    </dl>

</div>

<div id="contact-edit" class="edit-contact-form" style="display:none;">
    {{ Form::open(array('route' => 'updateAddress','id'=>'editcontact')) }}
    <div>
        <h4>Shop Contact Info</h4>
        <div>
            {{ Form::label('shop-address', 'Address:') }}
            {{ Form::text('address') }}
            {{ $errors->first('address', '<p class="error">:message</p>') }}
        </div>
        <div>
            {{ Form::label('mobile-Number', 'Mobile:') }}
            {{ Form::number('mobile', Auth::user()->mobile) }}
            {{ $errors->first('mobile', '<p class="error">:message</p>') }}
        </div>
        <div>
            {{ Form::label('email', 'Email:') }}
            {{ Form::text('email', Auth::user()->email  ) }}
            {{ $errors->first('email', '<p class="error">:message</p>') }}
        </div>

        <div>

            {{ Form::hidden('shop_id',$shopId) }}
        </div>

        <div>
            {{ Form::submit('Save',array('id'=>'contactsave')) }}
        </div>
    </div>
    {{ Form::close() }}
</div>

<script>
    $('.edit-address').click(function() {
        $('.address-container').hide();
        $("#contact-edit").show();

    });

    $("#contactsave").click(function(e) {
        e.preventDefault();
        var data = $("#editcontact").serialize();

        $.ajax({
            url: "updateAddress",
            data: data,
            type: "POST",

            success: function(msg) {
                if (msg !== 'Error') {
                    updateAddressBox(msg);
                }
            },
            error: function(){

            }
        });
    });

    function updateAddressBox(msg) {
        $("#contact-edit").hide();
        $('.address-container').show();
        $('.shop-address').text(msg.address);
        $('.shop-contact').text(msg.mobile);
        $('.shop-email').text(msg.email);
    }

</script>