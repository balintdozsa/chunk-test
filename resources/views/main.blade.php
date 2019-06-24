<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>
</head>
<body>
<h1>New Users</h1>

<ul>
    <li v-repeat="user: users">@{{ user }}</li>
</ul>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/0.12.16/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.js"></script>

<script>
    var socket = io.connect('http://localhost:3000');
    /*socket.on('test-channel:MessageSent', function(data) {
        console.log(data);
        //this.users.push(data.username);
    }.bind(this));*/
    /*socket.on('connection', function(_socket){
        _socket.join('laravel_database_test-channel:MessageSent');
        console.log('Joined!');
    });*/
    socket.on('connect',function() {
        console.log('Client has connected to the server!');
    });
    socket.on('server-message',function(data) {
        console.log('Received a message from the server!',data);
    });
    socket.on('laravel_database_test-channel:MessageSent',function(data) {
        console.log('Received a message from the server!',data);
    });
    //socket.emit('subscribe', 'laravel_database_test-channel:MessageSent');


    /*var socket = io.connect('http://127.0.0.1:3000');

    socket.on('connect',function() {
        console.log('Client has connected to the server!');
    });
    // Add a connect listener
    socket.on('message',function(data) {
        console.log('Received a message from the server!',data);
    });
    // Add a disconnect listener
    socket.on('disconnect',function() {
        console.log('The client has disconnected!');
    });*/

    new Vue({
        el: 'body',
        data: {
            users: []
        },
        ready: function() {
            /*socket.on('test-channel:MessageSent', function(data) {
                console.log(data);
                this.users.push(data.username);
            }.bind(this));*/
        }
    });
</script>
</body>
</html>