//client side js
//const socket = io('http://localhost:3000')
const socket = io('https://eduvate335.herokuapp.com')
const messageContainer = document.getElementById('message-container')
const messageForm = document.getElementById('send-container')

const messageInput = document.getElementById('message-input')

const personName = prompt('What is your name?')
appendMessage('You joined')

socket.emit('new-user', personName)//shows this on the pther person's page


socket.on('chat-message', data => {
    appendMessage(`${data.personName}: ${data.message}`)
}) //appends the name and the message sent by the person

socket.on('user-connected', personName => {
    appendMessage(`${personName} connected`) //shows person connected
})
socket.on('user-disconnected', personName => {
    appendMessage(`${personName} disconnected`)
})


messageForm.addEventListener('submit' , e => {
    e.preventDefault()//prevents refreshing of the page while clicking send button; otherwise messages 
    //will be lost every time user clicks button
    const message = messageInput.value
    appendMessage(`You: ${message}`)//whatever message you sent
    socket.emit('send-chat-message', message)
    messageInput.value =''//declaring it to empty string for next use
})

function appendMessage(message) {
    const messageElement = document.createElement('div')
    messageElement.innerText = message
    messageContainer.append(messageElement)
}

/*terminal commands
npm init
npm i socket.io
npm i --save-dev nodemon
npm run devStart
*/
