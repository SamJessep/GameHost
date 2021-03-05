const express = require('express');
const app = express();
const SERVER_PORT = process.env.PORT || 5000;

app.use(express.static('public'))

app.listen(
  SERVER_PORT,
  () => console.log('Game Server running on listening on http://localhost:' + SERVER_PORT)
);