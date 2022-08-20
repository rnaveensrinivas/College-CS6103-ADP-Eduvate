import React from 'react';
import {BrowserRouter as Router, Route} from 'react-router-dom'
//master program.
//npm install --save react-router-dom
import Join from './components/Join/Join';
import Chat from './components/Chat/Chat';

const App = () => (
    <Router>
        <Route path="/" exact component={Join} /> 
        <Route path="/chat" exact component={Chat} />
    </Router>
);
//when the user comes on the page, join component is first seen
//inside Join, he passes data in login form
//pass the data through query strings we pass this to the chat

export default App;