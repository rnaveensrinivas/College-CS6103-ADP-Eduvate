/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./chat.js":
/*!*****************!*\
  !*** ./chat.js ***!
  \*****************/
/***/ (() => {

eval("// Params for login\nlet options = {\n    uid: \"\",\n    token: \"\"\n}\n\n// Your app ID\nconst appID = '97b519f6ee00429ba0a09af9750892e0';\n// Your token\noptions.token = '00697b519f6ee00429ba0a09af9750892e0IAD6hv6N3dbCJK2t2u/KSvoOc2tpHoQGhGMd05q+dabT+T9eonQAAAAAEABIxZZuQxbgYAEA6ANDFuBg';\n\n// Initialize client\nconst client = AgoraRTM.createInstance(appID)\n\n// Client Event listeners\n// Display messages from peer\nclient.on('MessageFromPeer', function (message, peerId) {\n\n    document.getElementById(\"log\").appendChild(document.createElement('div')).append(\"Message from: \" + peerId + \" Message: \" + message)\n})\n// Display connection state changes\nclient.on('ConnectionStateChanged', function (state, reason) {\n\n    document.getElementById(\"log\").appendChild(document.createElement('div')).append(\"State changed To: \" + state + \" Reason: \" + reason)\n\n})\n\nlet channel = client.createChannel(\"demoChannel\")\n\nchannel.on('ChannelMessage', function (message, memberId) {\n\n    document.getElementById(\"log\").appendChild(document.createElement('div')).append(\"Message received from: \" + memberId + \" Message: \" + message)\n\n})\n// Display channel member stats\nchannel.on('MemberJoined', function (memberId) {\n\n    document.getElementById(\"log\").appendChild(document.createElement('div')).append(memberId + \" joined the channel\")\n\n})\n// Display channel member stats\nchannel.on('MemberLeft', function (memberId) {\n\n    document.getElementById(\"log\").appendChild(document.createElement('div')).append(memberId + \" left the channel\")\n\n})\n\n// Button behavior\nwindow.onload = function () {\n\n    // Buttons\n    // login\n    document.getElementById(\"login\").onclick = async function () {\n        options.uid = document.getElementById(\"userID\").value.toString()\n        await client.login(options)\n    }\n\n    // logout\n    document.getElementById(\"logout\").onclick = async function () {\n        await client.logout()\n    }\n\n    // create and join channel\n    document.getElementById(\"join\").onclick = async function () {\n        // Channel event listeners\n        // Display channel messages\n        await channel.join().then (() => {\n            document.getElementById(\"log\").appendChild(document.createElement('div')).append(\"You have successfully joined channel \" + channel.channelId)\n        })\n    }\n\n    // leave channel\n    document.getElementById(\"leave\").onclick = async function () {\n\n        if (channel != null) {\n            await channel.leave()\n        }\n\n        else\n        {\n            console.log(\"Channel is empty\")\n        }\n\n    }\n\n    // send peer-to-peer message\n    document.getElementById(\"send_peer_message\").onclick = async function () {\n\n        let peerId = document.getElementById(\"peerId\").value.toString()\n        let peerMessage = document.getElementById(\"peerMessage\").value.toString()\n\n        await client.sendMessageToPeer(\n            { text: peerMessage },\n            peerId,\n        ).then(sendResult => {\n            if (sendResult.hasPeerReceived) {\n\n                document.getElementById(\"log\").appendChild(document.createElement('div')).append(\"Message has been received by: \" + peerId + \" Message: \" + peerMessage)\n\n            } else {\n\n                document.getElementById(\"log\").appendChild(document.createElement('div')).append(\"Message sent to: \" + peerId + \" Message: \" + peerMessage)\n\n            }\n        })\n    }\n\n    // send channel message\n    document.getElementById(\"send_channel_message\").onclick = async function () {\n\n        let channelMessage = document.getElementById(\"channelMessage\").value.toString()\n\n        if (channel != null) {\n            await channel.sendMessage({ text: channelMessage }).then(() => {\n\n                document.getElementById(\"log\").appendChild(document.createElement('div')).append(\"Channel message: \" + channelMessage + \" from \" + channel.channelId)\n\n            }\n\n            )\n        }\n    }\n}\n\n//# sourceURL=webpack://web/./chat.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./chat.js"]();
/******/ 	
/******/ })()
;