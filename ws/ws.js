var server = require('http').Server();
var io = require('socket.io')(server);
var Redis = require('ioredis');
var redis = new Redis();

redis.subscribe('laravel_database_test-channel');

redis.on('message', function(channel, message) {
    console.log(message);
    message = JSON.parse(message);

    console.log(channel + ':' + message.event);
    io.emit(channel + ':' + message.event, message.data);
});

io.on('connection', function (socket) {
    console.log('a user connected');
    socket.emit('server-message', 'hello socket.io server');
});

server.listen(3000);
console.log('listen');