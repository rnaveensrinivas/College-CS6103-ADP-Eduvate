const path = require('path');
module.exports = {
    entry: './chat.js',
    output: {
    filename: 'bundle.js',
    path: path.resolve(__dirname, './dist'),
    },
    devServer: {
    compress: true,
    port: 80
    },
    mode:'development'/*setting mode option to development since run build command 
    threw warning - yet to see what this does */
    };