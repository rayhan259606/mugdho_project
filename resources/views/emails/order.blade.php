<h1>New Order Notification</h1>
<p>A new order has been placed.</p>
<ul>
    <li><strong>Product:</strong> {{ $data['product_title'] }}</li>
    <li><strong>Price:</strong> {{ $data['price'] }}</li>
    <li><strong>Customer Name:</strong> {{ $data['name'] }}</li>
    <li><strong>Phone:</strong> {{ $data['phone'] }}</li>
    <li><strong>Address:</strong> {{ $data['address'] }}</li>
</ul>
<p>Please process the order from the admin panel.</p>
