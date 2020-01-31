<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action='' method='post'>
        <input type='hidden' name='sid' value='1303908' >
        <input type='hidden' name='mode' value='2CO' >
        <input type='hidden' name='li_0_type' value='product' >
        <input type='hidden' name='li_0_name' value='Example Product Name' >
        <input type='hidden' name='li_0_product_id' value='Example Product ID' >
        <input type='hidden' name='li_0__description' value='Example Product Description' >
        <input type='hidden' name='li_0_price' value='10.00' >
        <input type='hidden' name='li_0_quantity' value='2' >
        <input type='hidden' name='li_0_tangible' value='Y' >
        <input type='hidden' name='li_1_type' value='shipping' >
        <input type='hidden' name='li_1_name' value='Example Shipping Method' >
        <input type='hidden' name='li_1_price' value='1.50' >
        <input type='hidden' name='li_2_type' value='coupon' >
        <input type='hidden' name='li_2_name' value='Example Coupon' >
        <input type='hidden' name='li_2_price' value='1.00' >
        <input type='hidden' name='li_3_type' value='tax' >
        <input type='hidden' name='li_3_name' value='Example Tax' >
        <input type='hidden' name='li_3_price' value='0.50' >
        <input type='hidden' name='card_holder_name' value='Checkout Shopper' >
        <input type='hidden' name='street_address' value='123 Test St >
        <input type='hidden' name='street_address2' value='Suite 200' >
        <input type='hidden' name='city' value='Columbus' >
        <input type='hidden' name='state' value='OH' >
        <input type='hidden' name='zip' value='43228' >
        <input type='hidden' name='country' value='USA' >
        <input type='hidden' name='email' value='example@2co.com' >
        <input type='hidden' name='phone' value='614-921-2450' >
        <input type='hidden' name='phone_extension' value='197' >
        <input type='hidden' name='ship_name' value='Gift Receiver' >
        <input type='hidden' name='ship_street_address' value='1234 Address Road' >
        <input type='hidden' name='ship_street_address2' value='Apartment 123' >
        <input type='hidden' name='ship_city' value='Columbus' >
        <input type='hidden' name='ship_state' value='OH' >
        <input type='hidden' name='ship_zip' value='43235' >
        <input type='hidden' name='ship_country' value='USA' >
        <input name='submit' type='submit' value='Checkout' >
        </form>


    <script>
    
    var args = {
    sellerId: "1817037",
    publishableKey: "E0F6517A-CFCF-11E3-8295-A7DD28100996",
    ccNo: $("#ccNo").val(),
    cvv: $("#cvv").val(),
    expMonth: $("#expMonth").val(),
    expYear: $("#expYear").val()
};

TCO.loadPubKey('production', function() {
    TCO.requestToken(successCallback, errorCallback, args);
});
    
    
    
    </script> 

</body>
</html>


        <?php



        Twocheckout::privateKey('BE632CB0-BB29-11E3-AFB6-D99C28100996');
Twocheckout::sellerId('901248204');
// Twocheckout::sandbox(true);  #Uncomment to use Sandbox

try {
    $charge = Twocheckout_Charge::auth(array(
        "merchantOrderId" => "123",
        "token" => 'Y2U2OTdlZjMtOGQzMi00MDdkLWJjNGQtMGJhN2IyOTdlN2Ni',
        "currency" => 'USD',
        "total" => '10.00',
        "billingAddr" => array(
            "name" => 'Testing Tester',
            # print(Diary)
                                       
            
            diary_obj = diary_dictionary()
            user_obj = user_dictionary()
            
            # user_obj.add('id', 1)
            user_obj.add('username', 'test_user')
            user_obj.add('password', '12345678')
            
            # diary_obj.add('id',2)
            diary_obj.add('title','Harry porter')
            # diary_obj.add(list(user_obj.keys())[1],list(user_obj.values())[1])
            diary_obj.add('description','finding out if it works')
            
            diary = diary_obj
            user = user_obj
            
            tasks = [
                {
                    'title': u'Buy groceries',
                    'description': u'Milk, Cheese, Pizza, Fruit, Tylenol', 
                },
                {
                    'title': u'Learn Python',
                    'description': u'Need to find a good Python tutorial on the web', 
                }
            ]
            
            
            
            
            @app.route('/api/users/', methods = ['POST'])
            def new_user():
                username = request.json.post(user['username'])
                password = request.json.post(user['password'])
                user.add(username=username, password=password)
                if username is None or password is None:
                    abort(400) 
                if user.query.filter_by(username = username).first() is not None:
                    abort(400) 
                
                
                return jsonify({ 'username': user.username }), 201, {'Location': url_for('get_user', id = u.id, _external = True)}
            
            @auth.verify_password
            def verify_password(username, password):
                user =u.query.filter_by(username = username).first()
                if not user or not user.verify_password(password):
                    return False
                g.user = user
                return True
            
            @app.route('/api/users/<int:id>')
            def get_user(id):
                u = user.query.get(id)
                if not u:
                    abort(400)
                return jsonify({'username': u.username})
            
            
            @app.route('/api/v1.0/diary', methods=['GET'])
            def get_records():
                return json.dumps(diary)
            
            
            @app.route('/api/v1.0/diary/<int:d_id>', methods=['GET'])
            def get_diary(d_id):
                d = [d for d in diary if d['id'] == d_id]
                if len(d) == 0:
                    abort(404)
                return jsonify({'d':d[0]})    
            
            
            @app.route('/api/v1.0/record', methods=['POST'])
            def create_record():
                # if not request.json or not 'title' in request.json:
                #     abort(400)
                data = {
                    # 'id': tasks[-1]['id'] + 1,
                    'title': request.json['title'],
                    'description': request.json.get('description', ''),
                }    
                diary.append(data)
            
                return jsonify({'data': data}), 201  
            "addrLine1" => '123 Test St',
            "city" => 'Columbus',
            "state" => 'OH',
            "zipCode" => '43123',
            "country" => 'USA',
            "email" => 'testingtester@2co.com',
            "phoneNumber" => '555-555-5555'
        ),
        "shippingAddr" => array(
            "name" => 'Testing Tester',
            "addrLine1" => '123 Test St',
            "city" => 'Columbus',
            "state" => 'OH',
            "zipCode" => '43123',
            "country" => 'USA',
            "email" => 'testingtester@2co.com',
            "phoneNumber" => '555-555-5555'
        )
    ), 'array');
    if ($charge['response']['responseCode'] == 'APPROVED') {
        echo "Thanks for your Order!";
    }
} catch (Twocheckout_Error $e) {
    $e->getMessage();
}=  

        ?>.