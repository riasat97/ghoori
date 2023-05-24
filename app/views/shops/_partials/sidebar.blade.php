<!-- @todo Not in use 12/2015 -->
<div class="col-sm-3 hidden-phone">
    <div class="sidebar">
        <section>
            <aside class="col-md-3" id="shop-cat-nav">

                <ul class="unbulleted">
                    <li><a href="#"><strong>Products</strong></a>
                        <ul>
                            <li><a href="#">New</a></li>
                            <li><a href="#">All</a></li>
                            <li><a href="#">Deleted</a></li>
                            <li><a href="#">Published</a></li>
                            <li><a href="#">Unpublished</a></li>
                        </ul>
                    </li><br>
                    <li><a href="#"><strong>Orders</strong></a>
                        <ul>
                            <li><a href="{{ URL::route('newOrders') }}"><font color="blue">New</font></a></li>
                            <li><a href="{{ URL::route('visitedOrders') }}"><font color="blue">Visited</font></a></li>
                            <li><a href="{{ URL::route('allOrders') }}"><font color="blue">All</font></a></li>
                            <li><a href="{{ URL::route('archivedOrders') }}"><font color="blue">Archived</font></a></li>
                        </ul>
                    </li><br>
                    <li><a href="#"><strong>Payments</strong></a>
                        <ul>
                            <li></li>
                        </ul>
                    </li><br>
                    <li><a href="#"><strong>Invoices</strong></a>
                        <ul>
                            <li></li>
                        </ul>
                    </li>
                </ul>
            </aside>
        </section>
    </div>
</div>