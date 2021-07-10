//manage users joining in, signing out, what users are in what room

const users =[]; //will be empty array in the beginning

const addUser = ({id, name, room}) => {
    //if user enters Hello World , we need to change and save it as 
    //helloworld

    name = name.trim().toLowerCase(); //removing spaces and lower case
    room = room.trim().toLowerCase();

    const existingUser = users.find((user) => user.room === room && user.name === name);
    //basically if the user is trying to sign in to the same room using same name 
    //then throw error, since this is not allowed
    //users.find function searches the array for the name and room and see 
    //if they already exist

    if(existingUser) {
        return {error: 'Username is taken.'};
    }

    const user = {id, name, room};
    users.push(user); //so if the if condition is false, then the sign in is valid
    //so we create new user and push it into the array users

    return {user};

}
const removeUser = (id) => {
    const index = users.findIndex((user) => user.id === id );

    if(index !== -1) {
        return users.splice(index,1 )[0];
    }
    //if user id = id then we need to remove that user
    //so by default index should be -1
    //if it is not then id already exists
    //so then remove that user using splice function (index, 1) at position index remove 1 element
    //then mention index[0] since for next round of checking, start from initial index of array

}
const getUser = (id) => users.find((user) => user.id === id); 

const getUsersInRoom = (room) => users.filter((user) => user.room === room); //return the user from the room

module.exports ={ addUser, removeUser, getUser, getUsersInRoom};
