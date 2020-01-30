from flask import Flask, jsonify,json,request, abort, url_for
from api import diary_dictionary 
from api import user_dictionary 
from flask_httpauth import HTTPBasicAuth

auth = HTTPBasicAuth()
app = Flask(__name__)
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









if '__name__'=='__main__':
	app.run(debug=True)
