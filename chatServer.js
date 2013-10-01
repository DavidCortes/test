var app = require('http').createServer(handler) 
 , io = require('socket.io').listen(app)
 , fs = require('fs');
app.listen(8888);

function handler (req, res) { 
 fs.readFile(__dirname + '/memLoginRadio.php', function (err, data) {
     if (err) { 
                res.writeHead(500);
         return res.end('Error loading Demo.html'); 
            }
     res.writeHead(200);
	 console.log(data);
     res.end(data); 
        });
}
io.sockets.on('connection', function (socket) {
 socket.on('addme',function(username) {
  socket.username = username;
  //socket.emit('loginifo', 'SERVER', 'You have connected!!!!'); 
  //socket.broadcast.emit('Demo', 'SERVER', username + ' 上線了');
 });
 socket.on('sendchat', function(data) { 
  io.sockets.emit('loginifo', socket.username, data);
 });
 
var rooms;
socket.on('room', function(room) {
		rooms = room;
        socket.join(room);
});
socket.on('leaveRoom',function(room){
		socket.leave(room);
});
socket.on('sendMsg',function(data){
		io.sockets.in(rooms).emit(rooms,socket.username, data); 
		//about :socket.emit(name,arg1,arg2,arg3,...)    name->args.
});
	
 socket.on('disconnect', function() {
 // io.sockets.emit('loginifo', 'SERVER', socket.username + ' 離線中');
 });
});// JavaScript Document



