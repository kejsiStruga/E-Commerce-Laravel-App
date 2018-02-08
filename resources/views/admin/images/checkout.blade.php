<form id ="view-cart" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" name="viewcart">
    <form id ="form3" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
        <input type="hidden" name="cmd" value="_cart" />
        <input type="hidden" name="display" value="1" />
        <input type="hidden" name="business" value="nsenensene202020@gmail.com" />
    </form>
    <form id ="form2" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
        <input type="hidden" name="cmd" value="_cart" />
        <input type="hidden" name="add" value="1" />
        <input type="hidden" name="business" value="nsenensene202020@gmail.com" />
        <input type="hidden" name="item_name" value="<?php echo e($image->name); ?>" />
        <input type="hidden" name="amount" value="50" />
        <input type="hidden" name="currency_code" value="USD" />
        <input type="hidden" name="lc" value="US" />
        <input type="hidden" name="cancel_return" value="http://localhost:8000/album/1">
        <input type="hidden" name="return" value="http://localhost/paypal-shopping-cart/success.php">
    </form>
    <div id="product_details">
        <div id="pro_price">
            <p><?php echo e($image->name); ?></p>
            <p>Price : <b>$50</b></p>
        </div>
        <div id="pro_quantity">
            <p>Quantity</p>
            <select name="quantity">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
    </div>
    <div id="add-cart"><a class="pro1 add" style="padding-left: 50px;" href="#" 
        onclick="document.getElementById('form2').submit()" id="cart-btn" id="cart-btn">
    <i class="fa fa-cart-plus"></i> Add to Cart </a ></div>
    <div id="view-cart"><a href="javascript:void(0);" onclick="document.getElementById('view-cart').submit()" id="cart-btn"><i class="fa fa-eye"></i> View Cart </a></div>
</form>
