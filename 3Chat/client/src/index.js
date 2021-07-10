import React from 'react';
import ReactDOM from 'react-dom';
import App from './App';
ReactDOM.render (<App />, document.querySelector('#root'));
//index.html in public directory
//react is going to import the code into the single div element that contains the 
//id = root.
//so everything we create in react will be inside the App in line 3, and line 4 asks to 
//put it in the div element having id=root

//Also according to rules of typescript, while importing App should always start
//with a capital letter, else it throws an error

