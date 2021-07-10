import React, {useState, useEffect}from 'react';//these are react hooks
import queryString from 'query-string'; //retrieves the data from the url
import io from 'socket.io-client';

import './Chat.css';

import InfoBar from '../InfoBar/InfoBar';
import Input from '../Input/Input';
import Messages from '../Messages/Messages';

let socket;


const Chat = ({location}) => {
    const [name, setName] = useState('');
    const [room, setRoom] = useState(''); 
    const [message, setMessage] = useState(''); 
    const [messages, setMessages] = useState([]); 
    const ENDPOINT = 'https://messaging-app-112.herokuapp.com/';
    useEffect(() => {
        const {name, room} = queryString.parse(location.search);
        socket = io(ENDPOINT);
        setName(name);
        setRoom(room);

        socket.emit('join', {name, room}, () => {

        }); //same as {name:name, room:room}
        //used for onmounting - when we leave the chat 
        return () => {
            socket.emit('disconnect');

            socket.off(); //turn off this one instance of socket when we leave the chat
        }
    }, [ENDPOINT, location.search]);
//so only if endpoint and location.search values change, we need to re-render useEffect


    useEffect(() => {
        socket.on('message', (message) => {
            setMessages([...messages, message]);//add every new message to array
        })
    }, [messages]);
    //we keep track of all messages using state. We use an array

    const sendMessage = (event) => {
        event.preventDefault();//to prevent refreshing the whole page

        if(message) {
            socket.emit('sendMessage', message, () => setMessage('')); //callback clears message
        }
    }

    console.log(message, messages);

    return (
        <div className="outerContainer">
          <div className="container">
              <InfoBar room = {room}/>
              <Messages messages={messages} name={name}/>

              <Input message={message} setMessage={setMessage} sendMessage={sendMessage} />

          </div>
          
        </div>
      );
    }
    //to make use of io
//initially useEffect will be called two times since 
//we need to sepcify when the function is being called
//so we add array in useEffect
//how does this help? the useEffect function will be called
//only when the values in the list change

export default Chat;
//socket.io logic will be stored in this file
//useEffect is a react hook
