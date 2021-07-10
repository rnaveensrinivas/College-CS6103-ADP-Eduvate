const express = require('express');
const socketio = require('socket.io');
const http = require('http');
const cors = require('cors');

const { addUser, removeUser, getUser, getUsersInRoom} = require('./users.js');
//this is similar to import
//we use websockets instead of http

const PORT = process.env.PORT || 5000; //creating a port in 5000
const router = require('./router');

const app = express();
const server = http.createServer(app);
//const io = socketio(server); //to make the server work
//removed the above line since we need to enable cors
//we need to use the io

//to enable cors
corsOptions={
    cors: true,
    origins:["http://localhost:3000"],
   }
   const io = socketio(server, corsOptions);
app.use(router);
app.use(cors); 

io.on('connection', (socket) => { //socket is going to be connected on the client side

    socket.on('join', ({name, room}, callback) => {
        const { error, user } = addUser({id: socket.id,name,room});  
        
        if(error)return callback(error);//error from what we have mentioned in users.js

        socket.emit('message', {user: 'admin', text: `${user.name}, welcome to the room ${user.room}`}); 
        //tells the user that he has joined
        //emitted from backend to frontend
        socket.broadcast.to(user.room).emit('message', {user:'admin', text: `${user.name} has joined!`});
        //broadcast function tells everyone except the user that he has joined

        socket.join(user.room); //joins user in room

        io.to(user.room).emit('roomData', { room: user.room , users: getUsersInRoom(user.room)});
        callback();

    });
    //expecting in backend
    socket.on('sendMessage', (message, callback) => {
        const user = getUser(socket.id); //specific instance
        io.to(user.room).emit('message', { user:user.name,text:message});
        io.to(user.room).emit('roomData', { room:user.room,text:message});


        callback();

    });



    socket.on('disconnect', () => {
        const user = removeUser(socket.id);

        if(user) {
            io.to(user.room).emit('message', {user: 'admin', text: `${user.name} has left.`})//added, removed and added once again
        }
    }) //just that particular socket that has joined. that is why we dont use io

});

//initially useEffect will be called two times since 
//we need to sepcify when the function is being called
//so we add array in useEffect

app.use(router);

server.listen(PORT, () => console.log(`Server has started on port ${PORT}`));
//this is visible on the console

