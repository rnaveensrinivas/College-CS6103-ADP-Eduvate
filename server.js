//server side js

const io = require("socket.io")(3000, {
    cors: {
      origin: "*",//to overwrite the CORS policy
    },
  })

  const users = {} //empty object
  io.on('connection', socket => {
    socket.on('new-user', personName => {
        users[socket.id] = personName
        socket.broadcast.emit('user-connected', personName)
    })
    socket.on('send-chat-message', message => {
        socket.broadcast.emit('chat-message', {message: message, personName:
            users[socket.id]})
    })
    socket.on('disconnect', () => {
        socket.broadcast.emit('user-disconnected', users[socket.id])
        delete users[socket.id]
       
    })//emit displays the text on the screen
    //first declaring empty object users
    //then the person's name is stored in the array
    //and then once they disconnect, you delete their id from the array 
})