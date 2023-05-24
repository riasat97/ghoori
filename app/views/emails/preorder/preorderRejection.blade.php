<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Preorder Rejected</h2>
<div>
    <p>Dear {{$userName}},</p>
    <p>
        Sorry,your preorder request is rejected.
    </p>
    <h4>Rejection Reason</h4>
    <p>{{ $order['remarks'] }}</p>
</div>

</body>
</html>